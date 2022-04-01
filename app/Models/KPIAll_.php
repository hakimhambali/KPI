<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPIAll_ extends Model
{
    use HasFactory;
    protected $table = 'kpi_all';
    protected $fillable = [
        'grade_master',
        'weightage_master',
        'total_score_master',
        'grade_all',
        'total_score_all',
        'user_id',
        'year',
        'month',
        'weightage_kecekapan',
        'total_score_kecekapan',
        'weightage_nilai',
        'total_score_nilai',
    ];

    public function kpimasters() {
        return $this->hasMany('App\Models\KPIMaster_', 'kpiall_id', 'id');
    }
}
