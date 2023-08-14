@extends('layouts.master')
@section('title') Member Detail @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('url2') {{ route('member.listing') }} @endslot
    @slot('li_2') Member Detail @endslot
    @slot('title') {{ $user->full_name }} @endslot
    @endcomponent

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
                        <input type="text" class="form-control" value="{{ $user->referrer_id ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="username" class="col-lg-2 col-md-3 col-form-label">Username</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="text" class="form-control"  value="{{ $user->username ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-lg-2 col-md-3 col-form-label">Email</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="email" class="form-control" value="{{ $user->email ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="full_name" class="col-lg-2 col-md-3 col-form-label">Full Name</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="text" class="form-control" value="{{ $user->full_name ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contact" class="col-lg-2 col-md-3 col-form-label">Contact</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="text" class="form-control contact-input" value="{{ $user->contact ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contact" class="col-lg-2 col-md-3 col-form-label">Personal Ranking</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="text" class="form-control contact-input" value="{{ $user->personal_ranking ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contact" class="col-lg-2 col-md-3 col-form-label">Direct Sponsor</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="text" class="form-control contact-input" value="{{ $user->direct_sponsor ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contact" class="col-lg-2 col-md-3 col-form-label">Total Sales</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="text" class="form-control contact-input" value="RM {{ $user->total_sales ?? '-N/A-' }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="contact" class="col-lg-2 col-md-3 col-form-label">Group Sales</label>
                    <div class="col-lg-8 col-md-9">
                        <input type="text" class="form-control contact-input" value="RM {{ $user->group_sales ?? '-N/A-' }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
