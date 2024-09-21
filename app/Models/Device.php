<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'device_name'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function DeviceSensorData(){
        return $this->hasMany(Devicedata::class, 'alat_id', 'id');
    }
}
