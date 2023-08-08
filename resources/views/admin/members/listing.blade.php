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

    @section('modal')
        @include('modals.create-member')
    @endsection

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{-- <div class="card-header">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target=".modal-update-member"><i class='bx bx-plus-circle'></i> Add member</button>
                </div> --}}
                <div class="card-body">
                    {{-- <div id="table-member-list"></div> --}}
                    <table id="allMember" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Upline Name</th>
                                <th>Referrer ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Ranking</th>
                                <th>Postcode</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Joined Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->upline->name }}</td>
                                <td class="fw-bold">#{{ $user->referrer_id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->ranking_name }}</td>
                                <td>{{ $user->postcode }}</td>
                                <td>{{ $user->city }}</td>
                                <td>{{ $user->state }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div class="d-flex gap-1 align-items-center">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary">
                                            <i class="mdi mdi-eye-outline font-size-18"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" data-bs-original-title="Cancel" class="text-danger">
                                            <form action="" method="POST" {{-- id="delete-form-{{ $order->id }}" --}} >
                                                @csrf
                                                <button type="button" class="btn p-0 btn-link text-danger delete-button" {{-- data-order-id="{{ $order->id }}" data-order-status="{{ $order->status }}" --}} >
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </button>
                                            </form>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            {{-- @foreach($orders as $order)
                            <tr>
                                <td class="fw-bold">#{{$order->order_num}}</td>
                                <td>
                                    @if($order->delivery_method == 'Delivery')
                                        {{ $order->receiver}}
                                    @endif
                                </td>
                                <td>{{ $order->contact }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-rounded view-detail-button" data-bs-toggle="modal" data-bs-target="#orderdetailsModal_{{ $order->id }}" id="{{$order->id}}">
                                        View Details
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex gap-1 align-items-center">
                                        {{-- <span data-bs-toggle="modal" data-bs-target=".orderdetailsModal">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary">
                                                <i class="mdi mdi-eye-outline font-size-18"></i>
                                            </a>
                                        </span> --}}
                                        {{-- /<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a> --}}
                                        {{-- <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" data-bs-original-title="Cancel" class="text-danger"> --}}
                                            {{-- <form action="{{ route('cancelorder', $order->id) }}" method="POST" id="delete-form-{{ $order->id }}">
                                                @csrf
                                                <button type="button" class="btn btn-link text-danger delete-button" data-order-id="{{ $order->id }}" data-order-status="{{ $order->status }}">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </button>
                                            </form> --}}
                                        {{-- </a> --}}
                                    </div>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
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
    new DataTable('#allMember', {
        responsive: true,
        pagingType: 'simple_numbers',
        lengthChange: false
    });
</script>

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
