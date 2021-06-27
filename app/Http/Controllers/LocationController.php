<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vendor::
            where('id', '!=', \Auth::user()->id)
            ->where('location_id', '!=', null)
            ->select('first_name', 'last_name', 'location_id')
            ->get();
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
    public function store(Request $request)
    {
        $vendor = Vendor::find(\Auth::user()->id);

        if (! $request->lat || ! $request->long) {
            throw ValidationException::withMessages([
                'lat' => 'the lat field is required',
                'long' => 'the long field is required',
            ]);
        }

        $input = $request->all();

        $location = Location::updateOrCreate(
            ['id' =>$vendor->location_id],
            $input
        );

        $vendor->update([
            'location_id' => $location->id
        ]);

        return response([
            'status' => true,
            'data' => $vendor,
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        return response([
            'status' => true,
            'data' => $location,
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        return response([
            'status' => true,
            'data' => $location,
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($request->city)) {
            if (! $request->lat || ! $request->long) {
                throw ValidationException::withMessages([
                    'lat' => 'the lat field is required',
                    'long' => 'the long field is required',
                ]);
            }
            $locationData = [
                "country" => $request->country,
                "city" => $request->city,
                "state" => $request->state,
                "lat" => $request->lat,
                "long" => $request->long,
                "whole_address" => $request->address
            ];
        }
        $location = [];

        if (isset($locationData)) {
            $location = Location::find($id)
                ->update($locationData);
        }

        return response([
            'status' => true,
            'data' => $location,
        ], Response::HTTP_CREATED);
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
