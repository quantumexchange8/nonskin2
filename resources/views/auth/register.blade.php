@extends('layouts.master-without_nav')

@section('title') @lang('translation.Register') @endsection

@section('content')
@php
use App\Models\{State, BankSetting};
    $states = State::select('id', 'name')->get();
    $banks = BankSetting::select('id', 'name')->orderBy('name')->get();
@endphp

<div class="authentication-bg min-vh-100">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 px-3 pt-4">
            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-8 col-xl-10">

                    <div class="text-center mb-4">
                        {{-- <a href="index"> --}}
                            <img src="{{ URL::asset('assets/images/nonskin/non-logo.jpg') }}" alt="" height="100"> <span class="logo-txt"></span>
                        {{-- </a> --}}
                    </div>

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Register Account</h5>
                                <p class="text-muted">Get your free Nonskin account now.</p>
                            </div>
                            <div class="p-2">
                                @if(Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        {{Session::get('success')}}
                                    </div>
                                @elseif(Session::has('error'))
                                    <div class="alert alert-danger text-center">
                                        {{Session::get('error')}}
                                    </div>
                                @endif
                                <form action="{{ route('add.member') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <ul class="wizard-nav mb-4">
                                            <li class="wizard-list-item">
                                                <div class="list-item">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="User Details">
                                                        <i class="bx bx-user-circle"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wizard-list-item">
                                                <div class="list-item">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Address Details">
                                                        <i class="bx bx-file"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wizard-list-item">
                                                <div class="list-item">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Bank Details">
                                                        <i class="bx bx-file"></i>
                                                    </div>
                                                </div>
                                            </li>

                                            {{-- <li class="wizard-list-item">
                                                <div class="list-item">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Bank Details">
                                                        <i class="bx bx-edit"></i>
                                                    </div>
                                                </div>
                                            </li> --}}
                                        </ul>
                                        <!-- wizard-nav -->

                                        <div class="wizard-tab">
                                            <div class="text-center mb-4">
                                                <h5>User Details</h5>
                                                <p class="card-title-desc">Fill all information below</p>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-firstname-input" class="form-label">Referral <small class="text-muted">(Optional)</small></label>
                                                            @if($referral != null)
                                                                <input type="text" class="form-control" placeholder="e.g. NON000000003" name="referral" value="{{ $referral ?: null}}">
                                                            @else
                                                                <input type="text" class="form-control" placeholder="e.g. NON000000003" name="referral">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label required">Username</label>
                                                            <input type="text" class="form-control" placeholder="e.g. Johnny" name="username" id="username" required>
                                                            <div class="invalid-feedback" id="username-error">
                                                                <!-- Error message will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="full_name" class="form-label required">Full Name</label>
                                                            <input type="text" class="form-control" placeholder="e.g. John Lee Doe" name="full_name" id="full_name" required>
                                                            <div class="invalid-feedback" id="full-name-error">
                                                                <!-- Error message will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="id_no" class="form-label required">Identification No. / Passport No.</label>
                                                            <input type="number" class="form-control" placeholder="e.g. 900101023434" name="id_no" id="id_no" required>
                                                            <div class="invalid-feedback" id="id-no-error">
                                                                <!-- Error message will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="contact" class="form-label required">Contact</label>
                                                            <input type="number" class="form-control" placeholder="e.g. 01178781515" name="contact" id="contact" required>
                                                            <div class="invalid-feedback" id="contact-error">
                                                                <!-- Error message will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label required">Email</label>
                                                            <input type="email" class="form-control" placeholder="e.g. john.doe@yahoo.com" name="email" id="email" required>
                                                            <div class="invalid-feedback" id="email-error">
                                                                <!-- Error message will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label required">Password</label>
                                                            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
                                                            <div class="invalid-feedback" id="password-error">
                                                                <!-- Error message will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="password_confirmation" class="form-label required">Confirm Password</label>
                                                            <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                                                            <div class="invalid-feedback" id="password_confirmation-error">
                                                                <!-- Error message will be displayed here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                            </div>
                                        </div>
                                        <!-- wizard-tab -->

                                        <div class="wizard-tab">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Address Detail</h5>
                                                    <p class="card-title-desc">Fill all information below</p>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="address_1" class="form-label required">Address Line 1</label>
                                                                <input type="text" class="form-control" placeholder="e.g. No. 1, Jalan Api 1" name="address_1" id="address_1" required>
                                                                <div class="invalid-feedback" id="address-1-error">
                                                                    <!-- Error message will be displayed here -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="address_2" class="form-label">Address Line 2</label>
                                                                <input type="text" class="form-control" placeholder="e.g. Taman Api" name="address_2" id="address_2">
                                                                <div class="invalid-feedback" id="address-2-error">
                                                                    <!-- Error message will be displayed here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end row -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="postcode" class="form-label required">Postcode</label>
                                                                <input type="number" class="form-control" placeholder="e.g. 81300" name="postcode" id="postcode" required min="5">
                                                                <div class="invalid-feedback" id="postcode-error">
                                                                    <!-- Error message will be displayed here -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="city" class="form-label required">City</label>
                                                                <input type="text" class="form-control" placeholder="e.g. Johor Bahru" name="city" id="city" required>
                                                                <div class="invalid-feedback" id="city-error">
                                                                    <!-- Error message will be displayed here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end row -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="state"
                                                                    class="form-label required">State</label>
                                                                <select class="form-select @error('state') is-invalid @enderror" class="form-control" name="state" id="state" required>
                                                                    <option value="">Select State</option>
                                                                    @foreach ($states as $state)
                                                                        <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('state')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="country" class="form-label required">Country</label>
                                                                <select class="form-select @error('country') is-invalid @enderror" name="country" id="country" required>
                                                                    <option value="">Select Country</option>
                                                                    <option selected value="Malaysia">Malaysia</option>
                                                                </select>
                                                                @error('country')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div><!-- end row-->
                                                </div><!-- end form -->
                                            </div>
                                        </div>
                                        <!-- wizard-tab -->

                                        <div class="wizard-tab">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Bank Details</h5>
                                                    <p class="card-title-desc">Fill all information below</p>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label required">Bank Name</label>
                                                                <select class="form-select" name="bank_name" id="bank_name" required>
                                                                    @foreach ($banks as $bank)
                                                                        <option class="form-select" value="{{ $bank->name }}">{{ $bank->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <span class="d-flex justify-content-between">
                                                                    <label for="bank_holder_name" class="form-label required">Bank Holder Name</label>
                                                                    <label for="copy-id-no font-size-12">Same as Full Name? <input class="form-checkbox" type="checkbox" id="copy-full-name" /></label>
                                                                </span>
                                                                <input type="text" class="form-control" placeholder="e.g. John Lee Doe" name="bank_holder_name" id="bank_holder_name" required>
                                                                <div class="invalid-feedback" id="bank_holder_name-error">
                                                                    <!-- Error message will be displayed here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="bank_acc_no" class="form-label required">Bank Acc Number</label>
                                                                <input type="number" class="form-control" placeholder="Enter Bank Acc Number" name="bank_acc_no" id="bank_acc_no" required>
                                                                <div class="invalid-feedback" id="bank_acc_no-error">
                                                                    <!-- Error message will be displayed here -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <span class="d-flex justify-content-between">
                                                                <label for="bank_ic" class="form-label required">Bank Identification Number</label>
                                                                    <label for="copy-id-no font-size-12">Same as IC No? <input class="form-checkbox" type="checkbox" id="copy-id-no" /></label>
                                                                </span>
                                                                <input type="number" class="form-control" placeholder="Enter Bank Identification Number" name="bank_ic" id="bank_ic" required>
                                                                <div class="invalid-feedback" id="bank_ic-error">
                                                                    <!-- Error message will be displayed here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- wizard-tab -->

                                        <div class="d-flex align-items-start gap-3 mt-4">
                                            <button type="button" class="btn btn-primary w-sm" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                            <button type="submit" class="btn btn-primary w-sm ms-auto" id="nextBtn" onclick="validateForm(+1)">Next</button>
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-4">
                                        <div class="col text-end">
                                            <a href="" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Cancel </a>
                                            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i class=" bx bx-file me-1"></i> Save </button>
                                        </div>
                                    </div> --}}
                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Login here </a> </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center text-muted p-4">
                        <p class="">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Nonskin
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end container -->
</div>

@endsection

@section('script')
    {{-- <script src="{{ URL::asset('assets/js/app.js') }}"></script> --}}
    <script>
        let currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            let x = document.getElementsByClassName("wizard-tab");
            x[n].style.display = "block";

            if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            } else {
            document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == x.length - 1) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            document.getElementById("nextBtn").setAttribute("type", "submit");
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            document.getElementById("nextBtn").setAttribute("type", "button");
            }

            fixStepIndicator(n);
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            let x = document.getElementsByClassName("wizard-tab");

            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                currentTab = currentTab - n;
                x[currentTab].style.display = "block";
            }
            // Otherwise, display the correct tab:
            showTab(currentTab)
        }

        function validateForm(n) {
            let x = document.getElementsByClassName("wizard-tab");
            let isValid = true;
            let inputs = x[currentTab].querySelectorAll("input[required], select[required]");

            // Validate required fields in the current tab
            for (let i = 0; i < inputs.length; i++) {
                if (!inputs[i].value.trim()) {
                    isValid = false;
                    inputs[i].classList.add("is-invalid");
                } else {
                    inputs[i].classList.remove("is-invalid");
                }
            }

            if (isValid) {
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;

            if (currentTab >= x.length) {
                currentTab = currentTab - n;
                x[currentTab].style.display = "block";
            }

            showTab(currentTab);
            }
        }

        function fixStepIndicator(n) {
            let i, x = document.getElementsByClassName("list-item");
            for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }

        $('#username').on('blur', function() {
            let username = $(this).val().trim();

            // Show error if field is blank
            if (username === '') {
                $('#username').addClass('is-invalid');
                $('#username-error').text('Username is required.');
                return;
            }

            $.ajax({
                url: '{{ route('registerUniqueUsername') }}',
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

        $('#full_name').on('blur', function() {
            let full_name = $(this).val().trim();

            // Show error if field is blank
            if (full_name === '') {
                $('#full_name').addClass('is-invalid');
                $('#full-name-error').text('Full name is required.');
                return;
            }

            $.ajax({
                url: '{{ route('registerUniqueFullname') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { full_name: full_name },
                success: function(response) {
                    if (response.unique === false) {
                        $('#full_name').addClass('is-invalid');
                        $('#full-name-error').text('Full name is already taken.');
                    } else {
                        $('#full_name').removeClass('is-invalid');
                        $('#full_name').addClass('is-valid');
                        $('#full-name-error').text('');
                    }
                }
            });
        });

        $('#email').on('blur', function() {
            let email = $(this).val().trim();

            // Show error if field is blank
            if (email === '') {
                $('#email').addClass('is-invalid');
                $('#email-error').text('Email is required.');
                return;
            }

            if (email.indexOf('@') === -1) {
                $('#email').addClass('is-invalid');
                $('#email-error').text('The email address is invalid.');
                return;
            }

            $.ajax({
                url: '{{ route('registerUniqueEmail') }}',
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
        $('#contact').on('blur', function() {
            let contact = $(this).val().trim();

            // Show error if field is blank
            if (contact === '') {
                $('#contact').addClass('is-invalid');
                $('#contact-error').text('Contact is required.');
                return;
            }

            $.ajax({
                url: '{{ route('registerUniqueContact') }}',
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

        function validatePasswordFields() {
            var password = $('#password').val().trim();
            var passwordConfirmation = $('#password_confirmation').val().trim();

            if (password.length < 8 || passwordConfirmation.length < 8) {
                $('#password').addClass('is-invalid');
                $('#password_confirmation').addClass('is-invalid');
                $('#password-error').text('Password must be at least 8 characters.');
                $('#password_confirmation-error').text('Passwords do not match.');
            } else if (password.length !== passwordConfirmation.length) {
                $('#password').addClass('is-invalid');
                $('#password_confirmation').addClass('is-invalid');
                $('#password_confirmation-error').text('Passwords do not match.');
                return false;
            } else{
                $('#password').removeClass('is-invalid');
                $('#password').addClass('is-valid');
                $('#password_confirmation').removeClass('is-invalid');
                $('#password_confirmation').addClass('is-valid');
                $('#password_confirmation-error').text('');
                return true;
            }
        }

        $('#password').on('blur', function() {
            validatePasswordFields();
        });

        $('#password_confirmation').on('blur', function() {
            validatePasswordFields();
        });

        $('#id_no').on('blur', function() {
            let id_no = $(this).val().trim();

            // Show error if field is blank
            if (id_no === '') {
                $('#id_no').addClass('is-invalid');
                $('#id-no-error').text('ID number is required.');
                return;
            } else if (!/^\d{8,12}$/.test(id_no)) {
                $('#id_no').addClass('is-invalid');
                $('#id-no-error').text('ID Number must be a number with 8 to 12 digits.');
            } else {
                $('#id_no').addClass('is-valid');
                $('#id-no-error').text('');
            }
        });

        $('#address_1').on('blur', function() {
            let address1 = $(this).val().trim();

            // Show error if field is blank
            if (address1 === '') {
                $('#address_1').addClass('is-invalid');
                $('#address_1-error').text('This field is required.');
                return;
            } else {
                $('#address_1').removeClass('is-invalid');
                $('#address_1').addClass('is-valid');
                $('#address_1-error').text('');
            }
        });
        $('#address_2').on('blur', function() {
            let address2 = $(this).val().trim();

            // Show error if field is blank
            if (address2 !== '') {
                $('#address_2').removeClass('is-invalid');
                $('#address_2').addClass('is-valid');
                $('#address_2-error').text('');
            }
        });
        $('#postcode').on('blur', function() {
            let postcode = $(this).val().trim();

            // Show error if field is blank
            if (postcode === '') {
                $('#postcode').addClass('is-invalid');
                $('#postcode-error').text('This field is required.');
                return;
            } else {
                $('#postcode').removeClass('is-invalid');
                $('#postcode').addClass('is-valid');
                $('#postcode-error').text('');
            }
        });
        $('#city').on('blur', function() {
            let city = $(this).val().trim();

            // Show error if field is blank
            if (city === '') {
                $('#city').addClass('is-invalid');
                $('#city-error').text('This field is required.');
                return;
            } else {
                $('#city').removeClass('is-invalid');
                $('#city').addClass('is-valid');
                $('#city-error').text('');
            }
        });
        $('#bank_name').on('blur', function() {
            let bank = $(this).val().trim();

            // Show error if field is blank
            if (bank === '') {
                $('#bank_name').addClass('is-invalid');
                $('#bank_name-error').text('This field is required.');
                return;
            } else {
                $('#bank_name').removeClass('is-invalid');
                $('#bank_name').addClass('is-valid');
                $('#bank_name-error').text('');
            }
        });
        $('#bank_holder_name').on('blur', function() {
            let holdername = $(this).val().trim();

            // Show error if field is blank
            if (holdername === '') {
                $('#bank_holder_name').addClass('is-invalid');
                $('#bank_holder_name-error').text('This field is required.');
                return;
            } else {
                $('#bank_holder_name').removeClass('is-invalid');
                $('#bank_holder_name').addClass('is-valid');
                $('#bank_holder_name-error').text('');
            }
        });
        $('#bank_acc_no').on('blur', function() {
            let bankaccno = $(this).val().trim();

            // Show error if field is blank
            if (bankaccno === '') {
                $('#bank_acc_no').addClass('is-invalid');
                $('#bank_acc_no-error').text('This field is required.');
                return;
            } else {
                $('#bank_acc_no').removeClass('is-invalid');
                $('#bank_acc_no').addClass('is-valid');
                $('#bank_acc_no-error').text('');
            }
        });
        $('#bank_ic').on('blur', function() {
            let bankid = $(this).val().trim();

            // Show error if field is blank
            if (bankid === '') {
                $('#bank_ic').addClass('is-invalid');
                $('#bank_ic-error').text('This field is required.');
                return;
            } else if (!/^\d{8,12}$/.test(bankid)) {
                $('#bank_ic').addClass('is-invalid');
                $('#bank_ic-error').text('ID Number must be a number with 8 to 12 digits.');
            } else {
                $('#bank_ic').removeClass('is-invalid');
                $('#bank_ic').addClass('is-valid');
                $('#bank_ic-error').text('');
            }
        });

        $(document).ready(function() {
            $('#copy-id-no').change(function() {
                if ($(this).is(':checked')) {
                    $('#bank_ic').val($('#id_no').val());
                }
            });
        });
        $(document).ready(function() {
            $('#copy-full-name').change(function() {
                if ($(this).is(':checked')) {
                    $('#bank_holder_name').val($('#full_name').val());
                }
            });
        });
    </script>
@endsection
