<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [
        'user_id',
        'origin',
        'destination',
        'seats',
        'price',
        'start_at',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_rides');
    }

    public function user_ride()
    {
        return $this->hasOne('App\UserRide');
    }

    public function user_rides()
    {
        return $this->hasMany('App\UserRide');
    }
}
