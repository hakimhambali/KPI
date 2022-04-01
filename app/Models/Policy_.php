<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy_ extends Model
{
    use HasFactory;
    protected $table = 'policy';
    protected $fillable = [
        'title',
        'policy_path',
        'user_id',
        'description',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}