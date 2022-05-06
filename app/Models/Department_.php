<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department_ extends Model
{
    use HasFactory;
    protected $table = 'department';
    protected $fillable = [
        'name',
        'status',
    ];
}