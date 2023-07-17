@extends('layouts.master-without_nav')

@section('title') @lang('translation.Register') @endsection

@section('content')

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="text-center mb-4">
                        <a href="index">
                            <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span class="logo-txt">Nonskin</span>
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Register Account</h5>
                                <p class="text-muted">Get your free Nonskin account now.</p>
                            </div>
                            <div class="p-2 mt-4">

                                @if(Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        {{Session::get('success')}}
                                    </div>
                                @endif

                                <form method="POST" class="form-horizontal" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="referral">Referral (Optional)</label>
                                        <input type="text" class="form-control @error('referral') is-invalid @enderror" id="referral" value="{{ old('referral') }}" name="referral" placeholder="e.g. NON000100" autofocus>
                                        @error('referral')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required" for="userfull_name">Full Name</label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="userfull_name" value="{{ old('full_name') }}" name="full_name" placeholder="e.g. John Lee Doe" autofocus>
                                        @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required" for="userid_no">Identification / Passport No.</label>
                                        <input type="text" class="form-control @error('id_no') is-invalid @enderror" id="userid_no" value="{{ old('id_no') }}" name="id_no" placeholder="e.g. 920102038888" autofocus>
                                        @error('id_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required" for="usercontact">Contact</label>
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="usercontact" value="{{ old('contact') }}" name="contact" placeholder="e.g. 01177778888" autofocus>
                                        @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required" for="useremail">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" value="{{ old('email') }}" name="email" placeholder="e.g. john.doe@yahoo.com" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required" for="username">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" name="username" autofocus placeholder="Enter username">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required" for="userpassword">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" name="password" placeholder="Enter password" autofocus>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required" for="password-confirm">Confirm Password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation" placeholder="Enter Confirm password" autofocus>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input @error('checkbox') is-invalid @enderror" name="checkbox" id="auth-terms-condition-check">
                                        <label class="form-check-label" for="auth-terms-condition-check">I accept <a href="javascript: void(0);" class="fw-medium text-primary">Terms and Conditions</a></label>
                                        @error('checkbox')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Register</button>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="avatar">Profile Picture</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="inputGroupFile02" name="avatar" autofocus>
                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                        </div>
                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 title">Sign in with</h5>
                                        </div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> --}}

                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">Already have an account ? <a href="{{ url('login') }}" class="fw-medium text-primary"> Login</a></p>
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
                        <p class="text-white-50">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Nonskin. Designed by Current Tech
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end container -->
</div>

@endsection
