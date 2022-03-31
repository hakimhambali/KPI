<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_ extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $fillable = [
        'nilai_teras',
        'user_id',
        'year',
        'month',
        'skor_penyelia',
        'weightage',
        'skor_sebenar',
        'skor_pekerja',
        'ukuran',
        'peratus', 
    ];
}