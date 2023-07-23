<?php

namespace App\Helpers;

use App\Models\BrandGame;
use App\Models\Game;
use App\Models\GameCountryBlock;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class GameQueryHelper 
{
    /**
     * Builds query for games blocked by a brand.
     *
     * @param Builder   $query
     * @param           $model
     * @param Game      $gameModel
     * @param BrandGame $brandGameModel
     * @return Builder
     */
    public static function gameBlockedByBrandQuery(Builder $query, $model, Game $gameModel, BrandGame $brandGameModel) : Builder
    {
        return self::gameByLaunchCode($query, $model, $gameModel)
            ->whereRaw($model->getColumn('brandid') . '=' . $brandGameModel->getColumn('brandid'));
    }

    /**
     * Builds query for games blocked by a brand and a country.
     *
     * @param Builder   $query
     * @param Game      $gameModel
     * @param BrandGame $brandGameModel
     * @param array     $payload
     * @return Builder
     */
    public static function gameBlockedByBrandAndCountryQuery(Builder $query, Game $gameModel, BrandGame $brandGameModel, array $payload) : Builder
    {
        $countryBlockModel = new GameCountryBlock();
        return self::gameByLaunchCode($query, $countryBlockModel, $gameModel)
                ->whereRaw($countryBlockModel->getColumn('country') . '= "' . $payload['country'].'"')
                ->where(function (Builder $countryBlockQuery) use ($countryBlockModel, $brandGameModel) {
                    $countryBlockQuery
                    ->whereRaw($countryBlockModel->getColumn('brandid') . '=' . $brandGameModel->getColumn('brandid'))
                    //0 blocked for all brands
                    ->orWhereRaw($countryBlockModel->getColumn('brandid') . '= 0');
                });
    }

    /**
     * Builds query to get games with a specified launchcode
     *
     * @param Builder   $query
     * @param           $model 
     * @param Game      $gameModel
     * @return Builder
     */
    public static function gameByLaunchCode(Builder $query, $model, Game $gameModel)
    {
        return $query->select(DB::raw(1))
            ->from($model->getName())
            ->whereRaw($model->getColumn('launchcode') . '=' . $gameModel->getColumn('launchcode'));
    }
}