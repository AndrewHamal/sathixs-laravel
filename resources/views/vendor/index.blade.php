@extends('layouts.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Vendor List
                    <a href="{{ route('admin_vendor.create') }}" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-plus"></i> Add New</a>
                </h6>
                <div class="table-wrapper">
                    <table id="datatable1" class="table scrollable display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">Profile</th>
                            <th class="wd-10p">First Name</th>
                            <th class="wd-10p">Last Name</th>
                            <th class="wd-15p">Email</th>
                            <th class="wd-10p">Phone</th>
                            <th class="wd-10p">County</th>
                            <th class="wd-10p">State</th>
                            <th class="wd-10p">City</th>
                            <th class="wd-10p">Longitude</th>
                            <th class="wd-10p">Latitude</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vendors as $row)

                            <tr>
                                <td><img src="{{ asset('/storage/'.$row->profile_picture) }}" height="70px;" width="70px;"></td>
                                <td>{{ $row->first_name }}</td>
                                <td>{{ $row->last_name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->location->country }}</td>
                                <td>{{ $row->location->state }}</td>
                                <td>{{ $row->location->city }}</td>
                                <td>{{ $row->location->long }}</td>
                                <td>{{ $row->location->lat }}</td>
                                <td>
                                    <a href="{{ URL::to('/admin_vendor/'.$row->id.'/edit') }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form method="post" action="{{ url('admin_vendor/'.$row->id) }}" id="deleteForm" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Delete" id="btnDelete"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                    <a href="{{ URL::to('admin_vendor/'.$row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i> View</a>

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
