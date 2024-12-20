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
        @include('web.account.modal-edit-profile')
        @include('web.account.modal-add-address')
        @include('web.account.modal-edit-address')
        @include('web.account.modal-edit-bank')
    @endsection

    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar card">
                <h6 class="mt-1">My Account</h6>
                <div class="mail-list mt-1">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        {{-- <a href="" class="active"><i class="mdi mdi-email-outline font-size-16 align-middle me-2"></i> Inbox <span class="ms-1 float-end">(18)</span></a> --}}
                        <a class="nav-link mb-2 {{ session('activeTab') === 'profile' ? 'active' : '' }}" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                            <i class="bx bxs-user font-size-16 align-middle me-2"></i>Profile</a>
                        <a class="nav-link mb-2 {{ session('activeTab') === 'addresses' ? 'active' : '' }}" id="v-pills-addresses-tab" data-bs-toggle="pill" href="#v-pills-addresses" role="tab" aria-controls="v-pills-addresses" aria-selected="false">
                            <i class="bx bxs-envelope font-size-16 align-middle me-2"></i>Shpping Address</a>
                        <a class="nav-link mb-2 {{ session('activeTab') === 'bank' ? 'active' : '' }}" id="v-pills-bank-tab" data-bs-toggle="pill" href="#v-pills-bank" role="tab" aria-controls="v-pills-bank" aria-selected="false">
                            <i class="bx bxs-credit-card-alt font-size-16 align-middle me-2"></i>Bank Detail</a>
                        <a class="nav-link mb-2 {{ session('activeTab') === 'password' ? 'active' : '' }}" id="v-pills-password-tab" data-bs-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">
                            <i class="bx bxs-lock font-size-16 align-middle me-2"></i>Change Password</a>
                    </div>
                </div>
            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            @include('web.account._section_profile')
                            @include('web.account._section_addresses')
                            @include('web.account._section_bank')
                            @include('web.account._section_password')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    {{-- <script>
        function validateForm(formId) {
            let isValid = true;
            let inputs = document.querySelectorAll(`#${formId} input[required], #${formId} select[required]`);
            // Validate required fields in the form
            for (let i = 0; i < inputs.length; i++) {
                if (!inputs[i].value.trim()) {
                    isValid = false;
                    inputs[i].classList.add("is-invalid");
                } else {
                    inputs[i].classList.remove("is-invalid");
                }
            }
            return isValid;
        }
    </script> --}}
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Number mask
            let contactInputs = document.querySelectorAll('.contact-input');
            contactInputs.forEach(input => {
                IMask(input, {
                    mask: '00000000000'
                });
            });

            let postcodeInputs = document.querySelectorAll('.postcode-input');
            postcodeInputs.forEach(input => {
                IMask(input, {
                    mask: '00000'
                });
            });

            let bankAccNoInputs = document.querySelectorAll('.bank-acc-no-input');
            bankAccNoInputs.forEach(input => {
                IMask(input, {
                    mask: '00000000000000000'
                });
            });

            let idInputs = document.querySelectorAll('.id-input');
            idInputs.forEach(input => {
                IMask(input, {
                    mask: '000000000000'
                });
            });

            // ... Add other input masks as needed

            // Add an event listener to each form's submit button
            const forms = [
                { id: "updateProfileForm", submitButtonId: "updateProfile" },
                { id: "addAddressForm", submitButtonId: "addAddress" },
                { id: "updateBankForm", submitButtonId: "updateBank" },
                { id: "updatePasswordForm", submitButtonId: "updatePassword" },
                // Add other forms here...
            ];
            forms.forEach((formInfo) => {
                const form = document.getElementById(formInfo.id);
                const submitButton = form.querySelector(`#${formInfo.submitButtonId}`);
                submitButton.addEventListener("click", function(event) {
                    if (!validateForm(formInfo.id)) {
                        event.preventDefault(); // Prevent form submission if validation fails
                    }
                });
            });
        });
    </script> --}}

@endsection
