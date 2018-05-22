<?php

namespace App\Http\Controllers;

use App\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    public function add()
    {
        return view('modules.rides.add');
    }

    public function create(Request $request)
    {
        Ride::create([
            'user_id' => Auth::id(),
            'origin' => $request->origin,
            'destination' => $request->destination,
            'seats' => $request->seats,
            'price' => $request->price,
            'start_at' => convertDateToDB($request->start_at),
        ]);

        createMsg(1, 'Поездка успешно создана!');
        return redirect()->route('profile.index');
    }
}
