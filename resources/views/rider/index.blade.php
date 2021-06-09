@extends('layouts.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Rider Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Rider List
                    <a href="{{ route('rider.create') }}" class="btn btn-sm btn-success" style="float:right;">Add New</a>
                </h6>
                <div class="table-wrapper">
                    <table id="datatable1" class="table scrollable display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Profile</th>
                            <th class="wd-15p">First Name</th>
                            <th class="wd-15p">Last Name</th>
                            <th class="wd-15p">Email </th>
                            <th class="wd-20p">Phone</th>
                            <th class="wd-20p">gender</th>
                            <th class="wd-20p">D.O.B</th>
                            <th class="wd-20p">Status</th>
                            <th class="wd-20p">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($riders as $row)

                            <tr>
                                <td><img src="{{ asset('/storage/'.$row->profile_photo) }}" height="70px;" width="70px;"></td>
                                <td>{{ $row->first_name }}</td>
                                <td>{{ $row->last_name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->riderDetail->gender }}</td>
                                <td>{{ $row->riderDetail->date_of_birth }}</td>
                                <td>

                                    @if($row->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif

                                </td>

                                <td>
                                    <a href="{{ URL::to('/rider/'.$row->id.'/edit') }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i>
                                    </a>
                                    <form method="post" action="{{ url('rider/'.$row->id) }}" id="deleteForm" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Delete" id="btnDelete"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="{{ URL::to('rider/'.$row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i></a>
                                    @if($row->status == 1)
                                        <a href="{{ URL::to('inactive/rider/'.$row->id) }}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i></a>
                                    @else
                                        <a href="{{ URL::to('active/rider/'.$row->id) }}" class="btn btn-sm btn-info" title="Active"><i class="fa fa-thumbs-up"></i></a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->

            </div><!-- card -->

        </div><!-- sl-pagebody -->

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection
