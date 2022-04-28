<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement_ extends Model
{
    use HasFactory;
    protected $table = 'announcement';
    protected $fillable = [
        'announcement',
        'user_id',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}