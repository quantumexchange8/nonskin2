@extends('layouts.master')
@section('title') Purchase Wallet Deposit @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('url') {{ route('user-dashboard') }} @endslot
        @slot('title') Purchase Wallet Deposit @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Topup using ePay method -->
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
                                        <a href="{{ route('member.topup') }}" class="px-2 link"> Manual Transfer to Nonskin Account </a>
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
                        <table id="deposit" class="stripe nowrap" style="width:100%">
                            <div class="row justify-content-end mb-3">
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
                                    <th>Payment ID</th>
                                    <th>Date</th>
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
                                        <td>{{ $row->payment_num }}</td>
                                        <td>{{ $row->updated_at->format('d/m/Y, h:i:s') }}</td>
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
    <script>
        new DataTable('#deposit', {
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
