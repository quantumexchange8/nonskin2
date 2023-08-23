<a href="#checkout-paymentinfo-collapse" class="collapsed text-dark" data-bs-toggle="collapse">
    <div class="p-4">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 me-3">
                <i class="bx bxs-wallet-alt text-primary h2"></i>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="font-size-16 mb-1">Payment Info</h5>
                <p class="text-muted text-truncate mb-0">Please select your desired payment method</p>
            </div>
            <div class="flex-shrink-0">
                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
            </div>
        </div>
    </div>
</a>

<div id="checkout-paymentinfo-collapse" class="collapse show">
    <div class="p-4 border-top">
        <div>
            <h5 class="font-size-14 mb-3 required">Select payment method :</h5>
            <div class="row">
                @foreach ($payment_methods as $res)
                    <div class="col-lg-3 col-sm-6">
                        <div>
                            <label class="card-radio-label">
                                <input type="radio" name="payment_method" id="paymentMethod"
                                    class="card-radio-input" value="{{ $res->name }}">
                                <span class="card-radio text-center text-truncate" data-bs-toggle="tooltip" data-placement="top"
                                title="" data-bs-original-title="{{ $res->name }}">
                                    <i class="{{ $res->icon_class }} d-block h2 mb-3"></i>
                                    {{ $res->name }}
                                </span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="purchase-wallet-balance-section" class="card" style="display: none">
            <div>
                <span>Purchase Wallet Balance</span><br>
                <h3>RM {{ number_format($user->purchase_wallet, 2) }}</h3>
            </div>

            <div>
                <a href="{{ route('member.deposit') }}">
                    <button class="btn btn-primary" type="button">Top Up</button>
                </a>
                
            </div>
        </div>
        <br>
        <div id="payment-proof-section" class="card" style="display: none;">
            <div class="form-group">
                <h5>Payment Proof Image:</h5>
                <input type="file" class="form-control" id="payment_proof" name="payment_proof">
            </div>
            <br>
            <div class="row">
                <div class="card">
                    <div class="col-sm-6">
                        <div class="text-meted">
                            <h5 class="font-size-16 mb-3">Company Bank Details:</h5>
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
