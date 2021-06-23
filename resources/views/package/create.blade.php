@extends('layouts.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add Package</h6>

                <div class="form-layout mt-3">
                    <form method="post" action="{{ route('admin_package.store')  }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Package Details</legend>
                                <div class="row entry-row mg-b-35">
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2 @error('category_id') is-invalid @enderror" data-placeholder="Choose Category" name="category_id" required>
                                                <option label="Choose Category"></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Select Vendor: <span class="tx-danger">*</span></label>
                                            <select class="form-control select2 @error('vendor_id') is-invalid @enderror" data-placeholder="Choose Vendor" name="vendor_id" required>
                                                <option label="Choose Vendor"></option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->first_name.' '.$vendor->last_name }} ({{ $vendor->phone }})</option>
                                                @endforeach
                                            </select>

                                            @error('vendor_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">No. of Package: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('no_of_package') is-invalid @enderror" type="number" value="{{ old('no_of_package') }}" name="no_of_package" required>

                                            @error('no_of_package')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Weight: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('weight') is-invalid @enderror" type="text" value="{{ old('weight') }}" name="weight" required>

                                            @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Product Price: <span class="tx-danger">*</span></label>
                                            <input class="form-control @error('product_price') is-invalid @enderror" type="number" step="any" name="product_price" value="{{ old('product_price') }}"  required>
                                            @error('product_price')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Package File: <span class="tx-danger">*</span> </label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input" name="image[]"
                                                       onchange="readURL2(this);" multiple required>
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="two" class="mb-5" style="display: none;">
                                                <p id="multiple_select2"></p>
                                            </label>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                </div>
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Receiver Details</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Receiver Name: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('receiver_name') is-invalid @enderror" type="text" value="{{ old('receiver_name') }}" name="receiver_name" required>

                                            @error('receiver_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Receiver Address: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('receiver_address') is-invalid @enderror" type="text" value="{{ old('receiver_address') }}" name="receiver_address" required>

                                            @error('receiver_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Receiver Phone: <span class="tx-danger">*</span></label>
                                            <input class="form-control  @error('receiver_phone') is-invalid @enderror" type="text" value="{{ old('receiver_phone') }}" name="receiver_phone" required>

                                            @error('receiver_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Special Instruction: </label>
                                            <input class="form-control  @error('special_instruction') is-invalid @enderror" type="text" value="{{ old('special_instruction') }}" name="special_instruction" >

                                            @error('special_instruction')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div><!-- row -->
                            </fieldset>
                            <fieldset class="custom-fieldset mg-b-20">
                                <legend>Receipt</legend>
                                <div class="row entry-row mg-b-25">
                                    <div class="col-lg-6">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Receiver Signature Name: </label>
                                            <input class="form-control  @error('receiver_signature_name') is-invalid @enderror" type="text" value="{{ old('receiver_signature_name') }}" name="receiver_signature_name">

                                            @error('receiver_signature_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group ">
                                            <label class="form-control-label">Receiver Signature: </label>
                                            <label class="custom-file">
                                                <input type="file" id="file" class="custom-file-input @error('receiver_signature_image') is-invalid @enderror" name="receiver_signature_image"
                                                       onchange="readURL1(this);" >
                                                <span class="custom-file-control"></span>
                                                <img src="#" id="one" class="mb-5" style="display: none;">
                                            </label>
                                            @error('receiver_signature_image')
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </fieldset>
                        </div>

                        <div class="form-layout-footer text-center">
                            <button class="btn btn-info mg-r-5" type="submit">Submit</button>
                            <a href="{{ route('admin_package.index') }}" class="btn btn-secondary">Cancel</a>
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

    <script type="text/javascript">
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
    </script>

@endsection
