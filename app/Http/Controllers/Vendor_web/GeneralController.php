<?php

namespace App\Http\Controllers\Vendor_web;

use App\Http\Controllers\Controller;
use App\Models\Vendor\Ticket;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:vendor');
    }


    public function activeTicket($id)
    {
        Ticket::where('id', $id)->update(['status'=> 1]);
        $notification=array(
            'message'=>'Ticket Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function inactiveTicket($id)
    {
        Ticket::where('id', $id)->update(['status'=> 0]);
        $notification=array(
            'message'=>'Ticket Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
