<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_ extends Model
{
    use HasFactory;
    protected $table = 'training';
    protected $fillable = [
        'student_id',
        'title',
        'trainer_id',
        'date',
        'hours',
        'user_id',
    ];

    public function student(){
        return $this->belongsTo('App\Models\User','student_id','id');
    }

    public function trainer(){
        return $this->belongsTo('App\Models\User','trainer_id','id');
    }
}