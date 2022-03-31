<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo_ extends Model
{
    use HasFactory;
    protected $table = 'memo';
    protected $fillable = [
        'title',
        'memo_path',
        'description',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}