<?php

namespace App\Services;

use App\Contracts\GameServiceInterface;
use App\Repositories\GameRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class GameService implements GameServiceInterface
{
    protected $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function getGames(array $payload) : LengthAwarePaginator
    { 
        $payload['perpage'] = isset($payload['perpage']) ? $payload['perpage'] : 10; 
        return $this->gameRepository->getGames($payload);
    }
}