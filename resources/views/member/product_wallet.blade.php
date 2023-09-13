@extends('layouts.master')
@section('title') @lang('translation.Product Wallet') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('user-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Product Wallet') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="productWallet" class="stripe nowrap" style="width:100%">
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
                                <th>Date</th>
                                <th>Wallet Type</th>
                                <th>Cash In</th>
                                <th>Cash Out</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_wallet as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>{{ $row->wallet_type }}</td>
                                    <td>@if($row->cash_in != null) {{ $row->cash_in }} @else - @endif</td>
                                    <td>@if($row->cash_out != null) {{ $row->cash_out }} @else - @endif </td>
                                    <td>RM {{ $row->balance }}</td>
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
        new DataTable('#productWallet', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
