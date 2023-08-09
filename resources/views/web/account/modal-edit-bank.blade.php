<div class="modal fade" id="bank-edit" tabindex="-1" aria-labelledby="exampleModalPopoversLabel"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPopoversLabel">Update Bank Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('updateBank') }}" enctype="multipart/form-data" id="updateBankForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-4">
                            <label for="bank_name" class="col-sm-3 col-form-label required">Bank Name</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="bank_name" id="bank_name" required>
                                    <option value="">Select Bank Name</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->name }}" {{ Auth::user()->bank_name == $bank->name ? 'selected' : '' }} >{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="bank_holder_name" class="col-sm-3 col-form-label required">Bank Holder Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ ucfirst(Auth::user()->bank_holder_name) }}" name="bank_holder_name" class="form-control" id="bank_holder_name" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="bank_acc_no" class="col-sm-3 col-form-label required">Bank Account Number</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ ucfirst(Auth::user()->bank_acc_no) }}" name="bank_acc_no" class="form-control bank-acc-no-input" id="bank_acc_no" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="id_no" class="col-sm-3 col-form-label required">Bank ID Number</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ ucfirst(Auth::user()->bank_ic) }}" name="bank_ic" class="form-control id-input" id="id_no" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateBank">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
