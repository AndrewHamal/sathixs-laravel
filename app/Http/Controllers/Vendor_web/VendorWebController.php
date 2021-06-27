<?php

namespace App\Http\Controllers\Vendor_web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Vendor_web\Vendor;

class VendorWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }


    public function index()
    {
        return view('vendor_web.home');
    }
}
