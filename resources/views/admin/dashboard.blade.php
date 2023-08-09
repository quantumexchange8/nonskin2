@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Nonskin @endslot
    @slot('title') Dashboard @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class='mdi mdi-account-group text-primary font-size-24'></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Overall User</p>
                            <h4 class="mt-1 mb-0"> 3,888 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-purple rounded">
                                    <i class="mdi mdi-hexagram text-purple font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Chief Distributor</p>
                            <h4 class="mt-1 mb-0">88 <!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 19%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-2" data-colors='["#33a186"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-danger rounded">
                                    <i class='mdi mdi-star text-danger font-size-24'></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Exclusive Distributor</p>
                            <h4 class="mt-1 mb-0">188 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 22%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-3" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-warning rounded">
                                    <i class="mdi mdi-star-four-points text-warning font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total General Distributor</p>
                            <h4 class="mt-1 mb-0">888<!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 18%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-4" data-colors='["#33a186"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class="mdi mdi-star-three-points text-primary font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Members</p>
                            <h4 class="mt-1 mb-0">2,888 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 22%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-3" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-account-multiple-outline text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">New User</p>
                            <h4 class="mt-1 mb-0">88 <!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 18%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-4" data-colors='["#33a186"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('assets/js/pages/chartjs.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
         $(document).ready(function () {
            var copyText = document.getElementById("refLink");
            
            $("#copyLink").click(function () {
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text inside the text field
                navigator.clipboard.writeText(copyText.value);

                // Alert the copied text
                Swal.fire({
                    icon: 'success',
                    title: 'Link Copied!',
                    text: 'The referral link has been copied to your clipboard.',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true,
                    onClose: () => {
                        // You can add custom actions to perform after the alert is closed
                        console.log('Alert closed');
                    }
                });
            });
        });
    </script>
@endsection