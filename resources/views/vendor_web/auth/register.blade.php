@extends('vendor_web.layouts.app')

@section('vendor_content')

    <body class="bg-gradient-primary">
        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <form class="user" method="post" action="{{ route('webvendor.register') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user @error('first_name') is-invalid @enderror"
                                                   value="{{ old('first_name') }}" name="first_name" id="exampleFirstName" placeholder="First Name" required>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user @error('last_name') is-invalid @enderror"
                                                   value="{{ old('last_name') }}" name="last_name" id="exampleLastName" placeholder="Last Name" required>
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" name="email" id="exampleInputEmail" placeholder="Email Address" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user @error('phone') is-invalid @enderror"
                                               name="phone" value="{{ old('phone') }}" id="exampleInputPhone" placeholder="Phone Number" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                   name="password" id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                   id="exampleRepeatPassword" name="password_confirmation" placeholder="Repeat Password">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" type="submit">
                                        Register Account
                                    </button>
                                    <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('webvendor.login') }}">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>

@endsection
