<div class="modal fade" id="profile-edit" tabindex="-1" aria-labelledby="exampleModalPopoversLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalPopoversLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ URL('update-profile') }}" enctype="multipart/form-data"
                id="updateProfileForm">
                @csrf
                <div class="modal-body">
                    <div class="row mb-4">
                        <label for="avatar" class="col-sm-3">Profile Picture</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                    id="useravatar" name="avatar" autofocus>
                                <label class="input-group-text" for="avatar">Upload</label>
                            </div>
                            <div class="text-start mt-2">
                                <img src="{{ isset(Auth::user()->avatar) && Auth::user()->avatar != '' ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}"
                                    alt="" class="rounded-circle avatar-lg">
                            </div>
                            <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="referrer" class="col-sm-3 col-form-label">Referral</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ ucfirst(Auth::user()->referrer ?? '-N/A-') }}"
                                name="referral" class="form-control" id="referrer" disabled>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="username" class="col-sm-3 col-form-label required">Username</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ ucfirst(Auth::user()->username) }}" name="username"
                                class="form-control" id="username" placeholder="e.g. Johnny" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="name" class="col-sm-3 col-form-label required">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ ucfirst(Auth::user()->name) }}" name="name"
                                class="form-control" id="name" placeholder="e.g. John Lee Doe" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="id_no" class="col-sm-3 col-form-label required">ID Number</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ ucfirst(Auth::user()->id_no) }}" name="id_no"
                                class="form-control id-input" id="id_no" placeholder="e.g. 900101023434" required>

                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="contact" class="col-sm-3 col-form-label required">Contact</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{ ucfirst(Auth::user()->contact) }}" name="contact"
                                class="form-control contact-input" id="contact" placeholder="e.g. 01178781515" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="email" class="col-sm-3 col-form-label required">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="form-control" id="email" placeholder="e.g. john.doe@yahoo.com" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateProfile">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
