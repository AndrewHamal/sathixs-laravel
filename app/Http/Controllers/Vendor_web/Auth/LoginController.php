<?php

namespace App\Http\Controllers\Vendor_web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Vendor\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'webvendor/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:vendor')->except('logout');
    }

    public function showLoginForm()
    {
        if(Auth::id()) {
            return redirect()->back();
        }else{
            return view('vendor_web.auth.login');
        }

    }

    protected function guard()
    {
        return Auth::guard('vendor');
    }

    protected function credentials(Request $request)
    {

        $vendor = Vendor::where(['email'=> $request->email])->first();
        if($vendor != null)
        {
            if($vendor->email_verified_at != null)
            {
                return $request->only($this->username(), 'password');
            }else{
                return [];
            }
        }else{
            return [];
        }


    }

}
