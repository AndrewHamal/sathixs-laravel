<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\TicketRequest;
use App\Models\Vendor\Ticket;
use App\Models\Vendor\TicketFile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::where('vendor_id', Auth::user()->id)
            ->get();
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
    public function store(TicketRequest $request)
    {
        $input = $request->all();
        $input['vendor_id'] = Auth::user()->id;
        $ticket = Ticket::create($input);

        $ticket_files = [];
        if ( $request->hasFile('image')){
            $ticketInstance = new Ticket();
            $files = $ticketInstance->uploadFiles($request->image);
            foreach ($files as $file)
            {
                $file['ticket_id'] =  $ticket->id;
                $ticket_file = TicketFile::create($file);
                array_push($ticket_files, $ticket_file);
            }
        }

        return response([
            'status' => true,
            'message'=> 'Ticket successfully created',
            'data' => ['ticket' => $ticket, 'ticket_files' => $ticket_files]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ticket::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Ticket::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketRequest $request, $id)
    {
        $input = $request->all();
        $input['vendor_id'] = Auth::user()->id;
        $ticket = Ticket::findOrfail($id)
            ->update($input);

        $ticket_files = [];
        if ( $request->hasFile('image') ){
            $ticketInstance = new Ticket();
            $files = $ticketInstance->uploadFiles($request->image);
            foreach ($files as $file)
            {
                $file['ticket_id'] =  $id;
                $ticket_file = TicketFile::create($file);
                array_push($ticket_files, $ticket_file);
            }
        }

        return response([
            'status' => true,
            'message'=> 'Ticket successfully updated',
            'data' => ['package' => Ticket::findOrfail($id), 'package_files' => $ticket_files]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::destroy($id);

        return response([
            'status' => true,
            'message'=> 'Ticket deleted successfully',
        ], Response::HTTP_ACCEPTED);
    }
}
