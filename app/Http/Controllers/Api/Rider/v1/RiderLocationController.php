<?php

namespace App\Http\Controllers\Api\Rider\v1;

use App\Events\Vendor\ReceiveCoordinate;
use App\Http\Controllers\Controller;
use App\Models\RiderTracking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RiderLocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lat' => ['required'],
            'long' => ['required'],
        ]);

        $riderTrack = RiderTracking::create([
            'rider_id' => Auth::user()->id,
            'lat' => $request->lat,
            'long' => $request->long,
            'heading' => $request->heading,
            'package_id' => $request->package_id
        ]);

        broadcast(new ReceiveCoordinate([
            'lat' => $request->lat,
            'long' => $request->long,
            'heading' => $request->heading,
            'package_id' => $request->package_id
            ]
        ));

        return response([
            'status' => true,
            'data' => $riderTrack,
        ], Response::HTTP_CREATED);
    }
}
