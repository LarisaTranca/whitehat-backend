<?php

namespace App\Models;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameBrandBlock extends Model
{
    use HasFactory, TableTrait;

    protected $table    = 'game_brand_block';
    protected $guarded  = [];
    protected $hidden   = [];

}
