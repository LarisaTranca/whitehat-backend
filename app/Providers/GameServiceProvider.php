<?php

namespace App\Providers;

use App\Models\BrandGame;
use App\Models\Game;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(Game::class, function (Application $app) {
            return new Game();
        });

        $this->app->bind(BrandGame::class, function (Application $app) {
            return new BrandGame();
        });

        $this->app->bind(BrandGame::class, function (Application $app) {
            return new BrandGame();
        });
    }
}
