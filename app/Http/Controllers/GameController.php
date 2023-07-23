<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Services\GameService;
use Exception;

class GameController extends Controller
{
    /**
     * Display a listing of the games.
     */
    public function index(GameRequest $request, GameService $service)
    {
        $payload = $request->validated();
        try {
            $games = $service->getGames($payload);
        } catch (Exception $exception) {
            return response()->error(500, 'DATABASE_ERROR', $exception);
        }

        return response()->success(data: $games);
    }

}
