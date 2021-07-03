<?php

namespace App\Http\Controllers\Vendor_web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor_web\RegisterRequest;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:vendor');
    }

    public function create()
    {
        return view('vendor_web.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $vendor = new Vendor();
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->password = Hash::make($request->password);
        $vendor->verification_code = sha1(time());
        $vendor->save();

        if($vendor != null)
        {
            SignupMailController::sendSignupEmail($vendor->first_name,$vendor->email, $vendor->verification_code);
            $notification = array(
                'message' => 'Your account has been created. Please check email for verification link.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Something went wrong',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }

    public function verifyVendor($code) {

        $vendor = Vendor::where(['verification_code' => $code])->first();

        if($vendor != null) {
            $vendor->email_verified_at = Carbon::now()->toDateTimeString();
            $vendor->save();
            $notification = array(
                'message' => 'Your account has been verified. Please login with your credentials.',
                'alert-type' => 'success'
            );
            return redirect()->route('webvendor.login')->with($notification);
        }

        $notification = array(
            'message' => 'Invalid verification code.',
            'alert-type' => 'error'
        );
        return redirect()->route('webvendor.login')->with($notification);
    }
}
