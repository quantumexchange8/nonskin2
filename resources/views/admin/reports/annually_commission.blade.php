@extends('layouts.master')
@section('title') @lang('translation.Annually Commission') @lang('translation.Report') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('admin-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Annually Commission') @lang('translation.Report') @endslot
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
                    <table id="reportAnnually" class="stripe nowrap" style="width:100%">
                        {{-- <div class="d-flex justify-content-end text-end">
                            <div class="col-lg-2">
                                <a href="" target="_blank">
                                    <button class="btn btn-success" id="exportCsvButton">
                                        Export to Excel
                                    </button>
                                </a>
                            </div>
                        </div> --}}
                        {{-- <div class="row justify-content-end">
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
                            <div class="col-lg-3">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary w-100">Search</button>
                            </div>
                        </div> --}}

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Downline</th>
                                <th>Downline Rank</th>
                                <th>Percentage (%)</th>
                                <th>Amount (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anualReport as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->commission_date }}</td>
                                    <td>{{ $row->downline_id }}</td>
                                    <td>{{ $row->downline_rankid }}</td>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        // new DataTable('#reportAnnually', {
        //     responsive: true,
        //     searching: false,
        //     lengthChange: false,
        //     pagingType: 'simple_numbers',
        //     order: [[0, 'desc']],
        // });

        $(document).ready(function() {
                $('#reportAnnually').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Excel', // Change button text if needed
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
    <script>
        function exportToCsv() {
            const table = document.querySelector("#reportAnnually");
            const rows = table.querySelectorAll("tbody tr");
            const headerRow = table.querySelector("thead tr");
            const csvData = [];

            // Collect the header row data and format it as a CSV row
            const headerData = [];
            headerRow.querySelectorAll("th").forEach((cell) => {
                headerData.push('"' + cell.textContent.trim() + '"');
            });
            csvData.push(headerData.join(","));

            // Collect table data and format as CSV rows
            rows.forEach((row) => {
                const rowData = [];
                row.querySelectorAll("td").forEach((cell) => {
                    // Wrap cell content in double quotes to preserve commas and currency symbols
                    rowData.push('"' + cell.textContent.trim() + '"');
                });
                csvData.push(rowData.join(","));
            });

            // Create a CSV blob
            const csvBlob = new Blob([csvData.join("\n")], { type: "text/csv" });

            // Create a download link and trigger the download
            const a = document.createElement("a");
            a.href = window.URL.createObjectURL(csvBlob);
            a.download = "Annually Commission Report.csv";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
@endsection
