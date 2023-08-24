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

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center mb-3">
                                <h5 class="card-title mb-0">Orders Statistics</h5>
                                <div class="ms-auto">
                                    {{-- <div class="dropdown">
                                        <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted font-size-12">Sort By:</span> <span class="fw-medium">Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#">Daily</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Yearly</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <a href="{{ route('orders.listing') }}">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <i class="mdi mdi-circle font-size-10 mt-1 text-primary"></i>
                                            <div class="flex-1 ms-2">
                                                <p class="mb-0">New Order</p>
                                                <h5 class="mt-1 mb-0 font-size-16">{{ $res->new_order ?? 0 }}</h5>
                                            </div>
                                        </div>
                                        <div>
                                            {{-- <span class="badge badge-soft-danger">25.4%<i class="mdi mdi-arrow-down ms-2"></i></span> --}}
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-warning"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Packing</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->packing ?? 0 }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-danger">17.4%<i class="mdi mdi-arrow-down ms-2"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-secondary"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Delivering</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->delivering ?? 0 }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-success">16.3%<i class="mdi mdi-arrow-up ms-1"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-success"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Completed</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->completed ?? 0 }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-success">65.7%<i class="mdi mdi-arrow-up ms-1"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-danger"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Cancelled</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->cancelled ?? 0 }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-success">65.7%<i class="mdi mdi-arrow-up ms-1"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center mb-3">
                                <h5 class="card-title mb-0">Members Statistics</h5>
                                <div class="ms-auto">
                                    {{-- <div class="dropdown">
                                        <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted font-size-12">Sort By:</span> <span class="fw-medium">Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#">Daily</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Yearly</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-primary"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Chief Distributors</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->chief_distributors }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-danger">25.4%<i class="mdi mdi-arrow-down ms-2"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-warning"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Exclusive Distributors</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->exclusive_distributors }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-danger">17.4%<i class="mdi mdi-arrow-down ms-2"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-secondary"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">General Distributors</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->general_distributors }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-success">16.3%<i class="mdi mdi-arrow-up ms-1"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-success"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Members</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->members }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-success">65.7%<i class="mdi mdi-arrow-up ms-1"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <i class="mdi mdi-circle font-size-10 mt-1 text-danger"></i>
                                        <div class="flex-1 ms-2">
                                            <p class="mb-0">Clients</p>
                                            <h5 class="mt-1 mb-0 font-size-16">{{ $res->clients }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        {{-- <span class="badge badge-soft-success">65.7%<i class="mdi mdi-arrow-up ms-1"></i></span> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-3 col-md-6">
                    <a href="{{ route('orders.listing') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="avatar">
                                        <span class="avatar-title bg-soft-primary rounded">
                                            <i class='mdi mdi-ticket text-primary font-size-24'></i>
                                        </span>
                                    </div>
                                    <h4 class="mt-2">{{ $res->new_order ?? 0 }}</h4>
                                </div>
                                <p class="mb-0"> New Order</p><!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></p>
                                <div>
                                </div>
                            </div>
                        </div>
                    </a>
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
                            <h4 class="mb-0">{{ $res->packing ?? 0 }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
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
                            <h4 class="mb-0">{{ $res->delivering ?? 0 }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
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
                            <h4 class="mb-0">{{ $res->completed ?? 0 }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
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
                            <h4 class="mb-0">{{ $res->cancelled ?? 0 }} <!-- <sup class="text-success fw-medium font-size-14"><i class="mdi mdi-arrow-down"></i> 10%</sup> --></h4>
                            <div>
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
                            </div>
                        </div>
                    </div>
                </div> --}}
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
