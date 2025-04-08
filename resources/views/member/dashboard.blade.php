@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('user-dashboard') }} @endslot
    @slot('li_1') Nonskin @endslot
    @slot('title') Dashboard @endslot
    @endcomponent

    @if (session('show_announcement'))
        @foreach ($announcements as $k => $v)
            @include('member.modals.announcement-detail')
        @endforeach
        {{-- @php
            dd($announcements);
        @endphp --}}
        @if (!empty($announcements))
            @include('member.modals.announcement-popup')
        @endif
    @endif

    <div class="container-fluid container-row">
        <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 d-flex align-items-stretch">
                <div class="card bg-primary w-100">
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

                                <div class="d-flex justify-content-between text-end">
                                    <div>
                                        {{QrCode::size(110)->generate($user->url)}}
                                    </div>
                                    <div>
                                        <span class="h4 text-white text-end">{{ $user->full_name }}</span>
                                        <p class="text-white my-0 text-end">{{ $user->rank->name }}</p>
                                        <p class="text-white my-0 text-end">{{ $user->referrer_id }}</p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <!-- QR Code -->
                                    {{-- <button id="copyLink" class="btn border border-dark text-white" type="button">
                                        Referral Code
                                    </button> --}}
                                    {{-- <input id="refLink" type="text" class="form-control visually-hidden" placeholder="url" value="{{ $user->url }}" disabled
                                    aria-label="" aria-describedby="basic-addon1" style="overflow: hidden;"> --}}

                                    <div class="input-group">
                                        <input class="form-control" type="text" id="refLink" value="{{ $user->url }}" aria-describedby="basic-addon1" disabled>
                                        <button class="btn btn-dark" type="button" id="copyLink">@lang('translation.Copy')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-end font-size-18">@lang('translation.Purchase Wallet')</h5>
                        <p class="text-end mb-0">@lang('translation.Available Balance')</p>
                        <div class="row mt-auto">
                            <div>
                                <h2>RM {{ number_format($user->purchase_wallet,2) }}</h2>
                            </div>
                            <div class="d-flex justify-content-between gap-3 mt-4">
                                <a href="{{ route('member.deposit') }}" class="btn btn-primary w-100">@lang('translation.Deposit Fund')</a>
                                <a href="{{ route('member.withdraw') }}" class="btn btn-primary w-100">@lang('translation.Withdraw Fund')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div style="width: 175px;">
                                <h5 class="card-title mb-2 font-size-18">COMMISSIONS AND VOUCHERS</h5>
                                <p class="mt-5 card-text">@lang('translation.Cash Wallet')</p>
                                <p class="mt-5 card-text">@lang('translation.Product Wallet')</p>
                            </div>
                            <div>
                                <div></div>
                                <div class="d-flex justify-content-between gap-3 mt-4">
                                    <form action="{{ route('redeem-commission') }}" method="POST" id="redeem-form">
                                        @csrf
                                        <h4 class="mb-0 mt-5">RM {{ number_format($user->cash_wallet,2) }}</h4>
                                        <button class="btn btn-primary 2-100 btn-redeem" type="submit" id="redeem-button">
                                            Redeem
                                        </button>
                                    </form>
                                </div>
                                <h4 class="mt-5 mb-0">RM {{ number_format($user->product_wallet, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
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
            </div> --}}
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center mb-3">
                            <h5 class="card-title mb-0">@lang('translation.Performance Statistics')</h5>
                            <div class="ms-auto">
                                <div class="dropdown">
                                    {{-- <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted font-size-12">Sort By:</span> <span class="fw-medium">Monthly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" href="#">Daily</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Yearly</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Personal Sales to Maintain Rank -->
                        @if ($user->rank->name !== 'Client')
                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        {{-- <i class="mdi mdi-circle font-size-10 mt-1 text-warning"></i> --}}
                                        <div class="flex-1">
                                            <p class="mb-0">@lang('translation.Personal Sales')</p>
                                            <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->personal_sales,2) }}</h5>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex-1 text-end">
                                            @if(($user->personal_sales/$user->rank->personal_sales)*100 >= 100)
                                                <span class="badge badge-soft-success">@lang('translation.RANKING MAINTAINED')</span>
                                            @else
                                                <span class="badge badge-soft-danger">@lang('translation.UNQUALIFIED')</span>
                                            @endif
                                                <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->personal_sales,2) }}</h5>
                                            {{-- @switch($user->rank->name)
                                                @case($user->rank->name == 'Member')
                                                    <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $user->rank->personal_sales }}</h5>
                                                    @break
                                                @case($user->rank->name == 'General Distributor')
                                                    <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $user->rank->personal_sales }}</h5>
                                                    @break
                                                @case($user->rank->name == 'Exclusive Distributor')
                                                    <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $user->rank->personal_sales }}</h5>
                                                    @break
                                                @case($user->rank->name == 'Chief Distributor')
                                                    <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $user->rank->personal_sales }}</h5>
                                                    @break
                                                @default
                                                    <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $user->rank->personal_sales }}</h5>
                                            @endswitch --}}
                                        </div>
                                        {{-- <span class="badge badge-soft-success">RM {{ number_format($user->personal_sales,2) }}</span> --}}
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 15px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $user->personal_sales == 0 ? 0 : min(($user->personal_sales/$user->rank->personal_sales)*100, 100) }}%;"
                                        aria-valuenow="{{ $user->personal_sales }}"
                                        aria-valuemin="0"
                                        aria-valuemax="{{ $user->rank->personal_sales }}">
                                        {{ $user->personal_sales == 0 ? 0 : number_format(min(($user->personal_sales/$user->rank->personal_sales)*100, 100), 2) }}%
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Current Rank vs Next Rank Target -->
                        <div class="mt-3 border-top pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <p class="mb-0">Current Level</p>
                                        <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $user->rank->name }}</h5>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex-1 text-end">
                                        @if ($user->rank->name !== 'Chief Distributor')
                                            <p class="mb-0">Next Level</p>
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $next_rank->name }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Package Requirement -->
                        @if($user->status == 'NotActive' || $user->personal_sales == null)
                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        {{-- <i class="mdi mdi-circle font-size-10 mt-1 text-secondary"></i> --}}
                                        <div class="flex-1 ">
                                            <p class="mb-0">Package Requirement</p>
                                            <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->package_sales,2) }}</h5>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-end">
                                        @if(($user->package_sales == 0 ? 0 : $user->package_sales/$next_rank->package_requirement)*100 >= 100)
                                            <span class="badge badge-soft-success">QUALIFIED</span>
                                        @else
                                            <span class="badge badge-soft-danger">NOT YET QUALIFIED</span>
                                        @endif
                                        <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($next_rank->package_requirement,2) }}</h5>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 15px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $user->package_sales > 0 ? ($user->package_sales/$next_rank->package_requirement)*100 : 0 }}%;"
                                        aria-valuenow="{{ $user->package_sales }}"
                                        aria-valuemin="0"
                                        aria-valuemax="{{ $next_rank->package_requirement }}">
                                        {{ $user->package_sales == 0 ? 0 : number_format(($user->package_sales/$next_rank->package_requirement)*100,2) }}%
                                    </div>
                                </div>
                            </div>
                        @else

                            <div class="mt-3 border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        {{-- <i class="mdi mdi-circle font-size-10 mt-1 text-secondary"></i> --}}
                                        <div class="flex-1 ">
                                            <p class="mb-0">Package Requirement</p>
                                            <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->package_sales,2) }}</h5>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-end">
                                        @if($next_rank)
                                            @if($next_rank->package_requirement > 0 && ($user->package_sales / $next_rank->package_requirement) * 100 >= 100)
                                                <span class="badge badge-soft-success">QUALIFIED</span>
                                            @else
                                                <span class="badge badge-soft-danger">NOT YET QUALIFIED</span>
                                            @endif
                                            @if($next_rank->package_requirement)
                                                <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($next_rank->package_requirement,2) }}</h5>
                                            @else
                                                <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($next_rank->package_requirement,2) }}</h5>
                                            @endif
                                        @else
                                            <h5 class="mt-1 mb-0 font-size-14">Max</h5>
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 15px;">
                                    @if($next_rank)
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ ($next_rank->package_requirement > 0 && $user->package_sales > 0) ? min(($user->package_sales / $next_rank->package_requirement) * 100, 100) : 0 }}%;"
                                            aria-valuenow="{{ $user->package_sales }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ $next_rank->package_requirement > 0 ? $next_rank->package_requirement : 100 }}">
                                            {{ ($next_rank->package_requirement > 0 && $user->package_sales > 0) ? number_format(min(($user->package_sales / $next_rank->package_requirement) * 100, 100), 2) : '0.00' }}%
                                        </div>
                                    @else
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ 100 }}%;"
                                            aria-valuenow="{{ $user->package_sales }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ 100 }}">
                                            {{ 100 }}%
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>

                            <!-- Group Sales Requirement -->
                            @if ($user->rank->name !== 'Client' && $user->rank->name !== 'Chief Distributor')
                                <div class="mt-3 border-top pt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            {{-- <i class="mdi mdi-circle font-size-10 mt-1 text-success"></i> --}}
                                            <div class="flex-1 ">
                                                <p class="mb-0">Group Sales Requirement</p>
                                                <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->group_sales,2) }}</h5>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-end">
                                            @if(($user->group_sales == 0 ? 0 : $user->group_sales/$next_rank->group_sale_requirement)*100 >= 100)
                                                <span class="badge badge-soft-success">QUALIFIED</span>
                                            @else
                                                <span class="badge badge-soft-danger">NOT YET QUALIFIED</span>
                                            @endif
                                            <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($next_rank->group_sale_requirement,2) }}</h5>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 15px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ ($user->group_sales == 0 ? 0 : $user->group_sales/$next_rank->group_sale_requirement)*100 }}%;"
                                            aria-valuenow="{{ ($user->group_sales == 0 ? 0 : $user->group_sales/$next_rank->group_sale_requirement)*100 }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                            @if (isset($user->group->sales))
                                                {{ ($user->group_sales > 0 ? 0 : $user->group_sales/$next_rank->group_sale_requirement)*100 }}%
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        

                        <!-- Product Discount Entitlement -->
                        <div class="mt-3 border-top pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    {{-- <i class="mdi mdi-circle font-size-10 mt-1 text-danger"></i> --}}
                                    <div class="flex-1 ">
                                        <p class="mb-0">Product Discount Entitlement</p>
                                        <h5 class="mt-1 mb-0 font-size-14">{{ $user->rank->level_discount }} %</h5>
                                    </div>
                                </div>
                                {{-- @if ($user->rank->level !== 5)
                                    <div class="flex-1 text-end">
                                        @if(($user->personal_sales/$user->rank->personal_sales)*100 >= 100)
                                            <span class="badge badge-soft-success">QUALIFIED</span>
                                        @else
                                            <span class="badge badge-soft-danger">NOT YET QUALIFIED</span>
                                        @endif
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">{{ $next_rank->level_discount }} %</h5>
                                    </div>
                                @endif --}}
                            </div>
                            {{-- <div class="progress mt-2">
                                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
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
            </div> --}}
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
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
            </div> --}}
            {{-- personal sale --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2" style="width: 100px;text-align: right;">Current Month Personal Sales</p>
                        </div>
                        <div class="mt-3 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <p class="mb-0">@lang('translation.Personal Sales')</p>
                                        <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->monthly_personal_sale, 2) }}</h5>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex-1 text-end">
                                        <p class="mb-0">@lang('translation.Target')</p>
                                        @if ($next_rank)
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->personal_sales, 2) }}</h5>
                                        @else
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->personal_sales, 2) }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 15px;">
                                @php
                                    $targetSales = max($user->rank->personal_sales, 1); // Prevent division by zero
                                    $currentSales = $user->monthly_personal_sale;
                                    $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                @endphp
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    style="width: {{ $progress }}%;"
                                    aria-valuenow="{{ $currentSales }}"
                                    aria-valuemin="0"
                                    aria-valuemax="{{ $user->rank->personal_sales }}">
                                    {{ number_format($progress, 2) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2" style="width: 100px;text-align: right;">Current Month Group Sales</p>
                        </div>
                        <div class="mt-3 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <p class="mb-0">@lang('translation.Group Sales')</p>
                                        <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->monthly_group_sale, 2) }}</h5>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex-1 text-end">
                                        <p class="mb-0">@lang('translation.Target')</p>
                                        @if ($next_rank)
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->group_sale_requirement, 2) }}</h5>
                                        @else
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->group_sale_requirement, 2) }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 15px;">
                                @php
                                    $targetSales = max($user->rank->group_sale_requirement, 1); // Prevent division by zero
                                    $currentSales = $user->monthly_group_sale;
                                    $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                @endphp
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    style="width: {{ $progress }}%;"
                                    aria-valuenow="{{ $currentSales }}"
                                    aria-valuemin="0"
                                    aria-valuemax="{{ $user->rank->group_sale_requirement }}">
                                    {{ number_format($progress, 2) }}%
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            {{-- current month group sale --}}
            {{-- <div class="col-lg-3 col-md-6 col-sm-12" >
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2" style="width: 100px;text-align: right;">Current Month Group Sales</p>
                        </div>
                        <div class="mt-3 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <p class="mb-0">@lang('translation.Group Sales')</p>
                                        <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->monthly_group_sale, 2) }}</h5>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex-1 text-end">
                                        <p class="mb-0">@lang('translation.Target')</p>
                                        @if ($next_rank)
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->group_sale_requirement, 2) }}</h5>
                                        @else
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">Max</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 15px;">
                                @php
                                    $targetSales = max($user->rank->group_sale_requirement, 1); // Prevent division by zero
                                    $currentSales = $user->monthly_group_sale;
                                    $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                @endphp
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    style="width: {{ $progress }}%;"
                                    aria-valuenow="{{ $currentSales }}"
                                    aria-valuemin="0"
                                    aria-valuemax="{{ $user->rank->group_sale_requirement }}">
                                    {{ number_format($progress, 2) }}%
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- current Semi month personal/group sale --}}
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2" style="width: 100px;text-align: right;">Semi-annual Personal Sales</p>
                        </div>
                        <div class="mt-3 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <p class="mb-0">@lang('translation.Personal Sales')</p>
                                        <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->half_year_personal_sale, 2) }}</h5>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex-1 text-end">
                                        <p class="mb-0">@lang('translation.Target')</p>
                                        @if ($next_rank)
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->personal_sales * 6, 2) }}</h5>
                                        @else
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">
                                                RM{{ number_format($user->rank->personal_sales * 6), 2 }}
                                            </h5>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 15px;">
                                @php
                                    if ($next_rank) {
                                        $targetSales = max($user->rank->personal_sales * 6, 1); // Prevent division by zero
                                        $currentSales = $user->half_year_personal_sale;
                                        $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                    } else {
                                        $targetSales = max($user->rank->personal_sales * 6, 1); // Prevent division by zero
                                        $currentSales = $user->half_year_personal_sale;
                                        $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                    }
                                @endphp
                                @if ($next_rank) 
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        style="width: {{ $progress }}%;"
                                        aria-valuenow="{{ $currentSales }}"
                                        aria-valuemin="0"
                                        aria-valuemax="{{ $user->rank->personal_sales * 6 }}">
                                        {{ number_format($progress, 2) }}%
                                    </div>
                                @else
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        style="width: {{ $progress }}%;"
                                        aria-valuenow="{{ $currentSales }}"
                                        aria-valuemin="0"
                                        aria-valuemax="{{ $user->rank->personal_sales * 6 }}">
                                        {{ number_format($progress, 2) }}%
                                    </div>
                                @endif
                                
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="avatar">
                                <span class="avatar-title bg-soft-success rounded">
                                    <i class="mdi mdi-currency-usd text-success font-size-24"></i>
                                </span>
                            </div>
                            <p class="mt-2" style="width: 100px;text-align: right;">Semi-annual Group Sales</p>
                        </div>
                        <div class="mt-3 pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <p class="mb-0">@lang('translation.Group Sales')</p>
                                        <h5 class="mt-1 mb-0 font-size-14">RM {{ number_format($user->half_year_group_sale, 2) }}</h5>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex-1 text-end">
                                        <p class="mb-0">@lang('translation.Target')</p>
                                        @if ($next_rank)
                                            @if ($next_rank->level === 5)
                                                <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->group_sale_requirement * 6), 2 }}</h5>
                                            @else
                                                <h5 class="mt-1 mb-0 font-size-14 text-wrap">RM {{ number_format($user->rank->group_sale_requirement * 6, 2) }}</h5>
                                            @endif
                                        @else
                                            <h5 class="mt-1 mb-0 font-size-14 text-wrap">
                                                RM {{ number_format($user->rank->group_sale_requirement * 6), 2 }}
                                            </h5>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-2" style="height: 15px;">
                                @php
                                    if ($next_rank) {
                                        if ($next_rank->level === 5) {
                                            $targetSales = max($user->rank->group_sale_requirement * 6, 1); // Prevent division by zero
                                            $currentSales = $user->half_year_group_sale;
                                            $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                        } else {
                                            $targetSales = max($user->rank->group_sale_requirement * 6, 1); // Prevent division by zero
                                            $currentSales = $user->half_year_group_sale;
                                            $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                        }
                                    } else {
                                        $targetSales = max($user->rank->group_sale_requirement * 6, 1); // Prevent division by zero
                                        $currentSales = $user->half_year_group_sale;
                                        $progress = $currentSales == 0 ? 0 : min(100, ($currentSales / $targetSales) * 100);
                                    }
                                @endphp
                                @if ($next_rank) 
                                    @if ($next_rank->level === 5) 
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                            style="width: {{ $progress }}%;"
                                            aria-valuenow="{{ $currentSales }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ $user->rank->group_sale_requirement * 6 }}">
                                            {{ number_format($progress, 2) }}%
                                        </div>
                                    @else
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                            style="width: {{ $progress }}%;"
                                            aria-valuenow="{{ $currentSales }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ $user->rank->group_sale_requirement * 6 }}">
                                            {{ number_format($progress, 2) }}%
                                        </div>
                                    @endif
                                @else
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        style="width: {{ $progress }}%;"
                                        aria-valuenow="{{ $currentSales }}"
                                        aria-valuemin="0"
                                        aria-valuemax="{{ $user->rank->group_sale_requirement * 6 }}">
                                        {{ number_format($progress, 2) }}%
                                    </div>
                                @endif
                                
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly -->
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
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
            </div> --}}
            <!-- Quarterly -->
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
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
            </div> --}}
            <!-- Anual -->
            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
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
            </div> --}}
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
    @if (session('show_announcement'))
        @if (!empty($announcements))
            <script>
                $(document).ready(function() {
                    let announcementModal = new bootstrap.Modal(document.getElementById('announcementModal'));
                    announcementModal.show();
                    $('#announcementModal img').addClass('img-fluid');
                })
            </script>
        @endif
    @endif
    <script>
        $(document).ready(function() {
            $('.announcement-link').click(function() {
                $('#announcementModal').modal('hide'); // Close the popup modal
            });

            $('#announcementModal').on('hidden.bs.modal', function() {
                $('.open-detail-modal').click(); // Open the detail modal
            });
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const redeemForm = document.getElementById('redeem-form');
            const redeemButton = document.getElementById('redeem-button');
            const cashWallet = {{ $user->cash_wallet }};

            redeemButton.addEventListener('click', function (event) {
                event.preventDefault();
                if (cashWallet > 0) {
                    Swal.fire({
                        title: 'Confirm Redemption',
                        text: 'Are you sure you want to redeem your commission?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Redeem',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user confirms, prevent the default form submission and submit the form programmatically
                             // Prevent the default form submission
                            redeemForm.submit();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'You do not have cash wallet balance.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    event.preventDefault(); // Prevent the default form submission
                }
            });
        });
    </script> --}}

@endsection
