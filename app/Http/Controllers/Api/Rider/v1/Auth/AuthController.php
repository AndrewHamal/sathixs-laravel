<?php

namespace App\Http\Controllers\Api\Rider\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\v1\LoginRequest;
use App\Http\Requests\Rider\v1\RegisterRequest;
use App\Models\Rider\Rider;
use App\Models\Rider\Rider_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /* @rider registration */
    public function register(RegisterRequest $request)
    {
        $rider = Rider::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);

        Rider_detail::create(['rider_id'=> $rider->id]);
        $token = $rider->createToken('ridersToken')->plainTextToken;

        return response()->json([
            'status_code'=> 200,
            'message' => 'Riders created Successfully!',
            'data' => $rider,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /* @rider login */
    public function login(LoginRequest $request)
    {
        $rider = Rider::where('email', $request->email)->first();

        if(!$rider)
        {
            throw ValidationException::withMessages([
                'email' => 'Email does not exist.',
            ]);
        }

        if(!Hash::check($request->password, $rider->password))
        {
            throw ValidationException::withMessages([
                'password' => 'Password does not match.',
            ]);
        }

        $token = $rider->createToken('ridersToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'message' => 'Logged in Successfully!',
            'data' =>  $rider,
            'token' => $token
        ]);
    }

    /* @rider logout */
    public function logout(Request $request)
    {
        $rider = auth()->user();
        $rider->currentAccessToken()->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Logout Successfull!'
        ]);
    }
}
