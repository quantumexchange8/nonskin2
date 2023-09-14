@extends('layouts.master')
@section('title')
    Wallet Adjustment
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('url2') {{ route('member-list') }} @endslot
        @slot('li_2') Wallet Adjustment @endslot
        @slot('title') {{ $user->full_name }} @endslot
    @endcomponent

    @include('includes.alerts')

    <form action="{{ route('productWalletUpdate', $user->id) }}" method="POST" id="updateProfileForm">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <div class="text-center">
                            <h5 class="mt-3 mb-1">{{ $user->full_name }}</h5>
                        </div>
                        <div class="mt-3 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Wallet Details</h2>
                            <div class="col-lg-8 col-md-9">
                                <label class="col-lg-2 col-md-3 col-form-label">
                                </label>
                            </div>
                        </div>
                        <hr>

                        <div class="mb-3 row">
                            <label for="referral" class="col-lg-2 col-md-3 col-form-label">Select Wallet</label>
                            <div class="col-lg-8 col-md-9">
                                <select class="form-select" name="wallet_type" id="wallet_type">
                                    {{-- <option class="form-select" disabled>---please select---</option> --}}
                                    <option class="form-select" value="cash_wallet" selected>Cash Wallet</option>
                                    <option class="form-select" value="product_wallet">Product Wallet</option>
                                </select>
                            </div>
                        </div>

                        <div id="product_wallet_fields">
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label">Product Wallet Balance</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ number_format($user->product_wallet, 2) }}" name="product_balance" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label required">Amount</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="number" class="form-control" name="product_amount" required min="1">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-lg-2 col-md-3 col-form-label">Remark<small> (Optional) </small></label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" name="remark">
                                </div>
                            </div>
                        </div>
                            
                        <div id="cash_wallet_fields">
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label">Cash Wallet Balance</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ number_format($user->cash_wallet, 2) }}" name="cash_balance" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="referral" class="col-lg-2 col-md-3 col-form-label required">Amount</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="number" class="form-control" name="cash_amount" required min="1">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="username" class="col-lg-2 col-md-3 col-form-label">Remark<small> (Optional) </small></label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" name="remark">
                                </div>
                            </div>
                        </div>
                        
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-sm" id="updateProfile"><i class="mdi mdi-pencil me-1"></i>Update Wallets</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Number mask
            let contactInputs = document.querySelectorAll('.contact-input');
            contactInputs.forEach(input => {
                IMask(input, {
                    mask: '00000000000'
                });
            });

            let postcodeInputs = document.querySelectorAll('.postcode-input');
            postcodeInputs.forEach(input => {
                IMask(input, {
                    mask: '00000'
                });
            });

            let bankAccNoInputs = document.querySelectorAll('.bank-acc-no-input');
            bankAccNoInputs.forEach(input => {
                IMask(input, {
                    mask: '00000000000000000'
                });
            });

            let idInputs = document.querySelectorAll('.id-input');
            idInputs.forEach(input => {
                IMask(input, {
                    mask: '000000000000'
                });
            });

            // ... Add other input masks as needed

            // Add an event listener to each form's submit button
            const forms = [
                { id: "updateProfileForm", submitButtonId: "updateProfile" },
                // Add other forms here...
            ];
            forms.forEach((formInfo) => {
                const form = document.getElementById(formInfo.id);
                const submitButton = form.querySelector(`#${formInfo.submitButtonId}`);
                submitButton.addEventListener("click", function(event) {
                    if (!validateForm(formInfo.id)) {
                        event.preventDefault(); // Prevent form submission if validation fails
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var walletSelect = document.getElementById("wallet_type");
            var cashWalletFields = document.getElementById("cash_wallet_fields");
            var productWalletFields = document.getElementById("product_wallet_fields");
            var cashAmountInput = document.querySelector("#cash_wallet_fields input[name='cash_amount']");
            var productAmountInput = document.querySelector("#product_wallet_fields input[name='product_amount']");

            // Initially hide both sets of fields and disable their inputs
            cashWalletFields.style.display = "block";
            cashAmountInput.disabled = false;

            productWalletFields.style.display = "none";
            productAmountInput.disabled = true;

            walletSelect.addEventListener("change", function() {
                if (walletSelect.value === "cash_wallet") {
                    cashWalletFields.style.display = "block";
                    cashAmountInput.disabled = false;
                    productWalletFields.style.display = "none";
                    productAmountInput.disabled = true;
                } else if (walletSelect.value === "product_wallet") {
                    cashWalletFields.style.display = "none";
                    cashAmountInput.disabled = true;
                    productWalletFields.style.display = "block";
                    productAmountInput.disabled = false;
                } else {
                    // Handle any other cases if needed
                    cashWalletFields.style.display = "none";
                    cashAmountInput.disabled = true;
                    productWalletFields.style.display = "none";
                    productAmountInput.disabled = true;
                }
            });
        });
    </script>

@endsection
