@extends('layouts.master-without_nav')

@section('title')@lang('translation.Login')@endsection

{{-- @section('content')

@include('modals.create-member') --}}

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="text-center mb-4">
                        <img src="{{ URL::asset('assets/images/nonskin/non-logo.jpg') }}" alt="" height="100"> <span class="logo-txt"></span>
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to Nonskin.</p>
                            </div>
                            <div class="p-2 mt-4">

                                @if (session('added'))
                                <div class="alert alert-success text-center">
                                    {{ session('added') }}
                                </div>
                                @endif
                                @if (session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email"  placeholder="Enter Email" autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                            @endif
                                        </div>
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember"> Remember me </label>
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Do not have an account ? <a href="{{ route('user-register') }}" class="fw-medium text-primary"> Signup
                                                now </a> </p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-muted p-4">
                        ©
                        <script>
                            document.write(new Date().getFullYear())

                        </script> Nonskin</p>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end container -->
</div>

{{-- @endsection --}}

