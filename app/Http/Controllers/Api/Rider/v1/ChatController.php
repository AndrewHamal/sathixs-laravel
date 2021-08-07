<?php

namespace App\Http\Controllers\Api\Rider\v1;

use App\Events\ChatNotify;
use App\Http\Controllers\Controller;
use App\Models\Vendor\RiderVendorChat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($id)
    {
        return RiderVendorChat::where('package_id', $id)->get();
    }

    public function store(Request $request)
    {
        $rider = RiderVendorChat::create([
            'rider_id' => Auth::user()->id,
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

    public function update(Request $request, $id)
    {
        RiderVendorChat::find($id)->update([
            'status' => $request->status,
        ]);

        return response([
            'status' => true,
            'message' => 'Message send Successfully',
        ], Response::HTTP_CREATED);
    }

    public function seenChat($id)
    {
        $chatIds = RiderVendorChat::where('rider_id', null)
        ->where('package_id', $id)->pluck('id');

        foreach($chatIds as $chatId){
            RiderVendorChat::where('id', $chatId)->update([
                'status' => 0
            ]);
        }
    }
}
