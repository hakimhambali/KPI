<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_ extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $fillable = [
        'name',
        'status',
        'department_id'
    ];
}