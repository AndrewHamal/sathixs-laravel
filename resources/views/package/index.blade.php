@extends('layouts.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Package List
                    <a href="{{ route('admin_package.create') }}" class="btn btn-sm btn-success" style="float:right;"><i class="fa fa-plus"></i> Add New</a>
                </h6>
                <div class="table-wrapper">
                    <table id="datatable1" class="table scrollable display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">Category</th>
                            <th class="wd-10p">No. of Package</th>
                            <th class="wd-10p">Receiver Name</th>
                            <th class="wd-15p">Receiver Address</th>
                            <th class="wd-10p">Receiver Phone</th>
                            <th class="wd-10p">Weight</th>
                            <th class="wd-10p">Special Instruction</th>
                            <th class="wd-10p">Vendor</th>
                            <th class="wd-10p">Product Price</th>
                            <th class="wd-10p">Tracking ID</th>
                            <th class="wd-10p">Receiver Signature Name</th>
                            <th class="wd-10p">Receiver Signature Image</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($packages as $row)
                            <tr>
                                <td>{{ $row->category->title }}</td>
                                <td>{{ $row->no_of_package }}</td>
                                <td>{{ $row->receiver_name }}</td>
                                <td>{{ $row->receiver_address }}</td>
                                <td>{{ $row->receiver_phone }}</td>
                                <td>{{ $row->weight }}</td>
                                <td>{{ $row->special_instruction }}</td>
                                <td>{{ $row->vendor->first_name.' '.$row->vendor->last_name }} ({{ $row->vendor->phone }})</td>
                                <td>{{ $row->product_price }}</td>
                                <td>{{ $row->tracking_id }}</td>
                                <td>{{ $row->receiver_signature_name }}</td>
                                @if($row->receiver_signature_image != '')
                                    <td><img src="{{ asset('/storage/'.$row->receiver_signature_image) }}" height="70px;" width="70px;"></td>
                                @else
                                    <td></td>
                                @endif
                                <td>
                                    <a href="{{ URL::to('/admin_package/'.$row->id.'/edit') }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form method="post" action="{{ url('admin_package/'.$row->id) }}" id="deleteForm" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Delete" id="btnDelete"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                    <a href="{{ URL::to('admin_package/'.$row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i> View</a>

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
