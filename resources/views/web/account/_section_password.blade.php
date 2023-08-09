<div class="tab-pane fade {{ session('activeTab') === 'addresses' ? 'show active' : '' }}" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
    <form action="{{ route('updatePassword', Auth::user()->id) }}" method="POST" id="updatePasswordForm">
        @csrf
        <div class="col-lg-6 mb-5">
            <div class="mb-3">
                <label for="basicpill-firstname-input" class="form-label">Current Password</label>
                <input type="password" class="form-control" placeholder="Enter Current Password" name="current_password" min="8" required>
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-firstname-input" class="form-label">New Password</label>
                <input type="password" class="form-control" placeholder="Enter New Password" name="password" min="8" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="basicpill-lastname-input" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" min="8" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-sm" id="updatePassword"><i class="mdi mdi-pencil me-1"></i>Update Password</button>
                </div>
            </div>
        </div>
    </form>
</div>
