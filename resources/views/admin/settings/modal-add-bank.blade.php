<div class="modal fade" id="addBank" tabindex="-1" role="dialog" aria-labelledby="addBankModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBankModalLabel">@lang('translation.add bank')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" action="{{ route('admin.settings.bank-store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">@lang('translation.bank name')</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Bank Name" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="null">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">@lang('translation.close')</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">@lang('translation.save changes')</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
