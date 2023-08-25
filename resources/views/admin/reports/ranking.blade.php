@extends('layouts.master')
@section('title') Wallet Report @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Rankings Report @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="reportRank" class="stripe nowrap" style="width:100%">
                        <div class="d-flex justify-content-end text-end">
                            <div class="col-lg-2">
                                <a href="#" class="btn btn-success" id="exportCsvButton" target="_blank">
                                    {{-- <button class="btn btn-success"> --}}
                                        Export to Excel
                                    {{-- </button> --}}
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
                                <th>user ID</th>
                                <th>Old Rank</th>
                                <th>New Rank</th>
                                <th>Personal Sales</th>
                                <th>Group Sales</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rankings as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->user_id }}</td>
                                    <td>{{ $row->old_rank }}</td>
                                    <td>{{ $row->new_rank }}</td>
                                    <td>{{ $row->user_personal_sales }}</td>
                                    <td>{{ $row->user_group_sales }}</td>
                                    <td>{{ $row->type }}</td>
                                    <td>{{ $row->created_at }}</td>
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
    new DataTable('#reportRank', {
        responsive: true,
        searching: false,
        lengthChange: false,
        pagingType: 'simple_numbers',
        order: [[0, 'desc']], // Default sorting order
    });
</script>
@endsection