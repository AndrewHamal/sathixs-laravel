@extends('admin_web.layouts.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Rider List
                    <a href="{{ route('rider.create') }}" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-plus"></i> Add New</a>
                </h6>
                <div class="table-wrapper">
                    {!! $dataTable->table() !!}

                </div><!-- table-wrapper -->

            </div><!-- card -->

        </div><!-- sl-pagebody -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

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
                            url: "{{ url('admin/rider/') }}/"+id,
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
                                    window.location.href = "{{ route('rider.index') }}";
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
