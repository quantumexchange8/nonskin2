@extends('layouts.master')
@section('title')
    Member List
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            Member List
        @endslot
    @endcomponent

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@include('admin.members.modal-update-member')

<div class="col-xl-12 col-lg-8">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target=".modal-update-member"><i class='bx bx-plus-circle'></i> Add member</button>
                </div>
                <div class="card-body">
                    <div id="table-member-list"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script>
    var members = {!! $members->map(function ($member) {
            return [
                $member->referral ?? '-N/A-',
                $member->referrer ?? '-N/A-',
                $member->name,
                $member->email,
                $member->ranking_name,
                $member->city,
                $member->postcode,
                $member->state,
                formatDate($member->created_at), // Format the date as dd/mm/yyyy
            ];
        })->toJson() !!};

    (function() {
        var __webpack_exports__ = {};

        // Basic Table
        new gridjs.Grid({
            columns: [
                "Referral",
                "Referrer",
                "Name",
                "Email",
                "Ranking",
                "City",
                "Postcode",
                "State",
                "Joined Date",
                "Action"
            ],
            pagination: {
                limit: 8
            },
            sort: true,
            search: true,
            data: members,
        }).render(document.getElementById("table-member-list"));
    })();
</script>

@php
function formatDate($dateString) {
    return date('d/m/Y', strtotime($dateString));
}
@endphp



@endsection
