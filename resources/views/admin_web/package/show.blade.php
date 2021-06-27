@extends('layouts.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">View Package
                    <a href=" {{route('admin_package.index')}}" class="btn btn-success btn-sm pull-right"> List Package </a>
                </h6>
                <div class="form-layout mt-3">
                    <div class="col-lg-12">
                        <fieldset class="custom-fieldset mg-b-20">
                            <legend>Package Details</legend>
                            <div class="row entry-row mg-b-5">
                                <div class="col-lg-2">
                                    <img src="{{ asset('/storage/'.$package->vendor->profile_picture) }}" height="100px;" width="100px;">
                                </div>

                                <div class="row col-lg-10">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Vendor Name: </label><br>
                                            <strong>{{ $package->vendor->first_name.' '.$package->vendor->last_name }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Vendor Contact: </label><br>
                                            <strong>{{ $package->vendor->phone }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Category: </label><br>
                                            <strong>{{ $package->category->title }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label">No. of Package:</label><br>
                                            <strong>{{ $package->no_of_package }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Product Price: </label><br>
                                            <strong>{{ $package->product_price }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Weight: </label><br>
                                            <strong>{{ $package->weight }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Package Files: </label><br>
                                            @if(isset($package->package_file) && !empty($package->package_file))
                                                @foreach($package->package_file as $file)
                                                    <img src="{{ asset('/storage/'.$file->path) }}" class="mb-5" style="width:80px; height:80px;">
                                                @endforeach

                                            @endif
                                        </div>
                                    </div><!-- col-6 -->
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="custom-fieldset mg-b-20">
                            <legend>Receiver Details</legend>
                            <div class="row entry-row mg-b-25">
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Receiver Name: </label><br>
                                        <strong>{{ $package->receiver_name }}</strong>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Receiver Address: </label><br>
                                        <strong>{{ $package->receiver_address }}</strong>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Receiver Phone: </label><br>
                                        <strong>{{ $package->receiver_phone }}</strong>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Special Instruction: </label><br>
                                        <strong>{{ $package->special_instruction }}</strong>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Receiver Signature Name: </label><br>
                                        <strong>{{ $package->receiver_signature_name }}</strong>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Receiver Signature Image: </label><br>
                                        @if($package->receiver_signature_image != null)
                                            <img src="{{ asset('/storage/'.$package->receiver_signature_image) }}" style="width:80px; height:80px;">
                                        @endif
                                    </div>
                                </div>
                            </div><!-- row -->
                        </fieldset>
                    </div>

                </div><!-- form-layout -->

            </div><!-- card -->
        </div>
    </div>


@endsection

@section('js')

@endsection
