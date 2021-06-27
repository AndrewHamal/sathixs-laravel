<?php

namespace App\Http\Controllers\Vendor_web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Vendor\Vendor;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }


    public function index()
    {
        return view('vendor_web.home');
    }

    public function logout()
    {
        Auth::logout();
        $notification = array(
            'message' => 'Successfully Logout',
            'alert-type' => 'success'
        );

        return Redirect()->route('webvendor.login')->with($notification);
    }
}
