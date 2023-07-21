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
            <h5 class="font-size-14 mb-3">Payment method :</h5>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div data-bs-toggle="collapse">
                        <label class="card-radio-label">
                            <input type="radio" name="pay-method" id="pay-methodoption1"
                                class="card-radio-input">
                            <span class="card-radio text-center text-truncate">
                                <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                Online Banking
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div>
                        <label class="card-radio-label">
                            <input type="radio" name="pay-method" id="pay-methodoption2"
                                class="card-radio-input">
                            <span class="card-radio text-center text-truncate">
                                <i class="bx bxl-paypal d-block h2 mb-3"></i>
                                Manual Transfer
                            </span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div>
                        <label class="card-radio-label">
                            <input type="radio" name="pay-method" id="pay-methodoption3"
                                class="card-radio-input" checked>
                            <span class="card-radio text-center text-truncate">
                                <i class="bx bx-money d-block h2 mb-3"></i>
                                <span>Payment at Counter</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
