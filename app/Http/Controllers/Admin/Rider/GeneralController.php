<?php

namespace App\Http\Controllers\Admin\Rider;

use App\Http\Controllers\Controller;
use App\Models\Rider\Rider;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function activeRider($id)
    {
        Rider::where('id', $id)->update(['status'=> 1]);
        $notification=array(
            'message'=>'Rider Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function inactiveRider($id)
    {
        Rider::where('id', $id)->update(['status'=> 0]);
        $notification=array(
            'message'=>'Rider Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
