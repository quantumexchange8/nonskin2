@extends('layouts.master')
@section('title')
    Member Listing
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Member Listing @endslot
    @endcomponent

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@include('modals.create-member')

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
{{-- <script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script> --}}
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script>
    var users = {!! $users->map(function ($user) {
            return [
                $user->upline->name ?? '-N/A-',
                $user->referrer_id ?? '-N/A-',
                $user->name,
                $user->email,
                $user->ranking_name,
                $user->postcode,
                $user->city,
                $user->state,
                formatDate($user->created_at), // Format the date as dd/mm/yyyy
            ];
        })->toJson() !!};

    let users2 = @json($users);

    console.log(users);

    (function() {
        var __webpack_exports__ = {};

        // Basic Table
        new gridjs.Grid({
            columns: [
                "Referral",
                "Upline",
                "Name",
                "Email",
                "Ranking",
                "Postcode",
                "City",
                "State",
                "Joined Date",
                "Action"
            ],
            pagination: {
                limit: 8
            },
            sort: true,
            search: true,
            data: users,
        }).render(document.getElementById("table-member-list"));
    })();
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#country-dd').on('change', function () {
            var idCountry = this.value;
            $("#state-dd").html('');
            $.ajax({
                url: "{{url('api/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dd').html('<option value="">Select State</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dd').html('<option value="">Select City</option>');
                }
            });
        });
        $('#state-dd').on('change', function () {
            var idState = this.value;
            $("#city-dd").html('');
            $.ajax({
                url: "{{url('api/fetch-cities')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#city-dd').html('<option value="">Select City</option>');
                    $.each(res.cities, function (key, value) {
                        $("#city-dd").append('<option value="' + value.id + '">' + value.name + '</option>');
                        // $("#city-dd").append(`<option value="${value.id}">${value.name}</option>`);
                    });
                }
            });
        });
    });
</script>

@php
function formatDate($dateString) {
    return date('d/m/Y', strtotime($dateString));
}
@endphp



@endsection
