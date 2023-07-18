@php
use App\Models\State;
    $states = State::select('id', 'name')->get();
@endphp
<div class="modal fade modal-update-member" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.member') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="addmember-accordion" class="custom-accordion">
                                <div class="card">
                                    <a href="#addmember-memberinfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addmember-memberinfo-collapse">
                                        <div class="p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                            01
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Member Info</h5>
                                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="addmember-memberinfo-collapse" class="collapse show" data-bs-parent="#addmember-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="referral">Referral (Optional)</label>
                                                        <input type="text" class="form-control @error('referral') is-invalid @enderror" id="referral" value="{{ old('referral') }}" name="referral" placeholder="e.g. NON000100" autofocus>
                                                        @error('referral')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="name">Full Name</label>
                                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" placeholder="e.g. John Lee Doe" autofocus>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="id_no">Identification / Passport No.</label>
                                                        <input type="text" class="form-control @error('id_no') is-invalid @enderror" id="id_no" value="{{ old('id_no') }}" name="id_no" placeholder="e.g. 900101018888" autofocus>
                                                        @error('id_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="contact">Contact</label>
                                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" value="{{ old('contact') }}" name="contact" placeholder="e.g. 01177778888" autofocus>
                                                        @error('contact')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="email">Email</label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" placeholder="e.g. john.doe@yahoo.com" autofocus>
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="username">Username</label>
                                                        <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" name="username" autofocus placeholder="Enter username">
                                                        @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="password">Password</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" autofocus>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="password_confirmation">Confirm Password</label>
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword" name="password_confirmation" placeholder="Enter Confirm password" autofocus>
                                                        @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#addmember-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addmember-img-collapse">
                                        <div class="p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                            02
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Address Detail</h5>
                                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="addmember-img-collapse" class="collapse" data-bs-parent="#addmember-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="address_1">Address 1</label>
                                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="address_1" value="{{ old('address_1') }}" name="address_1" placeholder="e.g. No 1, Jalan Kebangsaan 1" autofocus>
                                                        @error('address_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="address_2">Address 2</label>
                                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="address_2" value="{{ old('address_2') }}" name="address_2" placeholder="e.g. Taman Universiti" autofocus>
                                                        @error('address_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="postcode">Postcode</label>
                                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="postcode" value="{{ old('postcodes') }}" name="postcodes" placeholder="e.g. 81300" autofocus>
                                                        @error('postcodes')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="city">City</label>
                                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" id="city" value="{{ old('city') }}" name="city" placeholder="e.g. Johor Bahru" autofocus>
                                                        {{-- <select class="form-select" id="city-dd" class="form-control" name="city" id="city">
                                                            <option value="">Select City</option>
                                                        </select> --}}
                                                        @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="state">State</label>
                                                        {{-- <input type="text" class="form-control @error('contact') is-invalid @enderror" id="state" value="{{ old('state') }}" name="state" placeholder="e.g. Johor" autofocus> --}}
                                                        <select class="form-select" id="state-dd" class="form-control" name="state" id="state">
                                                            <option value="">Select State</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('contact')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label required" for="state">State</label>
                                                        <select class="form-select" name="state" id="state">
                                                            <option value="{{ null }}">Select State</option>
                                                        </select>
                                                        @error('state')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div> --}}
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="country">Country</label>
                                                        {{-- <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" value="{{ old('country') }}" name="country" placeholder="e.g. Malaysia" autofocus> --}}
                                                        <select class="form-select @error('country') is-invalid @enderror" name="country" id="country">
                                                            <option value="Select Country">Select Country</option>
                                                            <option selected value="Malaysia">Malaysia</option>
                                                        </select>
                                                        @error('country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label required" for="country">Country</label>
                                                        <select class="form-select" name="country" id="country">
                                                            <option value="{{ null }}">Select Country</option>
                                                        </select>
                                                        @error('country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#bank-detail-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="bank-detail-collapse">
                                        <div class="p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                            03
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Bank Detail</h5>
                                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="bank-detail-collapse" class="collapse" data-bs-parent="#addmember-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="bank_name">Bank Name</label>
                                                        <select class="form-select" name="bank_name" id="bank_name">
                                                            <option value="">Select Bank</option>
                                                        </select>
                                                        @error('bank_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="bank_acc_no">Bank Account Number</label>
                                                        <input type="text" class="form-control @error('bank_acc_no') is-invalid @enderror" id="bank_acc_no" value="{{ old('bank_acc_no') }}" name="bank_acc_no" placeholder="e.g. 7617878795" autofocus>
                                                        @error('bank_acc_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="bank_holder_name">Bank Holder Name</label>
                                                        <input type="text" class="form-control @error('bank_holder_name') is-invalid @enderror" id="bank_holder_name" value="{{ old('bank_holder_name') }}" name="bank_holder_name" placeholder="e.g. John Lee Doe" autofocus>
                                                        @error('bank_holder_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="bank_ic">Bank IC</label>
                                                        <input type="text" class="form-control @error('bank_ic') is-invalid @enderror" id="bank_ic" value="{{ old('bank_ic') }}" name="bank_ic" placeholder="e.g. 900101018888" autofocus>
                                                        @error('bank_ic')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#delivery-address-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="delivery-address-collapse">
                                        <div class="p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                            04
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Delivery Address</h5>
                                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="delivery-address-collapse" class="collapse" data-bs-parent="#addmember-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="deliver_address_1">Address 1</label>
                                                        <input type="text" class="form-control @error('deliver_address_1') is-invalid @enderror" id="deliver_address_1" value="{{ old('deliver_address_1') }}" name="deliver_address_1" placeholder="e.g. No 1, Jalan Kebangsaan 1" autofocus>
                                                        @error('deliver_address_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="delivery_deliver_address_2">Address 2</label>
                                                        <input type="text" class="form-control @error('delivery_deliver_address_2') is-invalid @enderror" id="delivery_deliver_address_2" value="{{ old('delivery_deliver_address_2') }}" name="delivery_deliver_address_2" placeholder="e.g. Taman Universiti" autofocus>
                                                        @error('delivery_deliver_address_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="delivery_postcode">Postcode</label>
                                                        <input type="text" class="form-control @error('delivery_postcode') is-invalid @enderror" id="delivery_postcode" value="{{ old('delivery_postcode') }}" name="delivery_postcode" placeholder="e.g. 81300" autofocus>
                                                        @error('delivery_postcode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="delivery_city">City</label>
                                                        <input type="text" class="form-control @error('delivery_city') is-invalid @enderror" id="delivery_city" value="{{ old('delivery_city') }}" name="delivery_city" placeholder="e.g. Johor Bahru" autofocus>
                                                        {{-- <select class="form-select" id="city-dd" class="form-control">
                                                            <option value="">Select City</option>
                                                        </select> --}}
                                                        @error('delivery_city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="delivery_state">State</label>
                                                        {{-- <input type="text" class="form-control @error('delivery_state') is-invalid @enderror" id="delivery_state" value="{{ old('delivery_state') }}" name="delivery_state" placeholder="e.g. Johor" autofocus> --}}
                                                        <select class="form-select" id="state-dd" class="form-control" name="delivery_state" id="delivery_state">
                                                            <option value="">Select State</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('delivery_state')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label required" for="state">State</label>
                                                        <select class="form-select" name="state" id="state">
                                                            <option value="{{ null }}">Select State</option>
                                                        </select>
                                                        @error('state')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div> --}}
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required" for="delivery_country">Country</label>
                                                        {{-- <input type="text" class="form-control @error('contact') is-invalid @enderror" id="delivery_country" value="{{ old('delivery_country') }}" name="delivery_country" placeholder="e.g. Johor" autofocus> --}}
                                                        <select class="form-select @error('delivery_country') is-invalid @enderror" name="delivery_country" id="delivery_country">
                                                            <option value="">Select Country</option>
                                                            <option selected value="Malaysia">Malaysia</option>
                                                        </select>
                                                        @error('contact')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label required" for="country">Country</label>
                                                        <select class="form-select" name="country" id="country">
                                                            <option value="{{ null }}">Select Country</option>
                                                        </select>
                                                        @error('country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col text-end">
                            <a href="#" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Cancel </a>
                            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i class=" bx bx-file me-1"></i> Save </button>
                        </div> <!-- end col -->
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

