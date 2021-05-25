<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\LoginRequest;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request): Response
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

}
