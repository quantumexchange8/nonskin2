@extends('layouts.master')
@section('title') Purchase Wallet Deposit @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('url') {{ route('user-dashboard') }} @endslot
        @slot('title') Purchase Wallet Deposit @endslot
    @endcomponent

    <style>
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
            {{-- <div class="card">
                <div class="card-body">
                    <!-- Topup using ePay method -->
                    <form action="" method="POST">
                        @csrf
                        <a class="text-dark">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Deposit Amount</h5>
                                        <p class="text-muted text-truncate mb-0">Fill in the amount that you want to deposit</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                        <div id="deposit-collapse" class="collapse show" data-bs-parent="#deposit-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label required" for="amount">Amount</label>
                                        <input class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="e.g 1000.00" type="number" step="0.01" value="{{ old('amount') }}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="">
                                        <button type="submit" class="px-2 btn btn-primary"> ePay </button>
                                        <span class="px-2"> or </span>
                                        <a href="{{ route('member.topup') }}" class="px-2 link">
                                            <button class="px-2 btn btn-primary">
                                                Manual Transfer
                                            </button>
                                        </a>
                                    </div> <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('member.topup.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <a class="text-dark">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                01
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Manual Transfer</h5>
                                        <p class="text-muted mb-0">Fill in the amount that you want to deposit</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                        <div id="deposit-collapse" class="collapse show" data-bs-parent="#deposit-accordion">
                            <div class="p-4 border-top">

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label required" for="amount">Amount</label>
                                            <input class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="e.g 1000.00" type="number" step="0.01" value="{{ old('amount') }}" required>
                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <img class="img-thumbnail object-fit-cover mb-3" id="receiptPreview" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                            <br>
                                            <label class="form-label required" for="receipt">Upload Receipt</label>
                                            <input class="form-control" type="file" name="receipt" id="receipt">
                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="remarks">Remarks <small class="text-muted">(Optional)</small></label>
                                            <input class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" placeholder="e.g Topup" type="text" value="{{ old('remarks') }}">
                                            @error('remarks')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mt-4">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary"> Submit </button>
                                            </div> <!-- end col -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <br>
                                        <div class="card">
                                            <div class="text-muted">
                                                <div class="card-header">
                                                    <h5 class="font-size-16">Company Bank Details:</h5>
                                                    <div class="text-muted font-size-12">You may transfer into this company's bank account</div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="font-size-15 mb-2">{{$companyInfo->bank_holder_name}}</h5>
                                                    <p class="mb-1">{{$companyInfo->bank_name}}</p>
                                                    <p class="mb-1">{{$companyInfo->bank_acc}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="p-4">
                        <table id="deposit" class="stripe nowrap" style="width:100%">
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
                                    <th>Payment ID</th>
                                    <th>Amount (RM)</th>
                                    <th>Receipt</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deposits as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->updated_at }}</td>
                                        <td>{{ $row->payment_num }}</td>
                                        <td>{{ number_format($row->amount,2) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded btn-view-receipt" data-bs-toggle="modal" data-bs-target="#paymentSlipModal_{{ $row->id }}" id="{{ $row->id }}">
                                                View payment slip
                                            </button>
                                            @include('member.modals.receipt')
                                        </td>
                                        <td>
                                            @if( $row->status == 'Pending')
                                                <span class="badge badge-pill badge-soft-secondary font-size-12">
                                                    Pending
                                                </span>
                                            @elseif($row->status == 'Approved')
                                                <span class="badge badge-pill badge-soft-success font-size-12">
                                                    Approved
                                                </span>
                                            @elseif ( $row->status == 'Failed')
                                                <span class="badge badge-pill badge-soft-danger font-size-12">
                                                    Failed
                                                </span>
                                            @endif

                                        </td>
                                        <td>{{ $row->remarks }}</td>
                                        @if($row->status == 'Failed')
                                        <td>
                                            <form action="{{ route('member.new-payslip', $row->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <button class="btn btn-link btn-edit-receipt" type="button" data-bs-toggle="modal" data-bs-target="#editSlipModal_{{ $row->id }}" id="{{ $row->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                @include('member.modals.edit-receipt')
                                            </form>

                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/plug-ins/1.10.25/sorting/daterange.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    
    <script>
        // new DataTable('#deposit', {
        //     responsive: true,
        //     searching: false,
        //     lengthChange: false,
        //     pagingType: 'simple_numbers'
        // });

        // $('#search-input').on('keyup', function () {
        //     table.search( this.value ).draw();
        // } );

        $(document).ready(function() {
            var table = $('#deposit').DataTable({
                responsive: true,
                lengthChange: false,
                // order: [[0, 'desc']], 
                dom: '<"row"<"col-lg-10"f><"col-lg-2"B>>' +
                    '<"row"<"col-lg-12"t>>' +
                    '<"row"<"col-lg-6"i><"col-lg-6"p>>',
                
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
