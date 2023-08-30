@extends('layouts.master')
@section('title') Purchase Wallet Withdrawals @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Purchase Wallet Withdrawals @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="withdrawals" class="stripe nowrap" style="width:100%">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label class="form-label">Status</label>
                                <select class="form-select status-input" name="status">
                                    <option value="">All</option>
                                    @foreach (App\Enums\PaymentStatus::cases() as $status)
                                        <option value="{{ $status->value }}">{{ $status->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">From Date</label>
                                <input type="date" id="date-min-input" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">To Date</label>
                                <input type="date" id="date-max-input" class="form-control">
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label">Search</label>
                                <input type="text" id="search-input" class="form-control" placeholder="Enter keywords here...">
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Bank</th>
                                <th>Bank Holder Name</th>
                                <th>Bank Acc No</th>
                                <th>Bank IC</th>
                                <th>Amount (RM)</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdrawals as $row)
                                <tr>
                                    <td>{{ $row->payment_num }}</td>
                                    <td>{{ $row->user->referrer_id }}</td>
                                    <td>{{ $row->updated_at->format('d/m/Y') }}</td>
                                    <td>{{ $row->bank_name ?? '-' }}</td>
                                    <td>{{ $row->bank_holder_name ?? '-' }}</td>
                                    <td>{{ $row->bank_acc_no ?? '-' }}</td>
                                    <td>{{ $row->bank_ic ?? '-' }}</td>
                                    <td>{{ number_format($row->amount,2) }}</td>
                                    <td>
                                        @switch($row->status)
                                            @case('Pending')
                                                <span class="badge badge-pill badge-soft-secondary font-size-12">
                                                    Pending
                                                </span>
                                                @break
                                            @case('Approved')
                                                <span class="badge badge-pill badge-soft-success font-size-12">
                                                    Approved
                                                </span>
                                                @break
                                            @default
                                                <span class="badge badge-pill badge-soft-danger font-size-12">
                                                    Failed
                                                </span>
                                        @endswitch
                                    </td>
                                    <td>{{ $row->remarks }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <form action="{{ route('admin.approve-withdrawal', $row->id) }}" method="POST" id="approve-form-{{ $row->id }}">
                                                @csrf
                                                <button type="button" class="btn btn-link approve-btn" data-row-id="{{ $row->id }}" data-row-status="{{ $row->status }}">
                                                    <i class="mdi mdi-check font-size-18"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.reject-withdrawal', $row->id) }}" method="POST" id="reject-form-{{ $row->id }}">
                                                @csrf
                                                <input type="hidden" name="remark" id="remark-{{ $row->id }}">
                                                <button type="button" class="btn btn-link text-danger reject-button" data-row-id="{{ $row->id }}" data-row-status="{{ $row->status }}"
                                                    data-row-amount="{{ $row->amount }}" data-row-user="{{ $row->user_id }}">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </button>
                                            </form>

                                        </div>
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
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        new DataTable('#withdrawals', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });
    </script>
    <script>
        @if (!$withdrawals->isEmpty())
            $(document).ready(function() {
                $('.reject-button').on('click', function() {
                    let row_id = $(this).data('row-id');
                    let row_status = $(this).data('row-status');
                    let row_amount = $(this).data('row-amount');
                    let row_user = $(this).data('row-user');

                    // Check if the status is "Approved" and show an error message
                    if (row_status === 'Approved') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This withdrawal request has already been approved and cannot be rejected.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return;
                    }

                    if (row_status === 'Failed') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This withdrawal request has already been rejected.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action will reject the withdrawal request. Are you sure you want to proceed?',
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
                                const form = document.getElementById('reject-form-' + row_id);

                                const userInput = document.createElement('input');
                                userInput.type = 'hidden';
                                userInput.name = 'user_id';
                                userInput.value = row_user;
                                form.appendChild(userInput);

                                const amountInput = document.createElement('input');
                                amountInput.type = 'hidden';
                                amountInput.name = 'amount'; // Use the same name as in the form
                                amountInput.value = row_amount; // Use the extracted row_amount
                                form.appendChild(amountInput);

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
                    let row_id = $(this).data('row-id');
                    let row_status = $(this).data('row-status');

                    if (row_status === 'Approved') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This withdrawal request has already been approved.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return;
                    }
                    if (row_status === 'Failed') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This withdrawal request has already been rejected and cannot be approved.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This withdrawal request will be approved. Are you sure you want to proceed?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Approve',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('approve-form-' + row_id);
                            form.submit();
                        }
                    });
                });
            });
        @endif
    </script>
@endsection
