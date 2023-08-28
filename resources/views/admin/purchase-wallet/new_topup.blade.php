@extends('layouts.master')
@section('title') @lang('translation.Purchase Wallet Topup') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/members/dashboard') }} @endslot
    @slot('li_1') @lang('translation.Dashboard') @endslot
    @slot('url2') {{ route('member.deposit') }} @endslot
    @slot('li_2') @lang('translation.Purchase Wallet Deposit') @endslot
    @slot('title') @lang('translation.Purchase Wallet Topup') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
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
                                            <label for="choices-single-default" class="form-label required">Default</label>
                                            <select class="form-control form-select" data-trigger name="choices-single-default"
                                                id="choices-single-default"
                                                placeholder="Search Member">
                                                <option value="" disabled>Search for Member</option>
                                                @foreach ($members as $member)
                                                    <option value="{{ $member->id }}">{{ $member->referrer_id }} | {{ $member->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label required" for="receipt">Upload Receipt</label>
                                            <input class="form-control" type="file" name="receipt" id="receipt">
                                            @error('amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label required" for="remarks">Remarks</label>
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
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
