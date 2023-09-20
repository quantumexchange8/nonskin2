@extends('layouts.master')
@section('title') Purchase Wallet Withdraw @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('url') {{ route('user-dashboard') }} @endslot
        @slot('title') Purchase Wallet Withdraw @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Purchase Wallet Withdraw -->
                    <form action="" method="POST">
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
                                        <h5 class="font-size-16 mb-1">Withdrawal Amount</h5>
                                        <p class="text-muted text-truncate mb-0">Fill in the amount that you want to withdraw from your Purchase Wallet</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                        <div id="deposit-collapse" class="collapse show" data-bs-parent="#deposit-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label" for="amount">Amount Available to Withdraw</label>
                                        <input class="form-control" value="{{ number_format($user->purchase_wallet,2) }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label required" for="amount">Amount (RM)</label>
                                        <input class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="e.g 1000.00" type="number" step="0.01" value="{{ old('amount') }}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label" for="amount">Bank Name</label>
                                        <input class="form-control" value="{{ $user->bank_name }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label" for="amount">Bank Holder Name</label>
                                        <input class="form-control" value="{{ $user->bank_holder_name }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label" for="amount">Bank Account Number</label>
                                        <input class="form-control" value="{{ $user->bank_acc_no }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="form-label" for="amount">Bank Identification Number</label>
                                        <input class="form-control" value="{{ $user->bank_ic }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary"> Submit </button>
                                    </div> <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="p-4">
                        <table id="withdraw" class="stripe nowrap" style="width:100%">
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
                                    <th>Payment ID</th>
                                    <th>Date</th>
                                    <th>Amount (RM)</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawals as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->payment_num }}</td>
                                        <td>{{ $row->updated_at->format('d/m/Y, h:i:s') }}</td>
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
                                                @case('Failed')
                                                    <span class="badge badge-pill badge-soft-danger font-size-12">
                                                        Failed
                                                    </span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $row->remarks }}</td>
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
    <script>
        new DataTable('#withdraw', {
            responsive: true,
            searching: false,
            lengthChange: false,
            pagingType: 'simple_numbers'
        });

        $('#search-input').on('keyup', function () {
            table.search( this.value ).draw();
        } );
    </script>
@endsection
