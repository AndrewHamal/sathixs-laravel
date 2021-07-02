@extends('vendor_web.layouts.app')

@section('vendor_dash')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('webvendor.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Packages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Package</li>
            </ol>
        </nav>
        <div class="card shadow">
            <h6 class="mt-3 ml-3 font-weight-bold">Edit Package</h6>
            <div class="card-body">
                <form method="post" action="{{ url('webvendor/package/'.$package->id)  }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-12 row">
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <select class="form-control" name="category_id" id="category" required>
                                    <option>What are my sending?</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @php if($category->id == $package->category_id){echo 'selected';} @endphp>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" class="form-control @error('no_of_package') is-invalid @enderror"
                                       value="{{ $package->no_of_package }}" name="no_of_package" id="no_of_package" placeholder="Number of Packages?" min="1" required>
                                @error('no_of_package')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('receiver_name') is-invalid @enderror"
                                       value="{{ $package->receiver_name }}" name="receiver_name" id="receiver_name" placeholder="Enter receiver's name" required>
                                @error('receiver_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('receiver_address') is-invalid @enderror"
                                       value="{{ $package->receiver_address }}" name="receiver_address" id="receiver_address" placeholder="Enter receiver's Address" required>
                                @error('receiver_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('receiver_phone') is-invalid @enderror"
                                       value="{{ $package->receiver_phone }}" name="receiver_phone" id="receiver_phone" placeholder="Enter receiver's Phone" required>
                                @error('receiver_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" class="form-control @error('product_price') is-invalid @enderror"
                                       value="{{ $package->product_price }}" name="product_price" id="product_price" placeholder="Product Price" min="1" step="0.01" required>
                                @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control @error('weight') is-invalid @enderror"
                                       value="{{ $package->weight }}" name="weight" id="weight" placeholder="Weights in kg" required>
                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea class="form-control" name="special_instruction" rows="3" placeholder="Special Instruction">{!! $package->special_instruction !!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="file">Upload Image</label>
                                <input type="file" class="form-control-file" id="file" name="image[]" onchange="readURL(this);" multiple>
                                <img src="#" id="one" class="mb-5" style="display: none;">
                                <p id="multiple_select1"></p>

                                @error('image')
                                <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if(isset($package->package_file) && !empty($package->package_file))
                                    @foreach($package->package_file as $image)
                                        <img src="{{ asset('/storage/'.$image->path) }}" class="mb-5" style="width:80px; height:80px;">
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        @php
                            foreach($package->package_file as $row){
                                echo '<input type="hidden" value="'.$row->id.'" name="arr_ids[]">';
                            }
                        @endphp

                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-success" type="submit">Update</button>
                        <a href="{{ route('package.index') }}" class="btn btn-danger">Cancel</a>
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

    </script>
@endsection

