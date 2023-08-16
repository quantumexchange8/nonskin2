@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Nonskin @endslot
    @slot('title') Dashboard @endslot
    @endcomponent



    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card bg-primary h-100">
                <div class="card-body">
                    <div class="text-center py-3">
                        <ul class="bg-bubbles ps-0">
                            <li><i class="bx bx-grid-alt font-size-24"></i></li>
                            <li><i class="bx bx-tachometer font-size-24"></i></li>
                            <li><i class="bx bx-store font-size-24"></i></li>
                            <li><i class="bx bx-cube font-size-24"></i></li>
                            <li><i class="bx bx-cylinder font-size-24"></i></li>
                            <li><i class="bx bx-command font-size-24"></i></li>
                            <li><i class="bx bx-hourglass font-size-24"></i></li>
                            <li><i class="bx bx-pie-chart-alt font-size-24"></i></li>
                            <li><i class="bx bx-coffee font-size-24"></i></li>
                            <li><i class="bx bx-polygon font-size-24"></i></li>
                        </ul>
                        <div class="main-wid position-relative">

                            <div class="d-flex justify-content-between">
                                <div>
                                    {{QrCode::size(110)->generate($user->url)}}
                                </div>
                                <div>
                                    <span class="h4 text-white text-end">{{ $user->full_name }}</span>
                                    <p class="text-white my-0 text-end">{{ $user->rank->name }}</p>
                                    <p class="text-white my-0 text-end">{{ $user->referrer_id }}</p>
                                </div>
                            </div>

                            <div class="mt-4 pt-2 mb-2">
                                <!-- QR Code -->
                                {{-- <button id="copyLink" class="btn border border-dark text-white" type="button">
                                    Referral Code
                                </button> --}}
                                {{-- <input id="refLink" type="text" class="form-control visually-hidden" placeholder="url" value="{{ $user->url }}" disabled
                                aria-label="" aria-describedby="basic-addon1" style="overflow: hidden;"> --}}

                                <div class="input-group">
                                    <input class="form-control" type="text" id="refLink" value="{{ $user->url }}" aria-describedby="basic-addon1" disabled>
                                    <button class="btn btn-dark" type="button" id="copyLink">Copy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-0">Purchase Wallet</h5>
                    <div class="row mt-4 mt-auto">
                        <div>
                            <h2>RM {{ number_format($user->commission_wallet, 2) }}</h2>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mt-4">
                            <a href="{{ route('member.deposit') }}" class="btn btn-primary w-100">Deposit</a>
                            <a href="{{ route('member.withdraw') }}" class="btn btn-primary w-100">Withdraw</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    @hasanyrole('user')
                    <div class="d-flex justify-content-between mb-3 p-2 border border-primary rounded wave-effects" role="button" data-bs-toggle="modal" data-bs-target="">
                        <h6 class="align-self-center">Cash Wallet</h6>
                        <h2>RM2,880.50</h2>
                    </div>
                    <div class="d-flex justify-content-between mb-3 p-2 border border-primary rounded" role="button" data-bs-toggle="modal" data-bs-target="">
                            <h6 class="align-self-center">Product Wallet</h6>
                            <h2>RM2,880.50</h2>
                    </div>
                    @endhasanyrole
                    @hasanyrole('superadmin|admin')
                    <div class="d-flex justify-content-between mb-3 p-2 border border-primary rounded wave-effects" role="button" data-bs-toggle="modal" data-bs-target="">
                        <h6 class="align-self-center">Total Group Sales</h6>
                        <h2>RM2,880.50</h2>
                    </div>
                    <div class="d-flex justify-content-between mb-3 p-2 border border-primary rounded wave-effects" role="button" data-bs-toggle="modal" data-bs-target="">
                        <h6 class="align-self-center">Total Withdrawals</h6>
                        <h2>RM2,880.50</h2>
                    </div>
                    <div class="d-flex justify-content-between mb-3 p-2 border border-primary rounded" role="button" data-bs-toggle="modal" data-bs-target="">
                            <h6 class="align-self-center">Total Net Profit</h6>
                            <h2>RM2,880.50</h2>
                    </div>
                    @endhasanyrole
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class='bx bx-dollar text-primary font-size-24'></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Commission</p>
                            <h4 class="mt-1 mb-0">RM 1,888.50 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
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
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-account-multiple-outline text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Group Sales</p>
                            <h4 class="mt-1 mb-0">RM 2,888.50 <!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 19%</sup> --></h4>
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
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class='bx bxs-hand-down text-primary font-size-24'></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Downline Sales</p>
                            <h4 class="mt-1 mb-0">RM 3,888.50 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 22%</sup> --></h4>
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
                                    <i class="bx bxs-purchase-tag text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Purchase</p>
                            <h4 class="mt-1 mb-0">RM 13,888.50 <!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 18%</sup> --></h4>
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
                                    <i class="bx bx-dollar-circle text-primary font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Commission Withdrawn</p>
                            <h4 class="mt-1 mb-0">RM 5,888.50 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 22%</sup> --></h4>
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
                            <p class="text-muted mt-4 mb-0">Total Referrals</p>
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

        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-2 col-md-6">
                    <div class="card">
                        <div class="card-body" role="button" data-bs-toggle="modal" data-bs-toggle="">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class='bx bx-dollar text-primary font-size-24'></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Monthly Bonus</p>
                            <h4 class="mt-1 mb-0">RM 588 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
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
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-account-multiple-outline text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Quarterly Bonus</p>
                            <h4 class="mt-1 mb-0">RM 1,088 <!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 19%</sup> --></h4>
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
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class='bx bxs-hand-down text-primary font-size-24'></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Annually Bonus</p>
                            <h4 class="mt-1 mb-0">RM 3,088 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 22%</sup> --></h4>
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
                                    <i class="bx bxs-purchase-tag text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Purchase</p>
                            <h4 class="mt-1 mb-0">RM 13,888.50 <!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 18%</sup> --></h4>
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
                                    <i class="bx bx-dollar-circle text-primary font-size-24"></i>
                                </span>
                            </div>
                            <p class="text-muted mt-4 mb-0">Total Commission Withdrawn</p>
                            <h4 class="mt-1 mb-0">RM 5,888.50 <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 22%</sup> --></h4>
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
                            <p class="text-muted mt-4 mb-0">New Users</p>
                            <h4 class="mt-1 mb-0">RM 6,888.50 <!-- <sup class="text-danger fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 18%</sup> --></h4>
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
