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
                                <th>#</th>
                                <th>User ID</th>
                                <th>Referral ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Ranking</th>
                                <th>Joined Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->id }}</td>
                                <td class="fw-bold">{{ $user->referrer_id }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>{{ $user->rank->name}}</td>
                                <td>{{ $user->created_at->format('d/m/Y, h:i:s') }}</td>
                                <td>
                                    <div class="d-flex gap-1 align-items-center">
                                        {{-- <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary">
                                            <i class="mdi mdi-eye-outline font-size-18"></i>
                                        </a> --}}
                                        <a href="{{ route('members.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <form method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('members.destroy', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" data-confirm-delete="true" class="text-danger">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </form>
                                        {{-- <form method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('members.destroy', $user->id) }}" class="btn btn-sm btn-soft-danger waves-effect waves-light bx bxs-trash font-size-14 align-middle" data-confirm-delete="true"></a>
                                        </form> --}}
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
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        new DataTable('#allMember', {
            responsive: true,
            pagingType: 'simple_numbers',
            lengthChange: false
        });
    </script>

@endsection
