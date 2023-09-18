@extends('layouts.master')
@section('title') @lang('translation.Performance Bonus') @lang('translation.Report') @endsection

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
                        <div style="display: flex;align-items: flex-end;justify-content: center;padding-left: 26px;padding-right: 26px;padding-bottom: 30px;">
                            <div class="col-lg-4" style="width:100%">
                                <label class="form-label">Date</label>
                                <input type="date" id="date-filter-input" class="form-control">
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
                                <th>Amount</th>
                                
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
                                    <td>{{ $row->upline_totalsales }}</td>
                                    <td>{{ $downline ? $downline->full_name : 'User not found' }}</td>
                                    <td>{{ $downline_rank ? $downline_rank->rank_short : 'User not found' }}</td>
                                    <td>{{ $row->downline_sales }}</td>
                                    <td>{{ $row->commission_level }}</td>
                                    <td>{{ $row->percentage }}</td>
                                    <td>{{ $row->total_bonus }}</td>
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
                $('#date-filter-input').on('change', function() {
                    var selectedDate = $(this).val();
                    if (selectedDate) {
                        // Use DataTables search to filter rows based on a custom function
                        $.fn.dataTable.ext.search.push(
                            function(settings, data, dataIndex) {
                                var dateColumn = data[1]; // Assuming date is in the second column
                                // Format the selected date to match the database format ('YYYY-MM-DD HH:mm:ss')
                                var formattedDate = moment(selectedDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
                                return dateColumn.includes(formattedDate);
                            }
                        );
                        // Redraw the DataTable to apply the filter
                        table.draw();
                        // Remove the custom filter function to avoid interference with other searches
                        $.fn.dataTable.ext.search.pop();
                    } else {
                        // If no date is selected, clear the filter
                        table.search('').draw();
                    }
                });
            });
    </script>
    
@endsection
