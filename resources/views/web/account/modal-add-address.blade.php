<div class="modal fade" id="addNewAddress" tabindex="-1" aria-labelledby="exampleModalPopoversLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalPopoversLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label required">Name</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="e.g. John Lee Doe" name="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="contact" class="col-sm-3 col-form-label required">Contact</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="e.g. 01145457878" name="contact" class="form-control" id="contact">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="address_1" class="col-sm-3 col-form-label">Address Line 1</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="e.g. No. 1, Jalan Api 1" name="address_1" class="form-control" id="address_1">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="address_2" class="col-sm-3 col-form-label">Address Line 2</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="e.g. Taman Api" name="address_2" class="form-control" id="address_2">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="postcode" class="col-sm-3 col-form-label">Postcode</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="81300" name="postcode" class="form-control" id="postcode">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="city" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Johor Bahru" name="city" class="form-control" id="city">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="state" class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                                <select class="form-select @error('state') is-invalid @enderror" class="form-control" name="state" id="state" required>
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->name }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="country" class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                                <select class="form-select @error('country') is-invalid @enderror" name="country" id="country" required>
                                    <option value="">Select Country</option>
                                    <option selected value="Malaysia">Malaysia</option>
                                </select>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateAddress">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
