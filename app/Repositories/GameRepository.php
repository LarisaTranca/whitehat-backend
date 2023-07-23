<?php

namespace App\Repositories;

use App\Contracts\GameRepositoryInterface;
use App\Helpers\GameQueryHelper;
use App\Models\Game;
use App\Models\BrandGame;
use App\Models\GameBrandBlock;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class GameRepository implements GameRepositoryInterface
{
    // Version 1 using Eloquent relationship, much slower than version 2 but easier to read
    public function getGamesWithRelationship(array $payload) : LengthAwarePaginator
    { 
        return Game::with(['provider'])
            ->withWhereHas('brands', function (Builder $query) use ($payload) {
                $query->where('brandid', $payload['brandid']);
                if (isset($payload['category']) && $payload['category'] != 0) {
                    $query = $query->where('category', $payload['category']);
                }
            })
            //remove games which are blocked for the specified brand
            ->doesntHave('brandBlocked')
            //remove games which are blocked for the specified brand and country
            ->whereDoesntHave('countryBlocked', function (Builder $query) use ($payload) {
                $query->where(function (Builder $countryBlockQuery) use($payload) {
                    $countryBlockQuery->where('country', $payload['country'])
                    //0 means all brands
                    ->orWhere('country', 0);
                });
            })
            ->select('launchcode', 'name', 'game_provider_id', 'rtp')
            ->orderBy('name')
            ->paginate($payload['perpage']);
    }

    //Version 2 using SQL Joins, much faster than version 1 but hard to follow 
    public function getGames(array $payload) : LengthAwarePaginator
    { 
        $gameModel      = new Game();
        $brandGameModel = new BrandGame();

        return Game::with(['provider'])
            ->leftJoin($brandGameModel->getName(), $brandGameModel->getColumn('launchcode'), $gameModel->getColumn('launchcode'))
            ->where($brandGameModel->getColumn('brandid'), $payload['brandid'])
            //remove games which are blocked for the specified brand
            ->whereNotExists(function (Builder $query) use ($gameModel, $brandGameModel) {
                return GameQueryHelper::gameBlockedByBrandQuery($query, new GameBrandBlock(), $gameModel, $brandGameModel);
            })
            //remove games which are blocked for the specified brand and country
            ->whereNotExists(function (Builder $query) use ($payload, $gameModel, $brandGameModel) {
                return GameQueryHelper::gameBlockedByBrandAndCountryQuery($query, $gameModel, $brandGameModel, $payload);
            })
            ->when($payload != null , function(EloquentBuilder $query) use ($payload, $gameModel) {
                if (isset($payload['category']) && $payload['category'] != 0) {
                    return $query->where('category', $payload['category']);
                } 
                return $query->groupBy($gameModel->getColumn('id'));
            })
            ->orderBy('name')
            ->paginate($payload['perpage']);
    }

}