@extends('layouts.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit Rider
                <a href=" {{route('rider.index')}}" class="btn btn-success btn-sm pull-right"> List Riders </a>
                </h6>
                <div class="form-layout mt-3">
                        <div class="col-lg-12">
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Rider Details</legend>
                                <div class="row entry-row mg-b-5">
                                    <div class="col-lg-2">
                                        <img src="{{ asset('/storage/'.$rider->profile_photo) }}" height="100px;" width="100px;">
                                    </div>

                                    <div class="row col-lg-8">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label">First Name: </label><br>
                                                <strong>{{ $rider->first_name }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label">Last Name: </label><br>
                                                <strong>{{ $rider->last_name }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label">Email address: </label><br>
                                                <strong>{{ $rider->email }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label">Date of Birth:</label><br>
                                                <strong>{{ $rider->riderDetail->date_of_birth }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Gender: </label><br>
                                                <strong>{{ $rider->riderDetail->gender }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Phone: </label><br>
                                                <strong>{{ $rider->phone }}</strong>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Riders Documents</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Driving License: </label><br>
                                            @if(isset($rider->riderDetail->driving_license) && !empty($rider->riderDetail->driving_license))
                                                @foreach($rider->riderDetail->driving_license as $image)
                                                    <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                                @endforeach

                                            @endif
                                        </div>
                                    </div><!-- col-6 -->



                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Photo ID Proof: </label><br>
                                            @if(isset($rider->riderDetail->photo_id_proof) && !empty($rider->riderDetail->photo_id_proof))
                                                @foreach($rider->riderDetail->photo_id_proof as $image)
                                                    <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div><!-- col-6 -->




                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Vehicle Insurance: </label><br>
                                            @if(isset($rider->riderDetail->vehicle_insurance) && !empty($rider->riderDetail->vehicle_insurance))
                                                @foreach($rider->riderDetail->vehicle_insurance as $image)
                                                    <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div><!-- col-6 -->



                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Registration Certificate: </label><br>
                                            @if(isset($rider->riderDetail->registration_certificate) && !empty($rider->riderDetail->registration_certificate))
                                                @foreach($rider->riderDetail->registration_certificate as $image)
                                                    <img src="{{ asset('/storage/'.$image) }}" class="mb-5" style="width:80px; height:80px;">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div><!-- col-6 -->

                                </div><!-- row -->
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Home Address</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">City: </label><br>
                                            @if($rider->riderDetail->home_location != null)
                                                <strong>{{ $rider->riderDetail->home_location->city }}</strong>
                                            @endif

                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">State: </label><br>
                                            @if($rider->riderDetail->home_location != null)
                                                <strong>{{ $rider->riderDetail->home_location->state }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Country: </label><br>
                                            @if($rider->riderDetail->home_location != null)
                                                <strong>{{ $rider->riderDetail->home_location->country }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Longitude: </label><br>
                                            @if($rider->riderDetail->home_location != null)
                                                <strong>{{ $rider->riderDetail->home_location->long }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Latitude: </label><br>
                                            @if($rider->riderDetail->home_location != null)
                                                <strong>{{ $rider->riderDetail->home_location->lat }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Whole Address: </label><br>
                                            @if($rider->riderDetail->home_location != null)
                                                <strong>{{ $rider->riderDetail->home_location->whole_address }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Work Address</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">City: </label><br>
                                            @if($rider->riderDetail->work_location != null)
                                                <strong>{{ $rider->riderDetail->work_location->city }}</strong>
                                            @endif

                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">State: </label><br>
                                            @if($rider->riderDetail->work_location != null)
                                                <strong>{{ $rider->riderDetail->work_location->state }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Country: </label><br>
                                            @if($rider->riderDetail->work_location != null)
                                                <strong>{{ $rider->riderDetail->work_location->country }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Longitude: </label><br>
                                            @if($rider->riderDetail->work_location != null)
                                                <strong>{{ $rider->riderDetail->work_location->long }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Latitude: </label><br>
                                            @if($rider->riderDetail->work_location != null)
                                                <strong>{{ $rider->riderDetail->work_location->lat }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Whole Address: </label><br>
                                            @if($rider->riderDetail->work_location != null)
                                                <strong>{{ $rider->riderDetail->work_location->whole_address }}</strong>
                                            @endif
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                        </div>

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
