@extends('layouts.master')
@section('title') @lang('translation.Performance Bonus') @lang('translation.Report') @endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('admin-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Performance Bonus') @lang('translation.Report') @endslot
    @endcomponent

    <style>
        .custom-excel-button {
            background-color: #2b8972;
            color: #ffffff;
            width: 100px;
            height: 40px;
            border: none;
            border-radius: 10px;
        }
        .dt-buttons {
            display: flex;
            justify-content: flex-end; /* Adjust as needed */
            margin-bottom: 30px; /* Adjust as needed */
        }
        .dataTables_wrapper .dataTables_filter input[type="search"] {
            /* Your custom styles here */
            /* display: block;
            width: 100%; */
            padding: 0.47rem 0.75rem;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e5e8;
            /* Add more styles as needed */
        }
        .dataTables_wrapper .dataTables_filter {
            float: left; /* Move the search field to the left */
            text-align: left;
            width: 570px;
        }
        .dataTables_filter input {
            width: 100%;
        }
    </style>


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="performanceBonus" class="stripe nowrap" style="width:100%">
                        <div class="row" style="display: none">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Colorpicker</h4>
                                        <p class="card-title-desc">Flat, Simple, Hackable Color-Picker.</p>
                                    </div>
                                    <div class="card-body">
                
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14">Classic Demo</h5>
                                                        <div class="classic-colorpicker"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14">Monolith Demo</h5>
                                                        <div class="monolith-colorpicker"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mt-4">
                                                        <h5 class="font-size-14">Nano Demo</h5>
                                                        <div class="nano-colorpicker"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <div style="display: flex;align-items: flex-end;justify-content: center;padding-left: 26px;padding-right: 26px;padding-bottom: 30px;">
                            <div class="col-lg-4" style="width:100%">
                                <label class="form-label">Date</label>
                                <input type="text" id="datepicker-range" class="form-control">
                            </div>
                            <div style="margin-left: 10px;">
                                <form>
                                    <button class="btn btn-primary" type="submit" value="reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Upline</th> {{-- upline --}}
                                <th>Upline Rank</th>
                                <th>Upline Sales</th>
                                <th>Downline</th>
                                <th>Downline Rank</th>
                                <th>Downline Sales</th>
                                <th>Level</th>
                                <th>Percentage</th>
                                <th>Total Bonus</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($performReport as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->commission_date)->format('Y/m/d') }}</td>
                                    @php
                                        // Assuming $row->upline_id corresponds to the id column in the user table
                                        $user = \App\Models\User::find($row->upline_id);
                                        $downline = \App\Models\User::find($row->downline_id);

                                        $upline_rank = \App\Models\Rankings::find($row->upline_rankid);
                                        $downline_rank = \App\Models\Rankings::find($row->downline_rankid);

                                    @endphp
                                    <td>{{ $user ? $user->full_name : 'User not found'}}</td>
                                    <td>{{ $upline_rank ? $upline_rank->rank_short : 'User not found'}}</td>
                                    <td>RM {{ number_format($row->upline_totalsales, 2) }}</td>
                                    <td>{{ $downline ? $downline->full_name : 'User not found' }}</td>
                                    <td>{{ $downline_rank ? $downline_rank->rank_short : 'User not found' }}</td>
                                    <td>RM {{ number_format($row->downline_sales, 2) }}</td>
                                    <td>{{ $row->commission_level }}</td>
                                    <td>{{ $row->percentage }}%</td>
                                    <td>RM {{ number_format($row->total_bonus, 2) }}</td>
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>\
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script>
        // new DataTable('#performanceBonus', {
        //     responsive: true,
        //     searching: false,
        //     lengthChange: false,
        //     pagingType: 'simple_numbers',
        //     order: [[0, 'desc']],
        // });

        $(document).ready(function() {

                var table = $('#performanceBonus').DataTable({
                    dom: '<"row"<"col-lg-10"f><"col-lg-2"B>>' +
                    '<"row"<"col-lg-12"t>>' +
                    '<"row"<"col-lg-6"i><"col-lg-6"p>>',
                    responsive: true,
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Export Excel',
                            className: 'custom-excel-button'
                        }
                    ],
                    "columnDefs": [
                        {
                            "targets": [1],
                            "type": "date-range",
                            "searchable": true
                        }
                    ],
                    language: {
                        search: 'Search:'
                    }
                });
                // Add an event listener to the date input field
                $('#datepicker-range').on('change', function() {
                    var selectedDate = $(this).val();
                    console.log(selectedDate);

                    // Split the date range input into start and end dates
                    var dateRange = selectedDate.split(' to ');
                    var startDate = dateRange[0];
                    var endDate = dateRange[1];

                    if (startDate && endDate) {
                        // Use DataTables search to filter rows based on a custom function
                        $.fn.dataTable.ext.search.push(
                            function(settings, data, dataIndex) {
                                var dateColumn = data[1]; // Assuming date is in the second column

                                // Check if the date falls within the selected range
                                return moment(dateColumn, 'YYYY-MM-DD').isSameOrAfter(startDate) &&
                                    moment(dateColumn, 'YYYY-MM-DD').isSameOrBefore(endDate);
                            }
                        );

                        // Redraw the DataTable to apply the filter
                        table.draw();

                        // Remove the custom filter function to avoid interference with other searches
                        $.fn.dataTable.ext.search.pop();
                    } else {
                        // If no date range is selected, clear the filter
                        table.search('').draw();
                    }
                });
            });
    </script>
    
@endsection
