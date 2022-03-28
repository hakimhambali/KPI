<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint_ extends Model
{
    use HasFactory;
    protected $table = 'complaint';
    protected $fillable = [
        'location',
        'office',
        'level',
        'category',
        'description',
        'user_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}