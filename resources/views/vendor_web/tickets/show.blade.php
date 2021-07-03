@extends('vendor_web.layouts.app')

@section('vendor_dash')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('webvendor.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ticket.index') }}">Tickets</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ticket Details</li>
            </ol>
        </nav>
        <div class="card shadow">
            <h6 class="mt-3 ml-3 font-weight-bold">Ticket Details</h6>
            <div class="card-body">
                <div class="col-md-12 row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Name: </label><br>
                            <strong>{{ $ticket->name }}</strong>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Email:</label><br>
                            <strong>{{ $ticket->email }}</strong>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Phone: </label><br>
                            <strong>{{ $ticket->phone }}</strong>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Subject: </label><br>
                            <strong>{{ $ticket->subject }}</strong>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Message: </label><br>
                            <strong>{!! $ticket->message !!}</strong>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Created At: </label><br>
                            <strong>{{ $ticket->created_at->diffForHumans() }}</strong>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Status: </label><br>
                            @if($ticket->status ==1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Attachments: </label><br>
                            @if(isset($ticket->ticket_file) && !empty($ticket->ticket_file))
                                @foreach($ticket->ticket_file as $file)
                                    <img src="{{ asset('/storage/'.$file->path) }}" class="mb-5" style="width:80px; height:80px;">
                                @endforeach

                            @endif
                        </div>
                    </div><!-- col-6 -->

                </div>
            </div>
        </div>
    </div>
@endsection
