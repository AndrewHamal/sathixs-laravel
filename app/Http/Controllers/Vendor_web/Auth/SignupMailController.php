<?php

namespace App\Http\Controllers\Vendor_web\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VendorSignup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SignupMailController extends Controller
{
    public static function sendSignupEmail($name, $email, $verification_code) {
        $data = [
            'name' => $name,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new VendorSignup($data));
    }
}
