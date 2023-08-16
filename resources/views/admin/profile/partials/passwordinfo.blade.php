<div>
    <form action="{{ route('updatePassword', Auth::user()->id) }}" method="POST" id="updatePasswordForm">
        @csrf
        <div class="col-lg-6 mb-5">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" placeholder="Enter Current Password" id="current_password" name="current_password" min="8" required disabled>
                <div class="invalid-feedback" id="current_password-error">
                    <!-- Error message will be displayed here -->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" placeholder="Enter New Password" id="password" name="password" min="8" required disabled>
                <div class="invalid-feedback" id="password-error">
                    <!-- Error message will be displayed here -->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter Confirm Password" id="password_confirmation" name="password_confirmation" min="8" required disabled>
                <div class="invalid-feedback" id="password_confirmation-error">
                    <!-- Error message will be displayed here -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-4">
                    <button type="button" class="btn btn-primary btn-change-pass" id="change-password-button"><i class="mdi mdi-pencil me-1"></i>Change Password</button>

                    <!-- Add Save and Cancel buttons with a class of 'd-none' to initially hide them -->
                    <button type="submit" class="btn btn-success btn-save-profile d-none" id="save-profile-button"><i class="mdi mdi-content-save me-1"></i>Save</button>
                    <button type="button" class="btn btn-danger btn-cancel-edit d-none" id="cancel-edit-button">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>
