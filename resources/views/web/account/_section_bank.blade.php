<div class="tab-pane fade {{ session('activeTab') === 'bank' ? 'show active' : '' }}" id="v-pills-bank" role="tabpanel" aria-labelledby="v-pills-bank-tab">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-firstname-input" class="form-label">Bank Name <small class="text-muted">(Optional)</small></label>
                <input type="text" class="form-control" placeholder="e.g. NON000100" value="{{ Auth::user()->bank_name ?? '-N/A-' }}" name="referral" disabled>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-lastname-input" class="form-label">Bank Holder Name</label>
                <input type="text" class="form-control" placeholder="e.g. Johnny" value="{{ Auth::user()->bank_holder_name ?? '-N/A-' }}" name="name" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-phoneno-input" class="form-label">Bank Account Number</label>
                <input type="text" class="form-control" placeholder="e.g. John Lee Doe" value="{{ Auth::user()->bank_acc_no ?? '-N/A-' }}" name="name" disabled>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-email-input" class="form-label">Bank ID Number</label>
                <input type="text" class="form-control" placeholder="e.g. 900101023434" value="{{ Auth::user()->bank_ic ?? '-N/A-' }}" name="id_no" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-4">
                <button type="button" class="btn btn-primary btn-sm"data-bs-toggle="modal" data-bs-target="#bank-edit"><i class="mdi mdi-pencil me-1"></i>Update Bank</button>
            </div>
        </div>
    </div>
</div>
