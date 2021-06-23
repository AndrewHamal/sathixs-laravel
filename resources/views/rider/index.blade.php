@extends('layouts.admin_layouts')

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
{{--                    <table id="datatable1" class="table scrollable display responsive nowrap">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th class="wd-15p">Profile</th>--}}
{{--                            <th class="wd-15p">First Name</th>--}}
{{--                            <th class="wd-15p">Last Name</th>--}}
{{--                            <th class="wd-15p">Email </th>--}}
{{--                            <th class="wd-20p">Phone</th>--}}
{{--                            <th class="wd-20p">gender</th>--}}
{{--                            <th class="wd-20p">D.O.B</th>--}}
{{--                            <th class="wd-20p">Status</th>--}}
{{--                            <th class="wd-20p">Action</th>--}}

{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($riders as $row)--}}

{{--                            <tr>--}}
{{--                                <td><img src="{{ asset('/storage/'.$row->profile_photo) }}" height="70px;" width="70px;"></td>--}}
{{--                                <td>{{ $row->first_name }}</td>--}}
{{--                                <td>{{ $row->last_name }}</td>--}}
{{--                                <td>{{ $row->email }}</td>--}}
{{--                                <td>{{ $row->phone }}</td>--}}
{{--                                <td>{{ $row->riderDetail->gender }}</td>--}}
{{--                                <td>{{ $row->riderDetail->date_of_birth }}</td>--}}
{{--                                <td>--}}

{{--                                    @if($row->status == 1)--}}
{{--                                        <span class="badge badge-success">Active</span>--}}
{{--                                    @else--}}
{{--                                        <span class="badge badge-danger">Inactive</span>--}}
{{--                                    @endif--}}

{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    <a href="{{ URL::to('/rider/'.$row->id.'/edit') }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i> Edit--}}
{{--                                    </a>--}}
{{--                                    <form method="post" action="{{ url('rider/'.$row->id) }}" id="deleteForm" style="display: inline;">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button class="btn btn-sm btn-danger" type="submit" title="Delete" id="btnDelete"><i class="fa fa-trash"></i> Delete</button>--}}
{{--                                    </form>--}}
{{--                                    <a href="{{ URL::to('rider/'.$row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i> View</a>--}}
{{--                                    @if($row->status == 1)--}}
{{--                                        <a href="{{ URL::to('inactive/rider/'.$row->id) }}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i> Inactive</a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{ URL::to('active/rider/'.$row->id) }}" class="btn btn-sm btn-info" title="Active"><i class="fa fa-thumbs-up"></i> Active</a>--}}
{{--                                    @endif--}}

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
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
                            url: "{{ url('/rider/') }}/"+id,
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
