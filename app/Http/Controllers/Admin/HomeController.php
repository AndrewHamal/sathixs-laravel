<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        return $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('admin_web.home');
    }

    public function logout()
    {
        Auth::logout();
        $notification = array(
            'message' => 'Successfully Logout',
            'alert-type' => 'success'
        );

        return Redirect()->route('admin.login')->with($notification);
    }

}
