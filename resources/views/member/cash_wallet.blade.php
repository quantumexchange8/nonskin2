@extends('layouts.master')
@section('title') @lang('translation.Cash Wallet') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('user-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Cash Wallet') @endslot
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
                    <table id="cashWallet" class="stripe nowrap" style="width:100%">
                        <div style="display: flex;align-items: flex-end;justify-content: center;padding-left: 26px;padding-right: 26px;padding-bottom: 30px;">
                            <div class="col-lg-4" style="width:100%">
                                <label class="form-label">Date</label>
                                <input type="date" id="date-filter-input" class="form-control">
                            </div>
                            <div style="margin-left: 10px;">
                                <form>
                                    <button class="btn btn-primary" type="reset" value="reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Wallet Type</th>
                                <th>Type</th>
                                <th>Cash In</th>
                                <th>Cash Out</th>
                                <th>Balance</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashWallets as $cashWallet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cashWallet->updated_at }}</td>
                                    <td>{{ $cashWallet->wallet_type }}</td>
                                    <td>{{ $cashWallet->type }}</td>
                                    <td>RM {{ number_format($cashWallet->cash_in, 2) ?? '0' }}</td>
                                    <td>RM {{ number_format($cashWallet->cash_out, 2) ?? '0' }}</td>
                                    <td>RM {{ number_format($cashWallet->balance, 2) }}</td>
                                    <td>{{ $cashWallet->remarks }}</td>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/plug-ins/1.10.25/sorting/daterange.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    {{-- <script>
        new DataTable('#cashWallet', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            var table = $('#cashWallet').DataTable({
                responsive: true,
                lengthChange: false,
                // order: [[0, 'desc']], 
                dom: '<"row"<"col-lg-10"f><"col-lg-2"B>>' +
                    '<"row"<"col-lg-12"t>>' +
                    '<"row"<"col-lg-6"i><"col-lg-6"p>>',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Export Excel',
                        className: 'custom-excel-button'
                    }
                ],
                "columnDefs": [
                    {
                        "targets": [1], // Apply the date filter to the second column (index 1)
                        "type": "date-range", // Use date-range filter type
                        "searchable": true // Allow searching within the date range
                    }
                ]
            });
    
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
