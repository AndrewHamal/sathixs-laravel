@extends('vendor_web.layouts.app')

@section('vendor_dash')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('webvendor.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Packages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Package Details</li>
            </ol>
        </nav>
        <div class="card shadow">
            <h6 class="mt-3 ml-3 font-weight-bold">Package Details</h6>
            <div class="card-body">
                <div class="col-md-12 row">
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
                </div>
                <div class="col-md-4">
                    <a href="{{ URL::to('/webvendor/package/share/'.$package->id) }}" class="btn btn-info">Share Package</a>
                </div>
            </div>
        </div>
    </div>
@endsection
