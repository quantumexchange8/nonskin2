@extends('layouts.master-without_nav')

@section('title')@lang('translation.Email_Verification')@endsection

@section('content')

        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">

                            <div class="text-center mb-4">
                                <a href="index">
                                    <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span class="logo-txt">Symox</span>
                                </a>
                        </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-3">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="mt-4 pt-2">
                                            <h4>Verify your email</h4>
                                            <p>We have sent you verification email <span class="fw-bold">example@abc.com</span>, Please check it</p>
                                            <div class="mt-4">
                                                <a href="index" class="btn btn-primary w-10">Verify email</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Didn't receive an email ? <a href="#"
                                                class="text-primary fw-semibold"> Resend </a> </p>
                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center text-muted p-4">
                                <p class="text-white-50">© <script>document.write(new Date().getFullYear())</script> Symox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- end container -->
        </div>

@endsection
