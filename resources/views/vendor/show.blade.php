@extends('layouts.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">View Vendor
                    <a href=" {{route('admin_vendor.index')}}" class="btn btn-success btn-sm pull-right"> List Vendor </a>
                </h6>
                <div class="form-layout mt-3">
                    <div class="col-lg-12">
                        <fieldset class="custom-fieldset mg-b-20">
                            <legend>Vendor Details</legend>
                            <div class="row entry-row mg-b-5">
                                <div class="col-lg-2">
                                    <img src="{{ asset('/storage/'.$vendor->profile_picture) }}" height="100px;" width="100px;">
                                </div>

                                <div class="row col-lg-10">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">First Name: </label><br>
                                            <strong>{{ $vendor->first_name }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Last Name: </label><br>
                                            <strong>{{ $vendor->last_name }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Phone: </label><br>
                                            <strong>{{ $vendor->phone }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Email: </label><br>
                                            <strong>{{ $vendor->email }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Country: </label><br>
                                            <strong>{{ $vendor->location->country }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">State: </label><br>
                                            <strong>{{ $vendor->location->state }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">City: </label><br>
                                            <strong>{{ $vendor->location->city }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">longitude: </label><br>
                                            <strong>{{ $vendor->location->long }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Latitude: </label><br>
                                            <strong>{{ $vendor->location->lat }}</strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <br>
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
                                    <th class="wd-10p">Product Price</th>
                                    <th class="wd-10p">Tracking ID</th>
                                    <th class="wd-10p">Receiver Signature Name</th>
                                    <th class="wd-10p">Receiver Signature Image</th>
                                    <th class="wd-20p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($vendor->package as $row)
                                    <tr>
                                        <td>{{ $row->category->title }}</td>
                                        <td>{{ $row->no_of_package }}</td>
                                        <td>{{ $row->receiver_name }}</td>
                                        <td>{{ $row->receiver_address }}</td>
                                        <td>{{ $row->receiver_phone }}</td>
                                        <td>{{ $row->weight }}</td>
                                        <td>{{ $row->special_instruction }}</td>
                                        <td>{{ $row->product_price }}</td>
                                        <td>{{ $row->tracking_id }}</td>
                                        <td>{{ $row->receiver_signature_name }}</td>
                                        @if($row->receiver_signature_image != '')
                                            <td><img src="{{ asset('/storage/'.$row->receiver_signature_image) }}" height="70px;" width="70px;"></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            <a href="{{ URL::to('admin_package/'.$row->id) }}" class="btn btn-sm btn-warning" title="Show"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div>

                </div><!-- form-layout -->

            </div><!-- card -->
        </div>
    </div>


@endsection

@section('js')

@endsection
