<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\LoginRequest;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login(Request $request): Response
    {
        $vendor = Vendor::where('email', $request->email)->first();

        if (! $vendor) {
            throw ValidationException::withMessages([
                'email' => 'The email not found.',
            ]);
        }

        if (! Hash::check($request->password, $vendor->password)) {
            throw ValidationException::withMessages([
                'password' => 'The password not match.',
            ]);
        }

        return response([
            'status' => true,
            'message' => "Successfully logged in",
            'data' => [
                'type' => 'Bearer',
                'token' => $vendor->createToken('vendor-token')->plainTextToken,
            ],
        ], Response::HTTP_OK);
    }

    public function logout(): Response
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete();

        return response([
            'status' => true,
            'message' => "logout successfully.",
        ], Response::HTTP_OK);
    }

    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->userFromToken(\request('access_token'));
        $findUser = Vendor::where('google_id', $user->id)->orWhere('email', $user->email)->first();

        if($findUser){

            return response([
                'status' => true,
                'message' => "Successfully logged in",
                'data' => [
                    'type' => 'Bearer',
                    'token' => $findUser->createToken('vendor-token')->plainTextToken,
                ],
            ], Response::HTTP_OK);

        }else{
            $name = explode(' ', $user->name);
            $first_name = @$name[0];
            $last_name = @$name[1];

            Vendor::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $user->email,
                'google_id'=> $user->id,
                'password' => encrypt('123456Google')
            ]);

            return response([
                'status' => true,
                'message' => "Successfully logged in",
                'data' => [
                    'type' => 'Bearer',
                    'token' => $findUser->createToken('vendor-token')->plainTextToken,
                ],
            ], Response::HTTP_OK);
        }
    }

}
