<div>
    {{-- <div class="profile-user"></div> --}}
    <div class="profile-content text-center">
        <div class="profile-user-img mt-5">
            <img src="{{ isset(Auth::user()->avatar) && Auth::user()->avatar != '' ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}"
                alt="" class="avatar-lg rounded-circle img-thumbnail">
        </div>
        <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
        <p class="text-muted">{{ Auth::user()->ranking_name }}</p>
    </div>

    <form action="{{ route('updateprofile')}}" method="POST" id="profile-form" class="needs-validation" novalidate>
        @csrf
        <div class="row">
            {{-- <div class="col-lg-6">
                <div class="mb-3">
                    <label for="basicpill-firstname-input" class="form-label">Referral <small class="text-muted">(Optional)</small></label>
                    <input type="text" class="form-control" placeholder="e.g. NON000100" value="{{ Auth::user()->referral ?? '-N/A-' }}" name="referral" disabled>
                </div>
            </div> --}}
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" placeholder="e.g. John Lee Doe" value="{{ Auth::user()->full_name ?? '-N/A-' }}" id="full_name" name="full_name" disabled required>
                    <div class="invalid-feedback" id="full-name-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="e.g. Johnny" value="{{ Auth::user()->username ?? '-N/A-' }}" id="username" name="username" disabled required>
                    <div class="invalid-feedback" id="username-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="e.g. john.doe@yahoo.com" value="{{ Auth::user()->email ?? '-N/A-' }}" id="email" name="email" disabled required>
                    <div class="invalid-feedback" id="email-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control contact-input" placeholder="e.g. 01178781515" value="{{ Auth::user()->contact ?? '-N/A-' }}" id="contact" name="contact" disabled required>
                    <div class="invalid-feedback" id="contact-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="id_no" class="form-label">ID Number</label>
                    <input type="text" class="form-control id-input" placeholder="e.g. 900101023434" value="{{ Auth::user()->id_no ?? '-N/A-' }}" id="id_no" name="id_no" disabled required>
                    <div class="invalid-feedback" id="id_no-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="rank" class="form-label">Ranking</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->rank_id ?? '-N/A-' }}" id="rank" name="rank" readonly style="background: #F5F6F8">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="bank" class="form-label">Bank Name</label>
                    <input type="text" class="form-control" placeholder="e.g. NON000100" value="{{ Auth::user()->bank_name ?? '-N/A-' }}" id="bank" name="bank" disabled required>
                    <div class="invalid-feedback" id="bank-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="holdername" class="form-label">Bank Holder Name</label>
                    <input type="text" class="form-control" placeholder="e.g. Johnny" value="{{ Auth::user()->bank_holder_name ?? '-N/A-' }}" id="holdername" name="holdername" disabled required>
                    <div class="invalid-feedback" id="holdername-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="bankacc" class="form-label">Bank Account Number</label>
                    <input type="text" class="form-control" placeholder="e.g. John Lee Doe" value="{{ Auth::user()->bank_acc_no ?? '-N/A-' }}" id="bankacc" name="bankacc" disabled required>
                    <div class="invalid-feedback" id="bankacc-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="bankid" class="form-label">Bank ID Number</label>
                    <input type="text" class="form-control" placeholder="e.g. 900101023434" value="{{ Auth::user()->bank_ic ?? '-N/A-' }}" id="bankid" name="bankid" disabled required>
                    <div class="invalid-feedback" id="bankid-error">
                        <!-- Error message will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-4">
                    <button type="button" class="btn btn-primary btn-edit-profile" id="edit-profile-button"><i class="mdi mdi-pencil me-1"></i>Edit Profile</button>

                    <!-- Add Save and Cancel buttons with a class of 'd-none' to initially hide them -->
                    <button type="submit" class="btn btn-success btn-save-profile d-none" id="save-profile-button"><i class="mdi mdi-content-save me-1"></i>Save</button>
                    <button type="button" class="btn btn-danger btn-cancel-edit d-none" id="cancel-edit-button">Cancel</button>
                </div>
            </div>
        </div>
    </form>
    
</div>
