@extends('layouts.master')
@section('title') @lang('translation.Performance Bonus') @lang('translation.Report') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('user-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Performance Bonus') @lang('translation.Report') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="performanceBonus" class="stripe nowrap" style="width:100%">
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
                                <th>Upline</th>
                                <th>Upline Rank</th>
                                <th>Downline</th>
                                <th>Downline Rank</th>
                                <th>Total Sales</th>
                                <th>Percentage (%)</th>
                                <th>Amount (RM)</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($rows as $row) --}}
                                <tr>
                                    <td></td>
                                    <td>Leonard Hofstadter</td>
                                    <td>Exclusive Distributor</td>
                                    <td>Tiong Wan Chuah</td>
                                    <td>Member</td>
                                    <td>2.00</td>
                                    <td>2.00</td>
                                    <td>1.00</td>
                                    <td>23/8/2023</td>
                                </tr>
                            {{-- @endforeach --}}
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
        new DataTable('#performanceBonus', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
