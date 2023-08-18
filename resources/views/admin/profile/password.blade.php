@extends('layouts.master')
@section('title')
    @lang('translation.User_Profile')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Contacts
        @endslot
        @slot('title')
            Change Password
        @endslot
    @endcomponent

    @include('includes.alerts')

    @php
    use App\Models\{State, BankSetting};
        $states = State::select('id', 'name')->get();
        $banks = BankSetting::select('id', 'name')->orderBy('name')->get();
    @endphp

    @section('modal')
        {{-- @include('web.account.modal-edit-bank') --}}
    @endsection

    <style>

    </style>
    <div class="row">
        <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            @include('admin.profile.partials.passwordinfo')
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script>


        $(document).ready(function() {

            var isFormEdited = false;
            var targetTab = null; // Variable to store the target tab if the user confirms leaving

            // start profile update
            // When the Edit Profile button is clicked
            $('.btn-change-pass').on('click', function() {
                // Enable input fields
                $('input').prop('disabled', false);

                // Show Save and Cancel buttons, hide Edit Profile button
                $('#save-profile-button, #cancel-edit-button').removeClass('d-none');
                $('.btn-change-pass').addClass('d-none');

                // Mark the form as edited
                isFormEdited = true;
            });

            // When the Cancel button is clicked
            $('.btn-cancel-edit').on('click', function() {
                // Show SweetAlert 2 confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Changes will be discarded.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel',
                    cancelButtonText: 'No, keep editing',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, perform cancel action
                        // For example, you can reset the form or redirect
                        // Here, I'm using window.location to redirect to another page
                        window.location.href = '{{ route('admin.changePassword') }}';
                    }
                });
            });

            $('#current_password').on('keyup', function() {
                let current_password = $(this).val().trim();

                // Show error if field is blank
                if (current_password === '') {
                    $('#current_password').addClass('is-invalid');
                    $('#current_password-error').text('Current Password is required.');
                    return;
                }

                $.ajax({
                    url: '{{ route('admin.checkCurrentPass') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { current_password: current_password },
                    success: function(response) {
                        if (response.match === false) {
                            $('#current_password').addClass('is-invalid');
                            $('#current_password-error').text('Current Password does not match');
                        } else {
                            $('#current_password').removeClass('is-invalid');
                            $('#current_password').addClass('is-valid');
                            $('#current_password-error').text('');
                        }
                    }
                });
            });

            // $('#current_password').on('blur', function() {
            //     var current_password = $(this).val().trim();

            //     // Show error if field is blank
            //     if (current_password === '') {
            //         $('#current_password').addClass('is-invalid');
            //         $('#current_password-error').text('ID number is required.');
            //         return;
            //     } else {
            //         $('#current_password').addClass('is-valid');
            //         $('#current_password-error').text('');
            //     }
            // });

            function validatePasswordFields() {
                var password = $('#password').val().trim();
                var passwordConfirmation = $('#password_confirmation').val().trim();

                if (password.length < 8) {
                    $('#password').addClass('is-invalid');
                    $('#password-error').text('Password must be at least 8 characters.');
                    return false;
                } else if (passwordConfirmation !== password) { // Check if passwords match
                    $('#password_confirmation').addClass('is-invalid');
                    $('#password_confirmation-error').text('Passwords do not match.');
                    return false;
                } else {
                    $('#password').removeClass('is-invalid');
                    $('#password').addClass('is-valid');
                    $('#password_confirmation').removeClass('is-invalid');
                    $('#password_confirmation').addClass('is-valid');
                    $('#password_confirmation-error').text('');
                    return true;
                }
            }

            $('#password').on('keyup', function() {
                validatePasswordFields();
            });

            $('#password_confirmation').on('keyup', function() {
                validatePasswordFields();
            });


            // Handle Save button click (you can modify this based on your form submission)
            // When the Save button is clicked
            $('#save-profile-button').on('click', function(event) {
                event.preventDefault(); // Prevent the default form submission

                if (!validatePasswordFields()) {
                    return; // Prevent further execution if there are validation errors
                }

                // Check if any input fields have the 'is-invalid' class
                var hasValidationErrors = $('.is-invalid').length > 0;

                if (hasValidationErrors) {
                    // If there are validation errors, show an alert to the user
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please fill in the requirements.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                } else {
                    // If no validation errors, show SweetAlert confirmation
                    Swal.fire({
                        title: 'Confirm Save',
                        text: 'Are you sure you want to save the changes?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, save',
                        cancelButtonText: 'No, cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed, submit the form
                            $('#updatePasswordForm').submit(); // Submit the form to the controller
                        }
                    });
                }
            });

            $('input').on('input', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
            // end profile update


        });
    </script>
@endsection
