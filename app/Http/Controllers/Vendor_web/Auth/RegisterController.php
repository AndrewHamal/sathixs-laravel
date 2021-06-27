<?php

namespace App\Http\Controllers\Vendor_web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        dd($request);
    }
}
