<?php

namespace App\Http\Controllers\Vendor_web\Tickets;

use App\DataTables\Vendor_web\TicketDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor_web\Tickets\TicketRequest;
use App\Models\Vendor\Ticket;
use App\Models\Vendor\TicketFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:vendor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TicketDataTable $dataTable)
    {
        return $dataTable->render('vendor_web.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor_web.tickets.create');
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

        if ( $request->hasFile('image')){
            $ticketInstance = new Ticket();
            $files = $ticketInstance->uploadFiles($request->image);
            foreach ($files as $file)
            {
                $file['ticket_id'] =  $ticket->id;
                $ticket_file = TicketFile::create($file);
            }
        }

        $notification=array(
            'message'=>'Ticket Submitted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('ticket.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::where(['id'=> $id])->first();
        return view('vendor_web.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::where(['id'=> $id])->first();
        return view('vendor_web.tickets.edit', compact('ticket'));
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
        Ticket::findOrfail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'vendor_id' => Auth::user()->id,
        ]);

        $ticket = Ticket::findOrfail($id);
        if ( $request->hasFile('image')){
            // delete previous file
            if(!empty($request->arr_ids)) {
                foreach($request->arr_ids as $row) {
                    TicketFile::destroy($row);
                }
            }

            // then add new files
            $ticketInstance = new Ticket();
            $files = $ticketInstance->uploadFiles($request->image);

            foreach ($files as $file)
            {
                $file['ticket_id'] =  $ticket->id;
                $ticket_file = TicketFile::create($file);
            }
        }

        $notification=array(
            'message'=>'Ticket Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('ticket.index')->with($notification);
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
        return response()->json(['message'=>'Ticket Deleted Successfully', 'type'=> 'success']);
    }
}
