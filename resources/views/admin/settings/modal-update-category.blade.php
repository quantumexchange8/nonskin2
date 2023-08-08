<div class="modal fade" id="updateCategory{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.settings.category-store') }}" method="POST" class="needs-validation">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required" for="validationCustom01">Name (EN)</label>
                                <input type="text" class="form-control" name="name_en" id="validationCustom01" placeholder="Enter Category Name in English" value="{{ $v->name_en }}" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required" for="validationCustom02">Name(CN)</label>
                                <input type="text" class="form-control" name="name_cn" id="validationCustom02" placeholder="Enter Category Name in Chinese" value="{{ $v->name_cn }}" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required" for="validationCustom03">Status</label>
                                <select class="form-select" name="status" id="validationCustom03" placeholder="Select Status">
                                    <option value="Active" {{ $v->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $v->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom04">Remarks <small class="text-muted">(Leave empty if unnecessary)</small></label>
                                <input type="text" name="remarks" class="form-control" id="validationCustom04" placeholder="Nonskin" value="{{ $v->remarks }}" required>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
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
