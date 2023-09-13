@extends('layouts.master')
@section('title') @lang('translation.Wallets') @lang('translation.Report') @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ route('user-dashboard') }} @endslot
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('title') @lang('translation.Wallets') @lang('translation.Report') @endslot
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
                    {{-- <table border="0" cellspacing="5" cellpadding="5">
                        <tbody><tr>
                            <td>Minimum date:</td>
                            <td><input type="text" id="min" name="min"></td>
                        </tr>
                        <tr>
                            <td>Maximum date:</td>
                            <td><input type="text" id="max" name="max"></td>
                        </tr>
                    </tbody></table> --}}
                    <table id="reportWallet" class="stripe nowrap" style="width:100%">
                        

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Wallet Type</th>
                                {{-- <th>Type</th> --}}
                                <th>Cash In</th>
                                <th>Cash Out</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->updated_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($row->wallet_type == 'product_wallet')
                                            <span>
                                                Product Wallet
                                            </span>
                                        @elseif($row->wallet_type == 'cash_wallet')
                                            <span>
                                                Cash Wallet
                                            </span>
                                        @elseif($row->wallet_type == 'commission_wallet')
                                            <span>
                                                Commission Wallet
                                            </span>
                                        @elseif($row->wallet_type == 'product_wallet')
                                            <span>
                                                Product Wallet
                                            </span>
                                        @endif
                                        </td>
                                    {{-- <td>{{ $row->type }}</td> --}}
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

    <script>
        $(document).ready(function() {
                $('#reportWallet').DataTable({
                    responsive: true,
                    lengthChange: false,
                    // order: [[0, 'desc']],
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Export Excel', // Change button text if needed
                            className: 'custom-excel-button' // Add a custom class
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
            });
    </script>

    <script>
        document.getElementById("exportCsvButton").addEventListener("click", function() {
            exportToCsv();
        });
    </script>

@endsection
