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
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='mdi mdi-ticket text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">New Order</p>
                            </div>
                            <h4 class="mb-0">{{ $res->new_order }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='mdi mdi-package-variant text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Packing</p>
                            </div>
                            <h4 class="mb-0">{{ $res->packing }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='mdi mdi-truck text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Delivering</p>
                            </div>
                            <h4 class="mb-0">{{ $res->delivering }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='mdi mdi-check-circle text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Completed</p>
                            </div>
                            <h4 class="mb-0">{{ $res->completed }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='mdi mdi-close-circle text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Cancelled</p>
                            </div>
                            <h4 class="mb-0">{{ $res->cancelled }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='mdi mdi-ticket text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Total Orders</p>
                            </div>
                            <h4 class="mb-0">{{ $res->total_orders }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='bx bxs-package text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Total Products</p>
                            </div>
                            <h4 class="mb-0">{{ $res->total_products }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='bx bx-dollar text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Total Sales</p>
                            </div>
                            <h4 class="mb-0">RM {{ number_format($res->total_sales,2) }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class='mdi mdi-account-group text-primary font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Total Members</p>
                            </div>
                            <h4 class="mb-0">{{ $res->total_members }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-purple rounded">
                                        <i class="mdi mdi-hexagram text-purple font-size-24"></i>
                                    </span>
                                </div>
                                <p class="mt-2">Chief Distributors</p>
                            </div>
                            <h4 class="mb-0">{{ $res->chief_distributors }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-danger rounded">
                                        <i class='mdi mdi-star text-danger font-size-24'></i>
                                    </span>
                                </div>
                                <p class="mt-2">Exclusive Distributors</p>
                            </div>
                            <h4 class="mb-0">{{ $res->exclusive_distributors }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-warning rounded">
                                        <i class="mdi mdi-star-four-points text-warning font-size-24"></i>
                                    </span>
                                </div>
                                <p class="mt-2">General Distributors</p>
                            </div>
                            <h4 class="mb-0">{{ $res->general_distributors }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-success rounded">
                                        <i class="mdi mdi-star-three-points text-success font-size-24"></i>
                                    </span>
                                </div>
                                <p class="mt-2">Members</p>
                            </div>
                            <h4 class="mb-0">{{ $res->members }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class="mdi mdi-account-multiple-outline text-primary font-size-24"></i>
                                    </span>
                                </div>
                                <p class="mt-2">New Clients</p>
                            </div>
                            <h4 class="mb-0">{{ $res->clients }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class="bx bxs-coin-stack text-primary font-size-24"></i>
                                    </span>
                                </div>
                                <p class="mt-2">Pending Deposit</p>
                            </div>
                            <h4 class="mb-0">{{ $res->pending_deposit }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    <span class="avatar-title bg-soft-primary rounded">
                                        <i class="bx bxs-coin-stack text-primary font-size-24"></i>
                                    </span>
                                </div>
                                <p class="mt-2">Pending Withdrawal</p>
                            </div>
                            <h4 class="mb-0">{{ $res->pending_withdrawal }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
                                {{-- <div class="py-3 my-1">
                                    <div id="mini-1" data-colors='["#3980c0"]'></div>
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
