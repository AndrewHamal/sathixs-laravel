@extends('vendor_web.layouts.app')

@section('vendor_content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse mg-b-60">Vendor <span class="tx-info tx-normal"> Login</span></div>


            <form action="{{ route('webvendor.loggedin') }}" method="post">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }} }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
                    @endif
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">Sign In</button>
            </form>

        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection
