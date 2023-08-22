<div class="modal fade" id="editSlipModal_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="paymentSlipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentSlipModalLabel">Payment Slip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('images/payment-proof/' . $row->receipt) }}"
                alt="{{ $row->receipt }}"
                class="img-fluid mx-auto d-block" style="width: 70% !important;">

                <div>
                    <label>Submit New Payment</label>
                    <input type="file" class="form-control" name="newpayslip">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
