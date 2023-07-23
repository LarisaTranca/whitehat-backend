<?php

namespace App\Models;

use App\Traits\TableTrait;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Game extends Model
{
    use HasFactory, Filterable, TableTrait;

    protected $table    = 'game';
    protected $guarded  = [];
    protected $appends  = ['image'];
    
    public function getImageAttribute()
    {
        $settings = config('settings');
        return $settings['media_path'] . $this->launchcode . '.jpg';
    }

    /**
     * Get the provider associated with the game.
     */
    public function provider(): HasOne
    {
        return $this->hasOne(GameProvider::class, 'id', 'game_provider_id');
    }

    /**
     * Get the brand associated with the game.
     */
    public function brands(): HasMany
    {
        return $this->hasMany(BrandGame::class, 'launchcode', 'launchcode');
    }

    /**
     * Get the blocked brands associated with the game.
     */
    public function brandBlocked()
    {
        //         SELECT *
        // FROM `brand_games`
        // INNER JOIN `game_brand_block` ON `game_brand_block`.`brandid` = `brand_games`.`brandid`
        // WHERE `game`.`launchcode` = `game_brand_block`.`launchcode
        // return $this->hasMany(GameBrandBlock::class, 'launchcode', 'launchcode');
        // return $this->join('game_brand_block', 'game_brand_block.launchcode', 'brand_games.launchcode')
        //     ->where('game_brand_block.brandid', 'brand_games.brandid');
        return $this->hasManyThrough(BrandGame::class, GameBrandBlock::class, 'launchcode', 'brandid', 'launchcode', 'brandid');
    }

    /**
     * Get the blocked countries associated with the game.
     */
    public function countryBlocked()
    {
        return $this->hasManyThrough(BrandGame::class, GameCountryBlock::class, 'launchcode', 'brandid', 'launchcode', 'brandid');
    }
}
