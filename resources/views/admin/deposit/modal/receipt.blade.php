<div class="modal fade" id="paymentSlipModal_{{ $deposit->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentSlipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentSlipModalLabel">Payment Slip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('images/payment-proof/' . $deposit->receipt) }}"
                alt="{{ $deposit->receipt }}"
                class="img-fluid mx-auto d-block" style="width: 70% !important;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
