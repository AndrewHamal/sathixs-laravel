<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\TicketChat;
use App\Models\Vendor\Ticket;
use Illuminate\Http\Request;

class TicketChatController extends Controller
{
    public function index($id){
        return TicketChat::where('ticket_id', $id)->get();
    }

}
