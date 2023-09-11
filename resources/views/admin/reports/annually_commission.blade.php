@extends('layouts.master')
@section('title') @lang('translation.Annually Commission') @lang('translation.Report') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('admin-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.Annually Commission') @lang('translation.Report') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="reportAnnually" class="stripe nowrap" style="width:100%">
                        <div class="d-flex justify-content-end text-end">
                            <div class="col-lg-2">
                                <a href="" target="_blank">
                                    <button class="btn btn-success" id="exportCsvButton">
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
                                <th>commission_type</th>
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
                            @foreach ($anualReport as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->commissions_type }}</td>
                                    <td>{{ $row->upline_id }}</td>
                                    <td>{{ $row->upline_rankid }}</td>
                                    <td>{{ $row->downline_id }}</td>
                                    <td>{{ $row->downline_rankid }}</td>
                                    <td>{{ $row->upline_totalsales }}</td>
                                    <td>{{ $row->percentage }}</td>
                                    <td>{{ $row->total_bonus }}</td>
                                    <td>{{ $row->commission_date }}</td>
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
        new DataTable('#reportAnnually', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers',
            order: [[0, 'desc']],
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
