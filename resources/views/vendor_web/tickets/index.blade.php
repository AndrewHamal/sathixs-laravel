@extends('vendor_web.layouts.app')

@section('vendor_dash')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('webvendor.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tickets</li>
            </ol>
        </nav>
        <div class="card shadow">
            <h6 class="mt-3 ml-3 font-weight-bold">My Tickets List</h6>
            <div class="card-body">
                <div class="col-md-12">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">

        $(document).on("click", "#btnDelete", function(e){
            e.preventDefault();
            swal({
                title: "Are you Want to delete?",
                text: "Once Delete, This will be Permanently Delete!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        const id = $(this).attr('data-id');
                        $.ajax({
                            url: "{{ url('/webvendor/ticket/') }}/"+id,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id,
                                _method: 'DELETE'
                            },
                            dataType: 'json',
                            success: function (data) {
                                if(data.message)
                                {
                                    var arr = [data.message, data.type];
                                    sessionStorage.setItem('items', JSON.stringify(arr));
                                    window.location.href = "{{ route('ticket.index') }}";
                                }

                            }
                        });
                    } else {
                        swal("Safe Data!");
                    }
                });

        });

    </script>
@endsection

