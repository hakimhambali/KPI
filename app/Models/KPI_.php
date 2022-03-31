<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPI_ extends Model
{
    use HasFactory;
    protected $table = 'kpi';
    protected $fillable = [
        'fungsi',
        'bukti',
        'peratus',
        'ukuran',
        'threshold',
        'base',
        'stretch',
        'pencapaian',
        'skor_KPI', 
        'skor_sebenar',
        'bukti_path',
        'year',
        'month',
        'user_id',
        'kpimaster_id',
    ];

    public function kpimasters() {
        return $this->hasOne('App\Models\KPIMaster_', 'id', 'kpimaster_id');
    }
}