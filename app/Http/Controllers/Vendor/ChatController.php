<?php

namespace App\Http\Controllers\Vendor;

use App\Events\ChatNotify;
use App\Events\TicketChat as EventsTicketChat;
use App\Http\Controllers\Controller;
use App\Models\TicketChat;
use App\Models\Vendor\RiderVendorChat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class ChatController extends Controller
{
    public function index($id)
    {
        return RiderVendorChat::where('package_id', $id)->get();
    }

    public function store(Request $request)
    {
        RiderVendorChat::create([
            'vendor_id' => Auth::user()->id,
            'message' => $request->message,
            'status' => 1,
            'message_type' => 'text',
            'package_id' => $request->package_id
        ]);

        Broadcast(new ChatNotify(['package_id' => $request->package_id]));

        return response([
            'status' => true,
            'message' => 'Message send Successfully',
        ], Response::HTTP_CREATED);
    }

    public function storeTicketChat($id, Request $request)
    {
        TicketChat::create([
            'vendor_id' => Auth::user()->id,
            'message' => $request->message,
            'ticket_id' => $id
        ]);

        Broadcast(new EventsTicketChat(['ticket_id' => $id]));
        return response()->json('success');
    }
}