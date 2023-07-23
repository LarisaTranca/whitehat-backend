<?php

namespace App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface GameRepositoryInterface
{
    /**
     * Gets list of games.
     *
     * @param array   $payload
     * @return LengthAwarePaginator
     */
    public function getGames(array $payload) : LengthAwarePaginator;

}