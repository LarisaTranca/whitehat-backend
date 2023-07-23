<?php

namespace App\Models;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameCountryBlock extends Model
{
    use HasFactory, TableTrait;

    protected $table    = 'game_country_block';
    protected $guarded  = [];
    protected $hidden   = ['brandid'];

}
