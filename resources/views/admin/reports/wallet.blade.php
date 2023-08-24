@extends('layouts.master')
@section('title') Wallet Report @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Wallet Report @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="reportWallet" class="stripe nowrap" style="width:100%">
                        <div class="d-flex justify-content-end text-end">
                            <div class="col-lg-2">
                                <a href="" target="_blank">
                                    <button class="btn btn-success">
                                        Export to Excel
                                    </button>
                                </a>
                            </div>
                        </div>
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
                                <th>Member ID | Full Name</th>
                                <th>Wallet Type</th>
                                <th>Type</th>
                                <th>Remarks</th>
                                <th>Cash In</th>
                                <th>Cash Out</th>
                                <th>Balance</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->user->referrer_id }} | {{ $row->user->full_name }}</td>
                                    <td>{{ $row->wallet_type }}</td>
                                    <td>{{ $row->type }}</td>
                                    <td>{{ $row->remarks }}</td>
                                    @if ($row->cash_in == 0)
                                        <td>
                                            -
                                        </td>
                                    @else
                                        <td class="text-success fw-bold">
                                            RM {{ number_format($row->cash_in,2) }}
                                        </td>
                                    @endif
                                    @if ($row->cash_out == 0)
                                        <td>
                                            -
                                        </td>
                                    @else
                                        <td class="text-danger fw-bold">
                                            RM {{ number_format($row->cash_out,2) }}
                                        </td>
                                    @endif
                                    <td>
                                        RM {{ number_format($row->balance,2) }}
                                    </td>
                                    <td>{{ $row->updated_at->format('d/m/Y') }}</td>
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
        new DataTable('#reportWallet', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
