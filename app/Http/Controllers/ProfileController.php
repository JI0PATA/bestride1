<?php

namespace App\Http\Controllers;

use App\Ride;
use App\UserRide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $my_rides = Ride::with(['users', 'user_ride'])->where('user_id', Auth::id())->get();
        $associate = UserRide::with(['user', 'ride', 'ride.user', 'ride.users'])->where('user_id', Auth::id())->paginate(2);

        return view('profile', [
            'my_rides' => $my_rides,
            'associate' => $associate,
        ]);
    }
}
