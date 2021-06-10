<?php

namespace App\Http\Controllers\Api\Rider\v1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\v1\LocationRequest;
use App\Models\Location;
use App\Models\Rider\Rider_detail;
use Illuminate\Http\Request;

class HomeLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $address = Location::create([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'long' => $request->long,
            'lat' => $request->lat,
            'whole_address' => $request->whole_address
        ]);
        Rider_detail::where('rider_id', auth()->user()->id)->update(['home_location_id'=> $address->id]);

        return response([
            'message'=> 'Home Address Added!',
            'data'=> $address
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $home_address)
    {
        $home_address->update([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'long' => $request->long,
            'lat' => $request->lat,
            'whole_address' => $request->whole_address
        ]);
        return response([
            'message' => 'Home Address Updated',
            'data' => $home_address
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
