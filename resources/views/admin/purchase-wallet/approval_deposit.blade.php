@extends('layouts.master')
@section('title') @lang('translation.approved_deposit') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('admin-dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('title') @lang('translation.approved_deposit') @endslot
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
    </style>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="deposits" class="stripe nowrap" style="width:100%">
                        <div style="display: flex;align-items: flex-end;justify-content: center;padding-left: 26px;padding-right: 26px;padding-bottom: 30px;">
                            <div class="col-lg-4" style="width:100%;margin-right:10px">
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
                                <th>Name</th>
                                <th>Amount (RM)</th>
                                <th>Receipt</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $deposit->updated_at }}</td>
                                    <td>{{ $deposit->payment_num }}</td>
                                    <td>{{ $deposit->user->full_name }}</td>
                                    <td>{{ number_format($deposit->amount,2) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded btn-view-receipt" data-bs-toggle="modal" data-bs-target="#paymentSlipModal_{{ $deposit->id }}" id="{{ $deposit->id }}">
                                            View payment slip
                                        </button>
                                        @include('admin.deposit.modal.receipt')
                                    </td>
                                    <td>
                                        @if($deposit->status == 'Pending')
                                            <span class="badge badge-pill badge-soft-secondary font-size-12">
                                                Pending
                                            </span>
                                        @elseif($deposit->status == 'Approved')
                                            <span class="badge badge-pill badge-soft-success font-size-12">
                                                Approved
                                            </span>
                                        @else
                                            <span class="badge badge-pill badge-soft-danger font-size-12">
                                                Failed
                                            </span>
                                        @endif

                                    </td>
                                    <td>{{ $deposit->remarks }}</td>
                                    {{-- <td>
                                        <div class="d-flex gap-3">
                                            <form action="{{ route('admin.approve-deposit', $deposit->id) }}" method="POST" id="approve-form-{{ $deposit->id }}">
                                                @csrf
                                                <button type="button" class="btn btn-link approve-btn" data-deposit-id="{{ $deposit->id }}" data-deposit-status="{{ $deposit->status }}">
                                                    <i class="mdi mdi-check font-size-18"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.reject-deposit', $deposit->id) }}" method="POST" id="reject-form-{{ $deposit->id }}">
                                                @csrf
                                                <input type="hidden" name="remark" id="remark-{{ $deposit->id }}">
                                                <button type="button" class="btn btn-link text-danger reject-button" data-deposit-id="{{ $deposit->id }}" data-deposit-status="{{ $deposit->status }}">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td> --}}
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
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        // new DataTable('#deposits', {
        //     responsive: true,
        //     searching: false,
        //     lengthChange: false,
        //     pagingType: 'simple_numbers'
        // });

        $(document).ready(function() {
            var table = $('#deposits').DataTable({
                lengthChange: false,
                responsive: true,
                // dom: '<"row"<"col-lg-10"f><"col-lg-2"B>>' +
                //         '<"row"<"col-lg-12"t>>' +
                //         '<"row"<"col-lg-6"i><"col-lg-6"p>>',
                // buttons: [
                //     {
                //         extend: 'excel',
                //         text: 'Export Excel',
                //         className: 'custom-excel-button'
                //     }
                // ],
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
    <script>
        @if (!$deposits->isEmpty())
            $(document).ready(function() {
                $('.reject-button').on('click', function() {
                    var deposit_id = $(this).data('deposit-id');
                    var deposit_status = $(this).data('deposit-status');

                    // Check if the status is "Approved" and show an error message
                    if (deposit_status === 'Approved') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This deposit has already been approved and cannot be rejected.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return; // Prevent further execution
                    }

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action will reject the deposit. Are you sure you want to proceed?',
                        icon: 'warning',
                        input: 'text', // Use a text input
                        inputLabel: 'Remark',
                        inputPlaceholder: 'Enter your remark...',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, reject',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if(result.isConfirmed) {
                            const remark = result.value;
                            if(remark) {
                                const form = document.getElementById('reject-form-' + deposit_id);
                                const remarkInput = document.createElement('input');
                                remarkInput.type = 'hidden';
                                remarkInput.name = 'remark';
                                remarkInput.value = remark;
                                form.appendChild(remarkInput);
                                form.submit();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Remark cannot be empty.',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            }
                        }
                    })
                });

                $('.approve-btn').on('click', function() {
                    var deposit_id = $(this).data('deposit-id');
                    var deposit_status = $(this).data('deposit-status');

                    if (deposit_status === 'Approved') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This deposit has already been approved.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return; // Prevent further execution
                    }

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This deposit will be approved. Are you sure you want to proceed?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Approve',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('approve-form-' + deposit_id);
                            form.submit();
                        }
                    });
                });
            });
        @endif
    </script>
@endsection
