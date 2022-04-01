<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecekapan_ extends Model
{
    use HasFactory;
    protected $table = 'kecekapan';
    protected $fillable = [
        'kecekapan_teras',
        'user_id',
        'year',
        'month',
        'skor_penyelia',
        'weightage',
        'skor_sebenar',
        'skor_pekerja',
        'ukuran',
        'peratus'
    ];
}
