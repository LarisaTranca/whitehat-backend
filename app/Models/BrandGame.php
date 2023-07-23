<?php

namespace App\Models;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandGame extends Model
{
    use HasFactory, TableTrait;

    protected $table    = 'brand_games';
    protected $guarded  = [];
    protected $hidden   = ['id', 'sub_category', 'seq'];
}
