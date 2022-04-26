<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coaching_ extends Model
{
    use HasFactory;
    protected $table = 'coaching';
    protected $fillable = [
        'trainer_id',
        'title',
        'date',
        'hours',
        'user_id',
    ];

    public function student(){
        return $this->belongsTo('App\Models\User','student_id','id');
    }
}