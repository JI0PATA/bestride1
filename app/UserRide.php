<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRide extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ride()
    {
        return $this->belongsTo('App\Ride');
    }
}
