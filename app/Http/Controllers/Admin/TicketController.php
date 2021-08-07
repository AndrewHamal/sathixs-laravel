<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TicketDataTable;
use App\Events\TicketChat as EventsTicketChat;
use App\Http\Controllers\Controller;
use App\Models\TicketChat;
use App\Models\Vendor\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class TicketController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TicketDataTable $dataTable)
    {
        if($request->type == "ajax"){
            $ticket = Ticket::where('status', 0)
            ->orderBy('type', 'DESC')
            ->get();
            return response()->json($ticket);
        }

        if($request->type == "closed"){
            return $dataTable->render('admin_web.ticket.index');
        }
        return view('admin_web.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = TicketChat::where('ticket_id', $id)->get();
        return $ticket;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        TicketChat::create([
            'admin_id' => Auth::user()->id,
            'message' => $request->message,
            'ticket_id' => $id
        ]);

        Broadcast(new EventsTicketChat(['ticket_id' => $id]));
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function markComplete(Request $request)
    {
        Ticket::find($request->ticket_id)
        ->update(['status' => 1]);

        return response([
            'status' => true,
            'message' => 'successfully marked as complete'
        ]);
    }
}
