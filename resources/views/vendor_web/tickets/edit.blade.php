@extends('vendor_web.layouts.app')

@section('vendor_dash')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('webvendor.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ticket.index') }}">Tickets</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Ticket</li>
            </ol>
        </nav>
        <div class="card shadow">
            <h6 class="mt-3 ml-3 font-weight-bold">Edit Ticket</h6>
            <div class="card-body">
                <form method="post" action="{{ url('webvendor/ticket/'.$ticket->id)  }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ $ticket->name }}" name="name" id="name" placeholder="Name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ $ticket->email }}" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ $ticket->phone }}" name="phone" id="phone" placeholder="Phone" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <select class="form-control" name="subject" id="subject" required>
                                    <option>Ticket Type</option>
                                    <option value="Ticket 1" @php if($ticket->subject == 'Ticket 1'){echo 'selected';} @endphp >Ticket 1</option>
                                    <option value="Ticket 2" @php if($ticket->subject == 'Ticket 2'){echo 'selected';} @endphp>Ticket 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="3" placeholder="Your Message">{!! $ticket->message !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="file">Attachment</label>
                                <input type="file" class="form-control-file" id="file" name="image[]" onchange="readURL(this);" multiple >
                                <img src="#" id="one" class="mb-5" style="display: none;">
                                <p id="multiple_select1"></p>

                                @error('image')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if(isset($ticket->ticket_file) && !empty($ticket->ticket_file))
                                    @foreach($ticket->ticket_file as $image)
                                        <img src="{{ asset('/storage/'.$image->path) }}" class="mb-5" style="width:80px; height:80px;">
                                    @endforeach
                                @endif

                            </div>
                        </div>

                        @php
                            foreach($ticket->ticket_file as $row){
                                echo '<input type="hidden" value="'.$row->id.'" name="arr_ids[]">';
                            }
                        @endphp

                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-success" type="submit">Update</button>
                        <a href="{{ route('ticket.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function readURL(input) {
            if(input.files && input.files[0])
            {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#one').show();
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection

