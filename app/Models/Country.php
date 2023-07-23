<?php

namespace App\Models;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, TableTrait;

    protected $table    = 'countries';
    protected $guarded  = [];
}
