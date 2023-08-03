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
    @php
    use App\Models\{State, BankSetting};
        $states = State::select('id', 'name')->get();
        $banks = BankSetting::select('id', 'name')->orderBy('name')->get();
    @endphp

    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar card">
                <h6 class="mt-1">My Account</h6>
                <div class="mail-list mt-1">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        {{-- <a href="" class="active"><i class="mdi mdi-email-outline font-size-16 align-middle me-2"></i> Inbox <span class="ms-1 float-end">(18)</span></a> --}}
                        <a class="nav-link mb-2 active" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                            <i class="bx bxs-user font-size-16 align-middle me-2"></i>Profile</a>
                        <a class="nav-link mb-2" id="v-pills-addresses-tab" data-bs-toggle="pill" href="#v-pills-addresses" role="tab" aria-controls="v-pills-addresses" aria-selected="false">
                            <i class="bx bxs-envelope font-size-16 align-middle me-2"></i>Addresses</a>
                        <a class="nav-link mb-2" id="v-pills-password-tab" data-bs-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">
                            <i class="bx bxs-lock font-size-16 align-middle me-2"></i>Change Password</a>
                    </div>
                </div>
            </div>
            <!-- End Left sidebar -->


            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">
                <div class="card overflow-hidden">
                    <div class="profile-user"></div>
                    <div class="card-body">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="profile-content text-center">
                                    <div class="profile-user-img">
                                        <img src="{{ isset(Auth::user()->avatar) && Auth::user()->avatar != '' ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}"
                                            alt="" class="avatar-lg rounded-circle img-thumbnail">
                                    </div>
                                    <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
                                    <p class="text-muted">{{ Auth::user()->ranking_name }}</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input" class="form-label">Referral <small class="text-muted">(Optional)</small></label>
                                            <input type="text" class="form-control" placeholder="e.g. NON000100" value="{{ Auth::user()->referral ?? '-N/A-' }}" name="referral" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-lastname-input" class="form-label">Username</label>
                                            <input type="text" class="form-control" placeholder="e.g. Johnny" value="{{ Auth::user()->username ?? '-N/A-' }}" name="name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-phoneno-input" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" placeholder="e.g. John Lee Doe" value="{{ Auth::user()->name ?? '-N/A-' }}" name="name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-email-input" class="form-label">ID</label>
                                            <input type="text" class="form-control" placeholder="e.g. 900101023434" value="{{ Auth::user()->id_no ?? '-N/A-' }}" name="id_no" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-phoneno-input" class="form-label">Contact</label>
                                            <input type="text" class="form-control" placeholder="e.g. 01178781515" value="{{ Auth::user()->contact ?? '-N/A-' }}" name="contact" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-email-input" class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="e.g. john.doe@yahoo.com" value="{{ Auth::user()->email ?? '-N/A-' }}" name="email" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-4">
                                            <button type="button" class="btn btn-primary btn-sm"data-bs-toggle="modal" data-bs-target="#profile-edit"><i class="mdi mdi-pencil me-1"></i>Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-addresses" role="tabpanel" aria-labelledby="v-pills-addresses-tab">
                                <div class="row p-2">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="font-size-16">My Addresses:</h5>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addNewAddress"><i class="bx bx-plus-circle"></i> Add New Address</button>
                                    </div>
                                </div>
                                @foreach (Auth::user()->address as $address)
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 p-3">
                                            <div class="text-muted">
                                                <h5 class="font-size-15 mb-2">{{ $address->name }}</h5>
                                                <span>{{ $address->contact }}</span>
                                                <p class="mb-1">{{ $address->address_1 }} {{ $address->address_2 }}</p>
                                                <p class="mb-1">{{ $address->postcode }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }}</p>
                                                @if ($address->is_default == 1)
                                                    <h5 class="font-size-15 mb-1"><span class="badge badge-soft-warning font-size-12">Default</span></h5>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-3">
                                            <div class="text-muted text-sm-end">
                                                <a class="link" role="button" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">Edit</a>
                                                <br>
                                                @if ($address->is_default == 0)
                                                <form action="" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-soft-primary btn-sm border mt-2">Set As Default</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                                <form action="{{ route('updatePassword', Auth::user()->id) }}" method="POST">
                                    @csrf
                                    <div class="col-lg-6 mb-5">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Current Password" name="current_password" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input" class="form-label">New Password</label>
                                            <input type="password" class="form-control" placeholder="Enter New Password" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-lastname-input" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-pencil me-1"></i>Update Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row mb-4">
        <div class="col-xl-8">
            <div class="card mb-0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                            <i class="bx bx-user-circle font-size-20"></i>
                            <span class="d-none d-sm-block">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab">
                            <i class="bx bx-clipboard font-size-20"></i>
                            <span class="d-none d-sm-block">Tasks</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                            <i class="bx bx-mail-send font-size-20"></i>
                            <span class="d-none d-sm-block">Messages</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab content -->
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="about" role="tabpanel">
                        <div>
                            <div>
                                <h5 class="font-size-16 mb-4">Experience</h5>

                                <ul class="activity-feed mb-0 ps-2">
                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            <p class="text-muted mb-1">2019 - 2020</p>
                                            <h5 class="font-size-15">UI/UX Designer</h5>
                                            <p>Abc Company</p>
                                            <p class="text-muted">To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words. If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual</p>
                                        </div>
                                    </li>
                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            <p class="text-muted mb-1">2017 - 2019</p>
                                            <h5 class="font-size-15">Graphic Designer</h5>
                                            <p>xyz Company</p>
                                            <p class="text-muted">It will be as simple as occidental in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h5 class="font-size-16 mb-4">Projects</h5>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Projects</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">01</th>
                                                <td><a href="#" class="text-dark">Brand Logo Design</a></td>
                                                <td>
                                                    18 Jun, 2020
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-primary font-size-12">Open</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">02</th>
                                                <td><a href="#" class="text-dark">Minible Admin</a></td>
                                                <td>
                                                    06 Jun, 2020
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-primary font-size-12">Open</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">03</th>
                                                <td><a href="#" class="text-dark">Chat app Design</a></td>
                                                <td>
                                                    28 May, 2020
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-success font-size-12">Complete</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">04</th>
                                                <td><a href="#" class="text-dark">Minible Landing</a></td>
                                                <td>
                                                    13 May, 2020
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-success font-size-12">Complete</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">05</th>
                                                <td><a href="#" class="text-dark">Authentication Pages</a></td>
                                                <td>
                                                    06 May, 2020
                                                </td>
                                                <td>
                                                    <span class="badge badge-soft-success font-size-12">Complete</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tasks" role="tabpanel">
                        <div>
                            <h5 class="font-size-16 mb-3">Active</h5>

                            <div class="table-responsive">
                                <table class="table table-nowrap table-centered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 60px;">
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-activeCheck2">
                                                    <label class="form-check-label" for="tasks-activeCheck2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">Ecommerce Product Detail</a>
                                            </td>

                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 3
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Product Design</p>
                                            </td>

                                            <td>27 May, 2020</td>
                                            <td style="width: 160px;"><span class="badge badge-soft-primary font-size-12">Active</span></td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-activeCheck1">
                                                    <label class="form-check-label" for="tasks-activeCheck1"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">Ecommerce Product</a>
                                            </td>

                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 7
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Web Development</p>
                                            </td>

                                            <td>26 May, 2020</td>
                                            <td><span class="badge badge-soft-primary font-size-12">Active</span></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h5 class="font-size-16 my-3">Upcoming</h5>

                            <div class="table-responsive">
                                <table class="table table-nowrap table-centered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 60px;">
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck3">
                                                    <label class="form-check-label" for="tasks-upcomingCheck3"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">Chat app Page</a>
                                            </td>

                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 2
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Web Development</p>
                                            </td>

                                            <td>-</td>
                                            <td style="width: 160px;"><span class="badge badge-soft-secondary font-size-12">Waiting</span></td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck2">
                                                    <label class="form-check-label" for="tasks-upcomingCheck2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">Email Pages</a>
                                            </td>

                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 1
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Illustration</p>
                                            </td>

                                            <td>04 June, 2020</td>
                                            <td><span class="badge badge-soft-primary font-size-12">Approved</span></td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck1">
                                                    <label class="form-check-label" for="tasks-upcomingCheck1"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">Contacts Profile Page</a>
                                            </td>
                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 6
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Product Design</p>
                                            </td>

                                            <td>-</td>
                                            <td><span class="badge badge-soft-secondary font-size-12">Waiting</span></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h5 class="font-size-16 my-3">Complete</h5>

                            <div class="table-responsive">
                                <table class="table table-nowrap table-centered">
                                    <tbody>
                                        <tr>
                                            <td style="width: 60px;">
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-completeCheck3">
                                                    <label class="form-check-label" for="tasks-completeCheck3"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">UI Elements</a>
                                            </td>

                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 6
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Product Design</p>
                                            </td>

                                            <td>27 May, 2020</td>
                                            <td style="width: 160px;"><span class="badge badge-soft-success font-size-12">Complete</span></td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-completeCheck2">
                                                    <label class="form-check-label" for="tasks-completeCheck2"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">Authentication Pages</a>
                                            </td>

                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 2
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Illustration</p>
                                            </td>

                                            <td>27 May, 2020</td>
                                            <td><span class="badge badge-soft-success font-size-12">Complete</span></td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="form-check-input" id="tasks-completeCheck1">
                                                    <label class="form-check-label" for="tasks-completeCheck1"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-dark">Admin Layout</a>
                                            </td>

                                            <td>
                                                <p class="ml-4 text-muted mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 3
                                                </p>
                                            </td>
                                            <td>
                                                <p class="ml-4 mb-0">Product Design</p>
                                            </td>

                                            <td>26 May, 2020</td>
                                            <td><span class="badge badge-soft-success font-size-12">Complete</span></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel">
                        <div>
                            <div data-simplebar style="max-height: 430px;">
                                <div class="d-flex align-items-start border-bottom py-4">
                                    <div class="flex-shrink-0 me-2">
                                        <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt="avatar-3 images">
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">Marion Walker <small class="text-muted float-end">1 hr ago</small></h5>
                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting .</p>

                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                            class="mdi mdi-reply"></i> Reply</a>

                                        <div class="d-flex align-items-start mt-4">
                                            <div class="flex-shrink-0 me-2">
                                                <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" alt="avatar-4 images">
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-15 mb-1">Shanon Marvin <small class="text-muted float-end">1 hr ago</small></h5>
                                                <p class="text-muted">It will be as simple as in fact, it will be Occidental. To it will seem like simplified .</p>


                                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block">
                                                    <i class="mdi mdi-reply"></i> Reply
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start border-bottom py-4">
                                    <div class="flex-shrink-0 me-2">
                                        <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-5.jpg') }}" alt="avatar-5 images">
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">Janice Morgan <small class="text-muted float-end">2 hrs ago</small></h5>
                                        <p class="text-muted">To achieve this, it would be necessary to have uniform pronunciation.</p>

                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                            class="mdi mdi-reply"></i> Reply</a>

                                    </div>
                                </div>

                                <div class="d-flex align-items-start border-bottom py-4">
                                    <div class="flex-shrink-0 me-2">
                                        <img class="rounded-circle avatar-sm" src="{{ URL::asset('assets/images/users/avatar-7.jpg') }}" alt="avatar-7 images">
                                    </div>

                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15 mb-1">Patrick Petty <small class="text-muted float-end">3 hrs ago</small></h5>
                                        <p class="text-muted">Sed ut perspiciatis unde omnis iste natus error sit </p>

                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                            class="mdi mdi-reply"></i> Reply</a>

                                    </div>
                                </div>
                            </div>

                            <div class="border rounded mt-4">
                                <form action="#">
                                    <div class="px-2 py-1 bg-light">

                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-link"></i></button>
                                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-smile"></i></button>
                                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-at"></i></button>
                                            </div>
                                    </div>
                                    <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>

                                </form>
                            </div> <!-- end .border-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="profile-user"></div>
                <div class="card-body">
                    <div class="profile-content text-center">
                        <div class="profile-user-img">
                            <img src="{{ (isset(Auth::user()->avatar) && Auth::user()->avatar != '') ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="avatar-lg rounded-circle img-thumbnail">
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-primary btn-sm"data-bs-toggle="modal" data-bs-target="#profile-edit"><i class="mdi mdi-pencil me-1"></i>Edit Profile</button>
                        </div>

                        <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted">UI/UX Designer</p>

                        <p class="text-muted mb-1">
                            Hi I'm Marcus,has been the industry's standard dummy text To an English person,
                            it will seem like simplified English, as a skeptical Cambridge.</p>

                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Team Members</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 50px;"><img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}" class="rounded-circle avatar-sm" alt=""></td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Daniel Canales</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11">Frontend</a>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11">UI</a>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i> Online
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-sm" alt=""></td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Jennifer Walker</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11">UI / UX</a>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle-medium font-size-18 text-warning align-middle me-1"></i> Buzy
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                C
                                            </span>
                                        </div>
                                    </td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Carl Mackay</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11">Backend</a>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i> Online
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-sm" alt=""></td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Janice Cole</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11">Frontend</a>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11">UI</a>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i> Online
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                T
                                            </span>
                                        </div>
                                    </td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Tony Brafford</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-11">Backend</a>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle-medium font-size-18 text-secondary align-middle me-1"></i> Offline
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @include('web.modal-edit-profile')
    @include('web.modal-add-address')
    @include('web.modal-edit-address')
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
