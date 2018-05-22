<?php

namespace App\Http\Controllers;

use App\Ride;
use App\UserRide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rides = Ride::where('start_at', '>', now()->format('Y-m-d'));

        if (Auth::check()) {
            // Проверка на то, не присоединён ли уже
            $ride_user = UserRide::select('ride_id')->where('user_id', Auth::id())->get()->pluck('ride_id');
            $rides->where('user_id', '<>', Auth::id())
                ->whereNotIn('id', $ride_user);
        }

        // Проверка на свободные места
        $av_rides = Ride::with(['users'])->get();
        $av_rides_id = $av_rides->reject(function($value, $key) {
            if ($value->users->count() >= $value->seats) return true;
        })->pluck('id');

        $rides->whereIn('id', $av_rides_id);
        $rides = $rides->paginate(2);

        return view('index', [
            'rides' => $rides,
        ]);
    }
}
