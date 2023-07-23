<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\BrandGame;
use App\Models\Country;
use App\Models\Game;
use App\Repositories\GameRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GameListTest extends TestCase
{
    use DatabaseTransactions;

    public function test_check_if_email_exists_in_games_list()
    {
        $game      = Game::factory()->create();
        $brand     = Brand::factory()->create();
        $country   = Country::factory()->create();
        $brandGame = BrandGame::factory()->create([
                        'brandid' => $brand->id,
                        'launchcode' => $game->launchcode
                    ]);
        $payload   = [
                        'brandid' => $brand->id,
                        'country' => $country->code
                    ];

        $game  = new GameRepository();
        $games = $game->getGames($payload);

    }
}
