<div class="modal fade" id="editAddressModal{{ $v->id }}" tabindex="-1" aria-labelledby="exampleModalPopoversLabel" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalPopoversLabel">Update Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('updateAddress') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $v->id }}">
                <div class="modal-body">
                    <div class="row mb-4">
                        <label for="name" class="col-sm-3 col-form-label required">Name</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ $v->name }}" name="name" class="form-control" id="name" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="contact_address" class="col-sm-3 col-form-label required">Contact</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ $v->contact }}" name="contact_address" class="form-control contact-input" id="contact_address" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="address_1" class="col-sm-3 col-form-label required">Address Line 1</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ $v->address_1 }}" name="address_1" class="form-control" id="address_1" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="address_2" class="col-sm-3 col-form-label">Address Line 2</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ $v->address_2 }}" name="address_2" class="form-control" id="address_2">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="postcode" class="col-sm-3 col-form-label required">Postcode</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ $v->postcode }}" name="postcode" class="form-control postcode-input" id="postcode" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="city" class="col-sm-3 col-form-label required">City</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ $v->city }}" name="city" class="form-control" id="city" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="state" class="col-sm-3 col-form-label required">State</label>
                        <div class="col-sm-9">
                            <select class="form-select @error('state') is-invalid @enderror" class="form-control" name="state" id="state" required>
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->name }}" {{ $v->state == $state->name ? 'selected' : '' }}>{{ $state->name }}</option>
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
                        <label for="country" class="col-sm-3 col-form-label required">Country</label>
                        <div class="col-sm-9">
                            <select class="form-select @error('country') is-invalid @enderror" name="country" id="country" required>
                                <option value="">Select Country</option>
                                <option value="Malaysia" {{ $v->country == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                <option value="Singapore" {{ $v->country == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                <option value="China" {{ $v->country == 'China' ? 'selected' : '' }}>China</option>
                                <option value="Thailand" {{ $v->country == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                <option value="Vietnam" {{ $v->country == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                <option value="Phillippines" {{ $v->country == 'Phillippines' ? 'selected' : '' }}>Phillippines</option>
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
