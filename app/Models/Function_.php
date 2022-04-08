<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Function_ extends Model
{
    use HasFactory;
    protected $table = 'function';
    protected $fillable = [
        'name',
    ];
}