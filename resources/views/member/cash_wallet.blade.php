@extends('layouts.master')
@section('title') @lang('translation.Cash Wallet') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/members/dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Cash Wallet') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="cashWallet" class="stripe nowrap" style="width:100%">
                        <div class="row justify-content-end">
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
                                <th>Wallet Type</th>
                                <th>Type</th>
                                <th>Cash In</th>
                                <th>Cash Out</th>
                                <th>Balance</th>
                                <th>Remarks</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashWallets as $cashWallet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cashWallet->wallet_type }}</td>
                                    <td>{{ $cashWallet->type }}</td>
                                    <td>{{ $cashWallet->cash_in ?? '0' }}</td>
                                    <td>{{ $cashWallet->cash_out ?? '0' }}</td>
                                    <td>{{ $cashWallet->balance }}</td>
                                    <td>{{ $cashWallet->remarks }}</td>
                                    <td>{{ $cashWallet->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        new DataTable('#cashWallet', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
