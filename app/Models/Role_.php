<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_ extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $fillable = [
        'name',
        'desc',
        'status',
    ];
}