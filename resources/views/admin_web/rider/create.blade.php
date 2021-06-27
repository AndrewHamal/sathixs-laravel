@extends('admin_web.layouts.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add Rider</h6>

                <div class="form-layout mt-3">
                    <form method="post" action="{{ route('rider.store')  }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Rider Details</legend>
                                <div class="row entry-row mg-b-35">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter firstname" required>
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
                                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter lastname" required>
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
                                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
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
                                            <input class="form-control @error('date_of_birth') is-invalid @enderror" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
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
                                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number" required>
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
                                                <option value="male" @php if( old('gender') == 'male') { echo 'selected';} @endphp>Male</option>
                                                <option value="female"  @php if( old('gender') == 'female') { echo 'selected';} @endphp>Female</option>
                                                <option value="other"  @php if( old('gender') == 'other') { echo 'selected';} @endphp>Other</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="*****" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="*****" required>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Profile Picture: <span class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input @error('profile_photo') is-invalid @enderror" name="profile_photo"
                                                       onchange="readURL1(this);" required="">
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="one" class="mb-5" style="display: none;">
                                            </label>
                                            @error('profile_photo')
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->

                                </div>
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Riders Documents</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Driving License: <span class="tx-danger">*</span> </label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="driving_license[]"
                                                       onchange="readURL2(this);" multiple required>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="two" class="mb-5" style="display: none;">
                                                <p id="multiple_select2"></p>
                                            </label>
                                            @error('driving_license')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Photo ID Proof: <span class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="photo_id_proof[]"
                                                       onchange="readURL3(this);" multiple required>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="three" class="mb-5" style="display: none;">
                                                <p id="multiple_select3"></p>
                                            </label>
                                            @error('photo_id_proof')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Vehicle Insurance: <span class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="vehicle_insurance[]"
                                                       onchange="readURL4(this);" multiple required>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="four" class="mb-5" style="display: none;">
                                                <p id="multiple_select4"></p>
                                            </label>
                                            @error('vehicle_insurance')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Registration Certificate: <span class="tx-danger">*</span></label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="registration_certificate[]"
                                                       onchange="readURL5(this);" multiple required>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="five" class="mb-5" style="display: none;">
                                                <p id="multiple_select5"></p>
                                            </label>
                                            @error('registration_certificate')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Home Address</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('home_city') is-invalid @enderror" type="text" name="home_city" value="{{ old('home_city') }}" placeholder="Enter City" required>
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
                                            <input class="form-control @error('home_state') is-invalid @enderror" type="text" name="home_state" value="{{ old('home_state') }}" placeholder="Enter State" required>
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
                                            <input class="form-control @error('home_country') is-invalid @enderror" type="text" name="home_country" value="{{ old('home_country') }}" placeholder="Enter Country" required>
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
                                            <input class="form-control @error('home_long') is-invalid @enderror" type="number" step="any" name="home_long" value="{{ old('home_long') }}" placeholder="Enter Longitude" required>
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
                                            <input class="form-control @error('home_lat') is-invalid @enderror" type="number" step="any" name="home_lat" value="{{ old('home_lat') }}" placeholder="Enter Latitude" required>
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
                                            <input class="form-control" type="text" name="home_whole_address" value="{{ old('home_whole_address') }}" placeholder="Enter Whole Address">
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
                                            <input class="form-control @error('work_city') is-invalid @enderror" type="text" name="work_city" value="{{ old('work_city') }}" placeholder="Enter City" required>
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
                                            <input class="form-control @error('work_state') is-invalid @enderror" type="text" name="work_state" value="{{ old('work_state') }}" placeholder="Enter State" required>
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
                                            <input class="form-control @error('work_country') is-invalid @enderror" type="text" name="work_country" value="{{ old('work_country') }}" placeholder="Enter Country" required>
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
                                            <input class="form-control @error('work_long') is-invalid @enderror" type="number" step="any" name="work_long" value="{{ old('work_long') }}" placeholder="Enter Longitude" required>
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
                                            <input class="form-control @error('work_lat') is-invalid @enderror" type="number" step="any" name="work_lat" value="{{ old('work_lat') }}" placeholder="Enter Latitude" required>
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
                                            <input class="form-control" type="text" name="work_whole_address" value="{{ old('work_whole_address') }}" placeholder="Enter Whole Address">
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                        </div>

                        <div class="form-layout-footer text-center">
                            <button class="btn btn-info mg-r-5" type="submit">Submit</button>
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
