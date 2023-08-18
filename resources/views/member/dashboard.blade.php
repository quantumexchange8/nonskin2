@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Nonskin @endslot
    @slot('title') Dashboard @endslot
    @endcomponent

    <div class="container-fluid container-row">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-end font-size-18">PURCHASE WALLET</h5>
                        <p class="text-end mb-0">Available Balance</p>
                        <div class="row mt-auto">
                            <div>
                                <h2>RM {{ number_format($user->purchase_wallet,2) }}</h2>
                            </div>
                            <div class="d-flex justify-content-between gap-3 mt-4">
                                <a href="{{ route('member.deposit') }}" class="btn btn-primary w-100">Deposit Fund</a>
                                <a href="{{ route('member.withdraw') }}" class="btn btn-primary w-100">Withdraw Fund</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class="bx bxs-coin-stack text-primary font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Cash Wallet</p>
                        </div>
                        <h2 class="mb-0 mt-5">RM {{ number_format($user->cash_wallet,2) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-primary rounded">
                                    <i class="bx bxs-coin-stack text-primary font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Product Wallet</p>
                        </div>
                        <h2 class="mb-0 mt-5">RM {{ number_format($user->product_wallet,2) }}</h2>
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
                                @switch($user->rank->name)
                                    @case($user->rank->name == 'Member')
                                        <span class="avatar-title bg-soft-success rounded">
                                            <i class="mdi mdi-star-three-points text-success font-size-24"></i>
                                        </span>
                                        @break
                                    @case($user->rank->name == 'General Distributor')
                                        <span class="avatar-title bg-soft-warning rounded">
                                            <i class="mdi mdi-star-four-points text-warning font-size-24"></i>
                                        </span>
                                        @break
                                    @case($user->rank->name == 'Exclusive Distributor')
                                        <div class="avatar">
                                            <span class="avatar-title bg-soft-danger rounded">
                                                <i class='mdi mdi-star text-danger font-size-24'></i>
                                            </span>
                                        </div>
                                        @break
                                    @case($user->rank->name == 'Chief Distributor')
                                        <div class="avatar">
                                            <span class="avatar-title bg-soft-purple rounded">
                                                <i class="mdi mdi-hexagram text-purple font-size-24"></i>
                                            </span>
                                        </div>
                                        @break
                                    @default
                                        <span class="avatar-title bg-soft-primary rounded">
                                            <i class="mdi mdi-account text-primary font-size-24"></i>
                                        </span>
                                @endswitch
                            </div>
                            <p class="mt-2">Personal Ranking</p>
                        </div>
                        <h4 class="mb-0">{{ $user->rank->name }}</h4>
                    </div>
                </div>
            </div>
            @if ($next_rank !== 'Client')
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="avatar">
                                    @switch($next_rank)
                                        @case($next_rank == 'Member')
                                            <span class="avatar-title bg-soft-success rounded">
                                                <i class="mdi mdi-star-three-points text-success font-size-24"></i>
                                            </span>
                                            @break
                                        @case($next_rank == 'General Distributor')
                                            <span class="avatar-title bg-soft-warning rounded">
                                                <i class="mdi mdi-star-four-points text-warning font-size-24"></i>
                                            </span>
                                            @break
                                        @case($next_rank == 'Exclusive Distributor')
                                            <div class="avatar">
                                                <span class="avatar-title bg-soft-danger rounded">
                                                    <i class='mdi mdi-star text-danger font-size-24'></i>
                                                </span>
                                            </div>
                                            @break
                                        @case($next_rank == 'Chief Distributor')
                                            <div class="avatar">
                                                <span class="avatar-title bg-soft-purple rounded">
                                                    <i class="mdi mdi-hexagram text-purple font-size-24"></i>
                                                </span>
                                            </div>
                                            @break
                                        @default
                                            <span class="avatar-title bg-soft-primary rounded">
                                                <i class="mdi mdi-account text-primary font-size-24"></i>
                                            </span>
                                    @endswitch
                                </div>
                                <p class="mt-2">Next Rank</p>
                            </div>
                            <h4 class="mb-0">{{ $next_rank }}</h4>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-gift text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Current Bonus</p>
                        </div>
                        <h4 class="mb-0">RM 150</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-gift text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Next Bonus</p>
                        </div>
                        <h4 class="mb-0">RM 500</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-lan text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Total Referrals</p>
                        </div>
                        <h4 class="mb-0">{{ $referral }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Total Commission</p>
                        </div>
                        <h4 class="mb-0">RM 1,088.00</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Total Sales</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-0">RM 1,888.88</h4>
                            <p class="mb-0 mt-1">RM 600 to rank up</p>
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
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Daily Sales</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-0">RM 1,888.88</h4>
                            <p class="mb-0 mt-1">RM 600 to rank up</p>
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
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Quarterly Sales</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-0">RM 1,888.88</h4>
                            <p class="mb-0 mt-1">RM 600 to rank up</p>
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
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2">Annual Sales</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h4 class="mb-0">RM 1,888.88</h4>
                            <p class="mb-0 mt-1">RM 600 to rank up</p>
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
