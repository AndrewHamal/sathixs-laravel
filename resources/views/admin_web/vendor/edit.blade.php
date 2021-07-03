@extends('admin_web.layouts.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add Vendor</h6>

                <div class="form-layout mt-3">
                    <form method="post" action="{{  url('admin/admin_vendor/'.$vendor->id)  }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                        <input type="hidden" name="location_id" value="{{ $vendor->location_id }}">
                        <div class="col-lg-12">
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Vendor Details</legend>
                                <div class="row entry-row mg-b-35">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('first_name') is-invalid @enderror" type="text" value="{{ $vendor->first_name }}" name="first_name" placeholder="Enter firstname" required>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" value="{{ $vendor->last_name }}" name="last_name" placeholder="Enter lastname" required>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" value="{{ $vendor->email }}" name="email" placeholder="Enter email address" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('phone') is-invalid @enderror" type="text" value="{{ $vendor->phone }}" name="phone" placeholder="Enter Phone Number" required>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Profile Picture: </label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input @error('profile_picture') is-invalid @enderror" name="profile_picture"
                                                       onchange="readURL1(this);" >
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="one" class="mb-5" style="display: none;">
                                            </label>
                                            @error('profile_picture')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4 col-sm-4">
                                            <img src="{{ asset('/storage/'.$vendor->profile_picture) }}" class="mb-5" style="width:80px; height:80px;">
                                    </div>

                                </div>
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Address</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" value="{{ $vendor->location->city }}" placeholder="Enter City" required>
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('state') is-invalid @enderror" type="text" name="state" value="{{ $vendor->location->state }}" placeholder="Enter State" required>
                                            @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('country') is-invalid @enderror" type="text" name="country" value="{{ $vendor->location->country }}" placeholder="Enter Country" required>
                                            @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Longitude: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('long') is-invalid @enderror" type="number" step="any" name="long" value="{{ $vendor->location->long }}" placeholder="Enter Longitude" required>
                                            @error('long')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Latitude: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('lat') is-invalid @enderror" type="number" step="any" name="lat" value="{{ $vendor->location->lat }}" placeholder="Enter Latitude" required>
                                            @error('lat')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Whole Address: </label>
                                            <input class="form-control" type="text" name="whole_address" value="{{ $vendor->location->whole_address }}" placeholder="Enter Whole Address">
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                        </div>

                        <div class="form-layout-footer text-center">
                            <button class="btn btn-info mg-r-5" type="submit">Update</button>
                            <a href="{{ route('admin_vendor.index') }}" class="btn btn-secondary">Cancel</a>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- form-layout -->

            </div><!-- card -->
        </div>
    </div>


@endsection

@section('js')
    <script type="text/javascript">
        function readURL1(input) {
            if(input.files && input.files[0])
            {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#one').show();
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

@endsection