@extends('layouts.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Admin List
                    <a href="{{ route('register') }}" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-plus"></i> Add New</a>
                </h6>
                <div class="table-wrapper">
                    <table id="datatable1" class="table scrollable display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Name</th>
                            <th class="wd-15p">Phone</th>
                            <th class="wd-15p">Email</th>
                            <th class="wd-15p">Role </th>
                            <th class="wd-20p">Register Date</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $row)

                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->email }}</td>
                                <td>@if($row->role_id == 1) <span class="badge badge-success">Admin</span> @else {{ $row->role_id }} @endif</td>
                                <td>{{ $row->created_at }}</td>

                                <td>
                                    <a href="{{ URL::to('/adminuser/'.$row->id.'/edit') }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form method="post" action="{{ url('adminuser/'.$row->id) }}" id="deleteForm" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Delete" id="btnDelete"><i class="fa fa-trash"></i> Delete</button>
                                    </form>

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
