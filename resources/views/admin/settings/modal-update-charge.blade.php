<div class="modal fade" id="updateCharge{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="updateChargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateChargeModalLabel">Update Shipping Charge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.settings.charge-store') }}" method="POST" class="needs-validation">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">State Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Region Name" value="{{ $v->name }}" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom02">Amount</label>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="e.g. 5.00" value="{{ $v->amount }}" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{ $v->id }}">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
