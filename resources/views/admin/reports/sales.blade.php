@extends('layouts.master')
@section('title') @lang('translation.Sales') @lang('translation.Report') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('admin-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Sales') @lang('translation.Report') @endslot
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
    </style>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="reportSales" class="stripe nowrap" style="width:100%">
                        <div style="display: flex;align-items: flex-end;justify-content: center;padding-left: 26px;padding-right: 26px;padding-bottom: 30px;">
                            <div class="col-lg-4" style="width:100%">
                                <label class="form-label">Date</label>
                                <input type="month" id="date-filter-input" class="form-control">
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
                                <th>Order Number</th>
                                <th>Member</th>
                                <th>Price (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y, h:i:s') }}</td>
                                    <td>{{ $order->order_num }}</td>
                                    <td>{{ $order->user->full_name }}</td>
                                    <td>{{ number_format($order->total_amount,2) }}</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        // new DataTable('#reportSales', {
        //     responsive: true,
        //     pagingType: 'simple_numbers'
        // });

        $(document).ready(function() {

                var table = $('#reportSales').DataTable({
                    dom: 'Bfrtip',
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
