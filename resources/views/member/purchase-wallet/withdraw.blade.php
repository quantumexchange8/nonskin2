@extends('layouts.master')
@section('title') Purchase Wallet Withdraw @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
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
                                        <label class="form-label" for="amount">Amount Available to Withdrw</label>
                                        <input class="form-control" value="{{ number_format($user->purchase_wallet,2) }}" disabled>
                                    </div>
                                </div>
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
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
