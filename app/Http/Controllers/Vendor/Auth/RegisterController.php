<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\RegisterRequest;
use App\Models\Location;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): Response
    {
        if ($request->city) {
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
            ];
        }

        $input = $request->except(['confirm_password']);
        $input['password'] = bcrypt($input['password']);

        if (isset($locationData)) {
            $location = Location::create($locationData);
            $input['location_id'] = $location->id;
        }

        $vendor = Vendor::create($input);
        $token = $vendor->createToken('vendor_token')->plainTextToken;

        return response([
            'status' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $vendor,
        ], Response::HTTP_CREATED);
    }
}
