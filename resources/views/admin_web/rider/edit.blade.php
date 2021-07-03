@extends('admin_web.layouts.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit Rider</h6>

                <div class="form-layout mt-3">
                    <form method="post" action="{{ url('admin/rider/'.$rider->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="rider_id" value="{{ $rider->id }}">
                        <div class="col-lg-12">
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Rider Details</legend>
                                <div class="row entry-row mg-b-35">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ $rider->first_name }}" required>
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
                                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ $rider->last_name }}" required>
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
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ $rider->email }}" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Date of Birth:</label>
                                            <input class="form-control @error('date_of_birth') is-invalid @enderror" type="date" value="{{ $rider->riderDetail->date_of_birth }}" name="date_of_birth">
                                            @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Phone: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ $rider->phone }}" required>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Gender: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2 @error('gender') is-invalid @enderror" data-placeholder="Choose Gender" name="gender" required>
                                                <option label="Choose Gender"></option>
                                                <option value="male" @php echo ($rider->riderDetail->gender) ? 'selected' : ''; @endphp >Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('gender')
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
                                                <input type="file" id="file" class="custom-file-input" name="profile_photo"
                                                       onchange="readURL1(this);" >
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="one" class="mb-5" style="display: none;">
                                            </label>
                                        </div>
                                    </div><!-- col-4 -->
                                    @if(isset($rider->profile_photo))
                                        <div class="col-lg-4 col-sm-4">
                                            <img src="{{ asset('/storage/'.$rider->profile_photo) }}" style="width:80px; height:80px;">
                                        </div>
                                    @endif

                                </div>
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Riders Documents</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Driving License: </label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="driving_license[]"
                                                       onchange="readURL2(this);" multiple>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="two" class="mb-5" style="display: none;">
                                                <p id="multiple_select2"></p>
                                            </label>
                                        </div>
                                    </div><!-- col-4 -->

                                    @if(isset($rider->riderDetail->driving_license) && !empty($rider->riderDetail->driving_license))
                                        <div class="col-lg-4 col-sm-4">
                                            @foreach($rider->riderDetail->driving_license as $image)
                                                <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Photo ID Proof: <span class="tx-danger"></label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="photo_id_proof[]"
                                                       onchange="readURL3(this);" multiple>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="three" class="mb-5" style="display: none;">
                                                <p id="multiple_select3"></p>
                                            </label>
                                        </div>
                                    </div><!-- col-4 -->

                                    @if(isset($rider->riderDetail->photo_id_proof) && !empty($rider->riderDetail->photo_id_proof))
                                        <div class="col-lg-4 col-sm-4">
                                            @foreach($rider->riderDetail->photo_id_proof as $image)
                                                <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                            @endforeach
                                        </div>
                                    @endif


                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Vehicle Insurance: </label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="vehicle_insurance[]"
                                                       onchange="readURL4(this);" multiple>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="four" class="mb-5" style="display: none;">
                                                <p id="multiple_select4"></p>
                                            </label>
                                        </div>
                                    </div><!-- col-4 -->

                                    @if(isset($rider->riderDetail->vehicle_insurance) && !empty($rider->riderDetail->vehicle_insurance))
                                        <div class="col-lg-4 col-sm-4">
                                            @foreach($rider->riderDetail->vehicle_insurance as $image)
                                                <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Registration Certificate: </label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="registration_certificate[]"
                                                       onchange="readURL5(this);" multiple>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="five" class="mb-5" style="display: none;">
                                                <p id="multiple_select5"></p>
                                            </label>
                                        </div>
                                    </div><!-- col-4 -->

                                    @if(isset($rider->riderDetail->registration_certificate) && !empty($rider->riderDetail->registration_certificate))
                                        <div class="col-lg-4 col-sm-4">
                                            @foreach($rider->riderDetail->registration_certificate as $image)
                                                <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                            @endforeach
                                        </div>
                                    @endif

                                </div><!-- row -->
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Home Address</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('home_city') is-invalid @enderror" type="text" name="home_city" @if($rider->riderDetail->home_location != null) value="{{ $rider->riderDetail->home_location->city }}" @else placeholder="Enter City" @endif required>
                                            @error('home_city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('home_state') is-invalid @enderror" type="text" name="home_state"  @if($rider->riderDetail->home_location != null) value="{{ $rider->riderDetail->home_location->state }}" @else placeholder="Enter State" @endif required>
                                            @error('home_state')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('home_country') is-invalid @enderror" type="text" name="home_country" @if($rider->riderDetail->home_location != null) value="{{ $rider->riderDetail->home_location->country }}" @else placeholder="Enter Country" @endif required>
                                            @error('home_country')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Longitude: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('home_long') is-invalid @enderror" type="number" step="any" name="home_long" @if($rider->riderDetail->home_location != null) value="{{ $rider->riderDetail->home_location->long }}" @else placeholder="Enter Longitude" @endif required>
                                            @error('home_long')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Latitude: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('home_lat') is-invalid @enderror" type="number" step="any" name="home_lat" @if($rider->riderDetail->home_location != null) value="{{ $rider->riderDetail->home_location->lat }}" @else placeholder="Enter Latitude" @endif required>
                                            @error('home_lat')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Whole Address: </label>
                                            <input class="form-control" type="text" name="home_whole_address" @if($rider->riderDetail->home_location != null) value="{{ $rider->riderDetail->home_location->whole_address }}" @else placeholder="Enter Whole Address" @endif>
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Work Address</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('work_city') is-invalid @enderror" type="text" name="work_city" @if($rider->riderDetail->work_location != null) value="{{ $rider->riderDetail->work_location->city }}" @else placeholder="Enter City" @endif required>
                                            @error('work_city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('work_state') is-invalid @enderror" type="text" name="work_state" @if($rider->riderDetail->work_location != null) value="{{ $rider->riderDetail->work_location->state }}" @else placeholder="Enter State" @endif required>
                                            @error('work_state')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('work_country') is-invalid @enderror" type="text" name="work_country" @if($rider->riderDetail->work_location != null) value="{{ $rider->riderDetail->work_location->country }}" @else placeholder="Enter Country" @endif required>
                                            @error('work_country')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Longitude: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('work_long') is-invalid @enderror" type="number" step="any" name="work_long" @if($rider->riderDetail->work_location != null) value="{{ $rider->riderDetail->work_location->long }}" @else placeholder="Enter Longitude" @endif required>
                                            @error('work_long')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $messsage }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Latitude: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('work_lat') is-invalid @enderror" type="number" step="any" name="work_lat" @if($rider->riderDetail->work_location != null) value="{{ $rider->riderDetail->work_location->lat }}" @else placeholder="Enter Latitude" @endif required>
                                            @error('work_lat')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $messsage }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Whole Address: </label>
                                            <input class="form-control" type="text" name="work_whole_address" @if($rider->riderDetail->work_location != null) value="{{ $rider->riderDetail->work_location->whole_address }}" @else placeholder="Enter Whole Address" @endif >
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                        </div>

                        <div class="form-layout-footer text-center">
                            <button class="btn btn-info mg-r-5">Update</button>
                            <a href="{{ route('rider.index') }}" class="btn btn-secondary">Cancel</a>
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

        function readURL2(input) {
            const count = input.files.length;
            if(input.files.length > 1)
            {
                $('#two').hide();
                $('#multiple_select2').show();
                document.getElementById('multiple_select2').innerText = count+" file Selected.";
            }else{
                $('#two').show();
                $('#multiple_select2').hide();
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL3(input) {
            const count = input.files.length;
            if(input.files.length > 1)
            {
                $('#three').hide();
                $('#multiple_select3').show();
                document.getElementById('multiple_select3').innerText = count+" file Selected.";
            }else{
                $('#three').show();
                $('#multiple_select3').hide();
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL4(input) {
            const count = input.files.length;
            if(input.files.length > 1)
            {
                $('#four').hide();
                $('#multiple_select4').show();
                document.getElementById('multiple_select4').innerText = count+" file Selected.";
            }else{
                $('#four').show();
                $('#multiple_select4').hide();
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#four')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL5(input) {
            const count = input.files.length;
            if(input.files.length > 1)
            {
                $('#five').hide();
                $('#multiple_select5').show();
                document.getElementById('multiple_select5').innerText = count+" file Selected.";
            }else{
                $('#five').show();
                $('#multiple_select5').hide();
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#five')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
