<div class="modal fade" id="profile-edit" tabindex="-1" aria-labelledby="exampleModalPopoversLabel"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPopoversLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card">
                <form method="POST" action="{{ URL('update-profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                            <div class="row mb-4">
                                <label for="avatar" class="col-sm-3">Profile Picture</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="useravatar" name="avatar" autofocus>
                                        <label class="input-group-text" for="avatar">Upload</label>
                                    </div>
                                    <div class="text-start mt-2">
                                        <img src="{{ isset(Auth::user()->avatar) && Auth::user()->avatar != '' ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle avatar-lg">
                                    </div>
                                    <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="referrer" class="col-sm-3 col-form-label">Referral</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ ucfirst(Auth::user()->referrer ?? '-N/A-') }}" name="referral" class="form-control" id="referrer" disabled>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ ucfirst(Auth::user()->username) }}" name="username" class="form-control" id="horizontal-firstname-input">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ ucfirst(Auth::user()->name) }}" name="name" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="id_no" class="col-sm-3 col-form-label">ID No</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ ucfirst(Auth::user()->id_no) }}" name="id_no" class="form-control" id="id_no">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="contact" class="col-sm-3 col-form-label">Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ ucfirst(Auth::user()->contact) }}" name="contact" class="form-control" id="contact">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{ ucfirst(Auth::user()->email) }}"
                                        class="form-control" id="horizontal-email-input">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="xx" id="updateprofile">Save
                        changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
