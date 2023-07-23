<?php

namespace App\Models;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameProvider extends Model
{
    use HasFactory, TableTrait;

    protected $table    = 'game_providers';
    protected $guarded  = [];
    protected $hidden   = ['id'];
}
