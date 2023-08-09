<div class="tab-pane fade {{ session('activeTab') === 'profile' ? 'show active' : '' }}" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    {{-- <div class="profile-user"></div> --}}
    <div class="profile-content text-center">
        <div class="profile-user-img mt-5">
            <img src="{{ isset(Auth::user()->avatar) && Auth::user()->avatar != '' ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}"
                alt="" class="avatar-lg rounded-circle img-thumbnail">
        </div>
        <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
        <p class="text-muted">{{ Auth::user()->ranking_name }}</p>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-firstname-input" class="form-label">Referral <small class="text-muted">(Optional)</small></label>
                <input type="text" class="form-control" placeholder="e.g. NON000100" value="{{ Auth::user()->referral ?? '-N/A-' }}" name="referral" disabled>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-lastname-input" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="e.g. Johnny" value="{{ Auth::user()->username ?? '-N/A-' }}" name="name" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-phoneno-input" class="form-label">Full Name</label>
                <input type="text" class="form-control" placeholder="e.g. John Lee Doe" value="{{ Auth::user()->name ?? '-N/A-' }}" name="name" disabled>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-email-input" class="form-label">ID Number</label>
                <input type="text" class="form-control id-input" placeholder="e.g. 900101023434" value="{{ Auth::user()->id_no ?? '-N/A-' }}" name="id_no" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-phoneno-input" class="form-label">Contact</label>
                <input type="text" class="form-control contact-input" placeholder="e.g. 01178781515" value="{{ Auth::user()->contact ?? '-N/A-' }}" name="contact" disabled>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-email-input" class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="e.g. john.doe@yahoo.com" value="{{ Auth::user()->email ?? '-N/A-' }}" name="email" disabled>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-4">
                <button type="button" class="btn btn-primary btn-sm"data-bs-toggle="modal" data-bs-target="#profile-edit"><i class="mdi mdi-pencil me-1"></i>Update Profile</button>
            </div>
        </div>
    </div>
</div>

