@extends('layouts.master')
@section('title') Purchase Wallet Deposits @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Purchase Wallet Deposits @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="deposits" class="stripe nowrap" style="width:100%">
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
                                <th>#</th>
                                <th>Payment ID</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Receipt</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $deposit->payment_num }}</td>
                                    <td>{{ $deposit->user_id }}</td>
                                    <td>{{ $deposit->updated_at }}</td>
                                    <td>{{ $deposit->amount }}</td>
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
                                                Approve
                                            </span>
                                        @else
                                            <span class="badge badge-pill badge-soft-danger font-size-12">
                                                Failed
                                            </span>
                                        @endif
                                        
                                    </td>
                                    <td>{{ $deposit->remarks }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <form action="{{ route('admin.approve-deposit', $deposit->id) }}" method="POST" id="approve-form-{{ $deposit->id }}">
                                                @csrf
                                                <button type="button" class="btn btn-link approve-btn" data-deposit-id="{{ $deposit->id }}" data-deposit-status="{{ $deposit->status }}">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
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
        new DataTable('#deposits', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
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
