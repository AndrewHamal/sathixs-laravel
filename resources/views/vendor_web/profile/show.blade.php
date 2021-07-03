@extends('vendor_web.layouts.app')

@section('vendor_dash')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('webvendor.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
        </nav>
        <div class="card shadow">
            <h6 class="mt-3 ml-3 font-weight-bold">My Profile</h6>
            <div class="card-body">
                <form method="post" action="{{ url('webvendor/profile/'.$vendor->id)  }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 row">
                        <div class="col-md-2">
                                <div class="profile-pic-wrapper">
                                    <div class="pic-holder">
                                        <!-- uploaded pic shown here -->
                                        @if(!empty($vendor->profile_picture))
                                            <img id="profilePic" class="pic" src="{{ asset('/storage/'.$vendor->profile_picture) }}">
                                        @else
                                            <img id="profilePic" class="pic" src="{{ asset('backend/img/avatar.jpg') }}">
                                        @endif

                                        <label for="newProfilePhoto" class="upload-file-block">
                                            <div class="text-center">
                                                <div class="mb-2">
                                                    <i class="fa fa-camera fa-2x"></i>
                                                </div>
                                                <div class="text-uppercase">
                                                    Update <br /> Profile Photo
                                                </div>
                                            </div>
                                        </label>
                                        <input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="display: none;" />
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-10 row">
                            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                           value="{{ $vendor->first_name }}" name="first_name" placeholder="First Name" required>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           value="{{ $vendor->last_name }}" name="last_name" placeholder="Last Name" required>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           value="{{ $vendor->email }}" name="email" placeholder="Email Address" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ $vendor->phone }}" name="phone" placeholder="Phone Number" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                                      @if($vendor->location_id != null)value="{{ $vendor->location->country }}" @endif name="country" placeholder="Country" required>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('state') is-invalid @enderror"
                                           @if($vendor->location_id != null) value="{{ $vendor->location->state }}" @endif name="state" placeholder="State" required>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                           @if($vendor->location_id != null) value="{{ $vendor->location->city }}" @endif name="city" placeholder="City" required>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input class="form-control @error('long') is-invalid @enderror" type="number" step="any" name="long" @if($vendor->location_id != null) value="{{ $vendor->location->long }}" @endif placeholder="Enter Longitude" >
                                    @error('long')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input class="form-control @error('lat') is-invalid @enderror" type="number" step="any" name="lat" @if($vendor->location_id != null) value="{{ $vendor->location->lat }}" @endif placeholder="Enter Latitude" >
                                    @error('lat')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('whole_address') is-invalid @enderror"
                                           @if($vendor->location_id != null) value="{{ $vendor->location->whole_address }}" @endif name="whole_address" placeholder="Whole Address" >
                                    @error('whole_address')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="file">Upload Document</label>
                                    <input type="file" class="form-control-file" id="file" name="image[]" onchange="readURL(this);" multiple>
                                    <img src="#" id="one" class="mb-5" style="display: none;">
                                    <p id="multiple_select1"></p>

                                    @error('image')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @if(isset($vendor->vendor_file) && !empty($vendor->vendor_file))
                                        @foreach($vendor->vendor_file as $image)
                                            <img src="{{ asset('/storage/'.$image->path) }}" class="mb-5" style="width:80px; height:80px;">
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            @php
                                foreach($vendor->vendor_file as $row){
                                    echo '<input type="hidden" value="'.$row->id.'" name="arr_ids[]">';
                                }
                            @endphp

                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function readURL(input) {
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

        $(document).on("change", ".uploadProfileInput", function () {
            if(this.files && this.files[0])
            {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#profilePic').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }

        });

    </script>
@endsection

