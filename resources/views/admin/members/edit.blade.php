@extends('layouts.master')
@section('title')
    Member Listing
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('url2') {{ route('member-list') }} @endslot
        @slot('li_2') Member Listing @endslot
        @slot('title') {{ $user->full_name }} @endslot
    @endcomponent

    @include('includes.alerts')

    <form action="{{ route('members.update', $user->id) }}" method="POST" id="updateProfileForm">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <div class="text-center">
                            <h5 class="mt-3 mb-1">{{ $user->full_name }}</h5>
                            <p class="text-muted">{{ $user->rank->name }}</p>
                        </div>
                        <div class="mt-3 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Profile Details</h2>
                            <div class="col-lg-8 col-md-9">
                                <label class="col-lg-2 col-md-3 col-form-label">
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 row">
                            <label for="referral" class="col-lg-2 col-md-3 col-form-label">Referral</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control" value="{{ $user->referrer_id ?? '-N/A-' }}" name="referral" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="referral" class="col-lg-2 col-md-3 col-form-label">Upline</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control" value="{{ $user->upline->name ?? '-N/A-' }}" name="referral" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="username" class="col-lg-2 col-md-3 col-form-label">Username</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control" placeholder="e.g. Johnny" value="{{ $user->username ?? '-N/A-' }}" name="username">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-lg-2 col-md-3 col-form-label">Email</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="email" class="form-control" placeholder="e.g. john.doe@yahoo.com" value="{{ $user->email ?? '-N/A-' }}" name="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="full_name" class="col-lg-2 col-md-3 col-form-label">Full Name</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control" placeholder="e.g. John Lee Doe" value="{{ $user->full_name ?? '-N/A-' }}" name="full_name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="id_no" class="col-lg-2 col-md-3 col-form-label">ID Number</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control id-input" placeholder="e.g. 900101023434" value="{{ $user->id_no ?? '-N/A-' }}" name="id_no">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="contact" class="col-lg-2 col-md-3 col-form-label">Contact</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control contact-input" placeholder="e.g. 01178781515" value="{{ $user->contact ?? '-N/A-' }}" name="contact">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="contact" class="col-lg-2 col-md-3 col-form-label">Password reset</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="password" class="form-control password-input" placeholder="" value="" name="password">
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Rank Details</h2>
                            <div class="col-lg-8 col-md-9">
                                <label class="col-lg-2 col-md-3 col-form-label">
                                </label>
                            </div>
                        </div>
                        <hr>

                        <div class="mb-3 row">
                            <label for="bank_holder_name" class="col-lg-2 col-md-3 col-form-label">Rankings</label>
                            <div class="col-lg-8 col-md-9">
                                <select class="form-select" name="rank_name">
                                    @foreach ($rankings as $ranking)
                                        <option class="form-select" {{ $user->rank_id == $ranking->level ? 'selected' : '' }} value="{{ $ranking->level }}" >{{ $ranking->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Bank Name</h2>
                            <div class="col-lg-8 col-md-9">
                                <label class="col-lg-2 col-md-3 col-form-label">
                                </label>
                            </div>
                        </div>
                        <hr>

                        <div class="mb-3 row">
                            <label for="bank_name" class="col-lg-2 col-md-3 col-form-label">Bank Name</label>
                            <div class="col-lg-8 col-md-9">
                                <select class="form-select" name="bank_name" required>
                                    @foreach ($banks as $bank)
                                        <option class="form-select" {{ $user->bank_name == $bank->name ? 'selected' : '' }} value="{{ $bank->name }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="bank_holder_name" class="col-lg-2 col-md-3 col-form-label">Bank Holder Name</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control" value="{{ $user->bank_holder_name ?? '-N/A-' }}" name="bank_holder_name" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="bank_acc_no" class="col-lg-2 col-md-3 col-form-label">Bank Account Number</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control bank-acc-no-input" value="{{ $user->bank_acc_no ?? '-N/A-' }}" name="bank_acc_no" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="bank_ic" class="col-lg-2 col-md-3 col-form-label">Bank ID Number</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" class="form-control id-input" value="{{ $user->bank_ic ?? '-N/A-' }}" name="bank_ic" >
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Home Address</h2>
                            <div class="col-lg-8 col-md-9">
                            </div>
                        </div>

                        <hr>
                            {{-- <div class="mb-3 row">
                                <label for="name" class="col-lg-2 col-md-3 col-form-label">Full Name</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ $user->full_name ?? '-N/A-' }}" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="contact" class="col-lg-2 col-md-3 col-form-label">Contact</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control contact-input" value="{{ $user->contact ?? '-N/A-' }}" disabled>
                                </div>
                            </div> --}}
                            <div class="mb-3 row">
                                <label for="address_1" class="col-lg-2 col-md-3 col-form-label">Address Line 1</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ $user->address_1 ?? '-N/A-' }}" name="address_1" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="address_2" class="col-lg-2 col-md-3 col-form-label">Address Line 2</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ $user->address_2 ?? '-N/A-' }}" name="address_2" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="postcode" class="col-lg-2 col-md-3 col-form-label">Postcode</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control postcode-input" value="{{ $user->postcode ?? '-N/A-' }}" name="postcode" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="city" class="col-lg-2 col-md-3 col-form-label">City</label>
                                <div class="col-lg-8 col-md-9">
                                    <input type="text" class="form-control" value="{{ $user->city ?? '-N/A-' }}" name="city" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="state" class="col-lg-2 col-md-3 col-form-label">State</label>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="state">
                                        @foreach ($states as $state)
                                            <option class="form-select" {{ $user->state == $state->name ? 'selected' : '' }} value="{{ $state->name }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="country" class="col-lg-2 col-md-3 col-form-label">Country</label>
                                <div class="col-lg-8 col-md-9">
                                    <select class="form-select" name="country">
                                        <option value="">Select Country</option>
                                        <option value="Malaysia" {{ $user->country == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="Singapore" {{ $user->country == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                        <option value="China" {{ $user->country == 'China' ? 'selected' : '' }}>China</option>
                                        <option value="Thailand" {{ $user->country == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                        <option value="Vietnam" {{ $user->country == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                        <option value="Phillippines" {{ $user->country == 'Phillippines' ? 'selected' : '' }}>Phillippines</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-sm" id="updateProfile"><i class="mdi mdi-pencil me-1"></i>Update Profile</button>
                            </div>
                        </form>

                        <div class="mt-5 row">
                            <h2 class="col-lg-2 col-md-3 col-form-label fw-bold font-size-20 py-0">Shipping Addresses</h2>
                            <div class="col-lg-8 col-md-9">
                            </div>
                        </div>
                        @foreach ($user->address as $k => $v)
                            @include('admin.members.modal-edit-address')
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 p-3">
                                    <div class="text-muted">
                                        <h5 class="font-size-15 mb-2">{{ $v->name }}</h5>
                                        <span>{{ $v->contact }}</span>
                                        <p class="mb-1">{{ $v->address_1 }} {{ $v->address_2 }}</p>
                                        <p class="mb-1">{{ $v->postcode }}, {{ $v->city }}, {{ $v->state }}, {{ $v->country }}</p>

                                    </div>
                                </div>
                                <div class="col-lg-4 p-3">
                                    <div class="text-muted text-sm-end">
                                        <a class="link" role="button" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $v->id }}">Edit</a>
                                        <br>
                                        @if ($v->is_default == 1)
                                            <h5 class="font-size-15 mt-3"><span class="badge badge-soft-warning font-size-12">Default</span></h5>
                                        @elseif ($v->is_default == 0)
                                        <form action="{{ route('toggleDefaultAddress') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $v->id }}">
                                            <input type="hidden" name="user_id" value="{{ $v->user_id }}">
                                            <input type="hidden" name="is_default" value="{{ $v->is_default }}">
                                            <button type="submit" class="btn btn-soft-primary btn-sm border mt-2">Set As Default</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
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
    </script>
@endsection
