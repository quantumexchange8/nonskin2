@extends('layouts.master')
@section('title') Purchase Wallet Deposit @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Purchase Wallet Deposit @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Topup using ePay method -->
                    <form action="" method="POST">
                        @csrf
                        <a class="text-dark">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                01
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Deposit Amount</h5>
                                        <p class="text-muted text-truncate mb-0">Fill in the amount that you want to deposit</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                        <div id="deposit-collapse" class="collapse show" data-bs-parent="#deposit-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label required" for="amount">Amount</label>
                                        <input class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="e.g 1000.00" type="number" step="0.01" value="{{ old('amount') }}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="">
                                        <button type="submit" class="px-2 btn btn-primary"> ePay </button>
                                        <span class="px-2"> or </span>
                                        <a href="{{ route('member.topup') }}" class="px-2 link"> Manual Transfer to Nonskin Account </a>
                                    </div> <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="p-4">
                        <table id="deposit" class="stripe nowrap" style="width:100%">
                            <div class="row justify-content-end mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label">From Date</label>
                                    <input type="date" id="date-min-input" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">To Date</label>
                                    <input type="date" id="date-max-input" class="form-control">
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Search</label>
                                    <input type="text" id="search-input" class="form-control" placeholder="Enter keywords here...">
                                </div>
                                {{-- <div class="col-lg-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button class="btn btn-primary w-100">Search</button>
                                </div> --}}
                            </div>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment ID</th>
                                    <th>Date</th>
                                    <th>Amount (RM)</th>
                                    <th>Receipt</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($orders as $order) --}}
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        new DataTable('#deposit', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
