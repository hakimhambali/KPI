<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPIMaster_ extends Model
{
    use HasFactory;
    protected $table = 'kpi_master';
    protected $fillable = [
        'fungsi',
        'percent_master',
        'link',
        'objektif',
        'pencapaian',
        'skor_KPI', 
        'skor_sebenar',
        'user_id',
        'kpiall_id',
        'year',
        'month',
    ];

    public function kpi() {
        return $this->hasMany('App\Models\KPI_', 'kpimaster_id', 'id');
    }

    public function kpiall() {
        return $this->hasOne('App\Models\KPIAll_', 'id', 'kpiall_id');
    }
}
