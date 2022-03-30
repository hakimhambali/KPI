<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOP_ extends Model
{
    use HasFactory;
    protected $table = 'sop';
    protected $fillable = [
        'title',
        'department',
        'departmentview',
        'part',
        'sop_path',
        'description',
        'user_id',
        'link'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}