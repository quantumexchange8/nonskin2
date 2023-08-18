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
            User Profile
        @endslot
    @endcomponent

    @include('includes.alerts')

    @php
    use App\Models\{State, BankSetting};
        $states = State::select('id', 'name')->get();
        $banks = BankSetting::select('id', 'name')->orderBy('name')->get();
    @endphp

    @section('modal')
    @endsection

    <style>

    </style>
    <div class="row">
        <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            @include('admin.profile.partials.profileinfo')
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var isFormEdited = false;
            var targetTab = null; // Variable to store the target tab if the user confirms leaving

            // start profile update
            // When the Edit Profile button is clicked
            $('.btn-edit-profile').on('click', function() {
                // Enable input fields
                $('input').prop('disabled', false);

                // Show Save and Cancel buttons, hide Edit Profile button
                $('#save-profile-button, #cancel-edit-button').removeClass('d-none');
                $('.btn-edit-profile').addClass('d-none');

                // Mark the form as edited
                isFormEdited = true;
            });

            $('a[data-bs-toggle="pill"]').on('show.bs.tab', function(e) {
                if (isFormEdited) {
                    e.preventDefault(); // Prevent tab change

                    targetTab = $(this).attr('href'); // Store the target tab link

                    // Show SweetAlert 2 confirmation dialog
                    Swal.fire({
                        title: 'Unsaved Changes',
                        text: 'You have unsaved changes. Are you sure you want to leave?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Leave',
                        cancelButtonText: 'Stay',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed, reset the form edit status
                            isFormEdited = false;

                            // Navigate to the clicked tab
                            window.location.href = '{{ route('admin.profile') }}';
                        }
                    });
                }
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
                        window.location.href = '{{ route('admin.profile') }}';
                    }
                });
            });

            $('#full_name').on('keyup', function() {
                let full_name = $(this).val().trim();

                if (full_name === '') {
                    $('#full_name').addClass('is-invalid');
                    $('#full-name-error').text('Full name is required.');
                    return;
                } else {
                    $('#full_name').removeClass('is-invalid');
                    $('#full_name').addClass('is-valid');
                    $('#full-name-error').text('');
                }
            });

            $('#username').on('keyup', function() {
                let username = $(this).val().trim();

                // Show error if field is blank
                if (username === '') {
                    $('#username').addClass('is-invalid');
                    $('#username-error').text('Username is required.');
                    return;
                }

                $.ajax({
                    url: '{{ route('admin.registerUniqueUsername') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { username: username },
                    success: function(response) {
                        if (response.unique === false) {
                            console.log(response);
                            $('#username').addClass('is-invalid');
                            $('#username-error').text('Username is already taken.');
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('#username').addClass('is-valid');
                            $('#username-error').text('');
                        }
                    }
                });
            });

            $('#email').on('keyup', function() {
                var email = $(this).val().trim();

                // Show error if field is blank
                if (email === '') {
                    $('#email').addClass('is-invalid');
                    $('#email-error').text('Email is required.');
                    return;
                }

                $.ajax({
                    url: '{{ route('admin.registerUniqueEmail') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { email: email },
                    success: function(response) {
                        if (response.unique === false) {
                            $('#email').addClass('is-invalid');
                            $('#email-error').text('Email is already taken.');
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#email').addClass('is-valid');
                            $('#email-error').text('');
                        }
                    }
                });
            });

            $('#contact').on('keyup', function() {
                let contact = $(this).val().trim();

                // Show error if field is blank
                if (contact === '') {
                    $('#contact').addClass('is-invalid');
                    $('#contact-error').text('Contact is required.');
                    return;
                }

                $.ajax({
                    url: '{{ route('admin.registerUniqueContact') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { contact: contact },
                    success: function(response) {
                        if (response.unique === false) {
                            $('#contact').addClass('is-invalid');
                            $('#contact-error').text('Contact is already taken.');
                        } else if (!/^\d{10,12}$/.test(contact)) {
                            $('#contact').addClass('is-invalid');
                            $('#contact-error').text('Contact must be a number with 10 to 11 digits.');
                        } else {
                            $('#contact').removeClass('is-invalid');
                            $('#contact').addClass('is-valid');
                            $('#contact-error').text('');
                        }
                    }
                });
            });

            $('#id_no').on('keyup', function() {
                let id_no = $(this).val().trim();

                // Show error if field is blank
                if (id_no === '') {
                    $('#id_no').addClass('is-invalid');
                    $('#id-no-error').text('Idenfication / Passport No. is required.');
                } else if (!/^\d{8,12}$/.test(id_no)) {
                    $('#id_no').addClass('is-invalid');
                    $('#id-no-error').text('Idenfication / Passport No. must be a number with 8 to 12 digits.');
                }
                $.ajax({
                    url: '{{ route('admin.registerUniqueID') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { id_no: id_no },
                    success: function(response) {
                        if (response.unique === false) {
                            $('#id_no').addClass('is-invalid');
                            $('#id-no-error').text('Idenfication No. is already taken.');
                        } else if (!/^\d{8,12}$/.test(id_no)) {
                            $('#id_no').addClass('is-invalid');
                            $('#id-no-error').text('Idenfication / Passport No. must be a number with 8 to 12 digits.');
                        } else {
                            $('#id_no').removeClass('is-invalid');
                            $('#id_no').addClass('is-valid');
                            $('#id-no-error').text('');
                        }
                    }
                });
            });

            // Handle Save button click (you can modify this based on your form submission)
            // When the Save button is clicked
            $('#save-profile-button').on('click', function(event) {
                event.preventDefault(); // Prevent the default form submission

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
                            $('#profile-form').submit(); // Submit the form to the controller
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
