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
                        <a href="index">
                            <img src="{{ URL::asset('assets/images/nonskin/non-logo.jpg') }}" alt="" height="100"> <span class="logo-txt"></span>
                        </a>
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
                                                            <label for="basicpill-lastname-input" class="form-label required">Username</label>
                                                            <input type="text" class="form-control" placeholder="e.g. Johnny" name="username" required>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-phoneno-input" class="form-label required">Full Name</label>
                                                            <input type="text" class="form-control" placeholder="e.g. John Lee Doe" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-email-input" class="form-label required">ID</label>
                                                            <input type="number" class="form-control" placeholder="e.g. 900101023434" name="id_no" required>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-phoneno-input" class="form-label required">Contact</label>
                                                            <input type="number" class="form-control" placeholder="e.g. 01178781515" name="contact" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-email-input" class="form-label required">Email</label>
                                                            <input type="email" class="form-control" placeholder="e.g. john.doe@yahoo.com" name="email" required>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-phoneno-input" class="form-label required">Password</label>
                                                            <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="basicpill-email-input" class="form-label required">Confirm Password</label>
                                                            <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" required autocomplete="new-password">
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
                                                                <input type="text" class="form-control" placeholder="e.g. No. 1, Jalan Api 1" name="address_1" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="address_2"
                                                                    class="form-label">Address Line 2</label>
                                                                <input type="text" class="form-control" placeholder="e.g. Taman Api" name="address_2">
                                                            </div>
                                                        </div>
                                                    </div><!-- end row -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="postcode" class="form-label required">Postcode</label>
                                                                <input type="number" class="form-control" placeholder="e.g. 81300" name="postcode" required min="5">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="city"
                                                                    class="form-label required">City</label>
                                                                <input type="text" class="form-control" placeholder="e.g. Johor Bahru" name="city" required>
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
                                                                <select class="form-select" name="bank_name" required>
                                                                    @foreach ($banks as $bank)
                                                                        <option class="form-select" value="{{ $bank->name }}">{{ $bank->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="bank_holder_name" class="form-label required">Bank Holder Name</label>
                                                                <input type="text" class="form-control" placeholder="e.g. John Lee Doe" name="bank_holder_name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="bank_acc_no" class="form-label required">Bank Acc Number</label>
                                                                <input type="number" class="form-control" placeholder="Enter Bank Acc Number" name="bank_acc_no" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="bank_ic" class="form-label required">Bank Identification Number</label>
                                                                <input type="number" class="form-control" placeholder="Enter Bank Identification Number" name="bank_ic" required>
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
                        <p class="text-white-50">©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Nonskin. Designed by Current Tech
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
        var currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            var x = document.getElementsByClassName("wizard-tab");
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
            var x = document.getElementsByClassName("wizard-tab");

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
            var x = document.getElementsByClassName("wizard-tab");
            var isValid = true;
            var inputs = x[currentTab].querySelectorAll("input[required], select[required]");

            // Validate required fields in the current tab
            for (var i = 0; i < inputs.length; i++) {
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
            var i, x = document.getElementsByClassName("list-item");
            for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }
    </script>
@endsection
