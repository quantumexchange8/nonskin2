@extends('layouts.master')
@section('title')
    Order Listing
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Order Listing @endslot
    @endcomponent

    @section('css')
        <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    @endsection

    @section('modal')
        @foreach($orders as $order)
            @include('admin.orders.modal.orderdetail')
            {{-- @include('member.modals.order_detail_modal') --}}
        @endforeach
    @endsection
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="position-relative">
                        <div class="modal-button mt-2">
                            <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".add-new-order"><i class="mdi mdi-plus me-1"></i> Add New Order</button>
                        </div>
                    </div> --}}
                    <table id="allOrder" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Date</th>
                                <th>Shipping Type</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-bold">#{{$order->order_num}}</td>
                                <td>
                                    @if($order->delivery_method == 'Delivery')
                                        {{ $order->receiver}}
                                    @endif
                                </td>
                                <td>{{ $order->contact }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td>
                                    @if($order->delivery_method == 'Delivery')
                                        <i class="bx bxs-truck me-2"></i> {{ $order->delivery_method }}
                                    @else
                                        <i class="bx bxs-store-alt me-2"></i> {{ $order->delivery_method }}
                                    @endif
                                </td>
                                <td>
                                    @switch($order->payment_method)
                                        @case('Manual Transfer')
                                            <i class="fab fa-cc-paypal me-2"></i> {{ $order->payment_method }}
                                            @break
                                        @case('Online Banking')
                                            <i class="fab fa-cc-mastercard me-2"></i> {{ $order->payment_method }}
                                            @break
                                        @default
                                            <i class="fas fa-money-bill-alt me-2"></i> {{ $order->payment_method }}
                                    @endswitch
                                </td>
                                <td>
                                    @if($order->status == 1)
                                        <span class="badge badge-pill badge-soft-secondary font-size-12">
                                            Processing
                                        </span>
                                    @elseif($order->status == 2)
                                        <span class="badge badge-pill badge-soft-success font-size-12">
                                            Packing
                                        </span>
                                    @elseif($order->status == 3)
                                        <span class="badge badge-pill badge-soft-warning font-size-12">
                                            Delivering
                                        </span>
                                    @elseif($order->status == 4)
                                        <span class="badge badge-pill badge-soft-success font-size-12">
                                            Complete
                                        </span>
                                    @elseif($order->status == 6)
                                        <span class="badge badge-pill badge-soft-danger font-size-12">
                                            Rejected
                                        </span>
                                    @elseif($order->status == 9)
                                        <span class="badge badge-pill badge-soft-danger font-size-12">
                                            Pending payment
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-soft-danger font-size-12">
                                            Pending Refund
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                            <button type="button" class="btn btn-link view-detail-button" data-bs-toggle="modal" data-bs-target="#orderdetailsModal_{{ $order->id }}" id="{{$order->id}}">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </button>
                                            @include('admin.orders.modal.orderdetail')


                                        {{-- </form> --}}

                                        {{-- <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" data-bs-original-title="Cancel" class="text-danger"> --}}
                                            <form action="{{ route('rejectorder', $order->id) }}" method="POST" id="reject-form-{{ $order->id }}">
                                                @csrf
                                                <input type="hidden" name="remark" id="remark-{{ $order->id }}">
                                                <button type="button" class="btn btn-link text-danger reject-button" data-order-id="{{ $order->id }}" data-order-status="{{ $order->status }}">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </button>
                                            </form>
                                        {{-- </a> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/js/pages/admin-pending-orders.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        const customLanguage = {
            search: "Search Order ID:"
        };

        new DataTable('#allOrder', {
            responsive: true,
            pagingType: 'simple_numbers',
            lengthChange: false,
            language: customLanguage // Provide the custom language object
        });

        $(document).ready(function() {

            $('.btn-edit').on('click', function() {

                // Show Save and Cancel buttons, hide Edit Profile button
                $('#save-profile-button, #cancel-edit-button').removeClass('d-none');
                $('.btn-edit').addClass('d-none');

                // Show input fields and hide labels
                $('#status-section span').addClass('d-none');
                $('#status-section select').removeClass('d-none');

                $('#consignment-section span').addClass('d-none');
                $('#consignment-section input').removeClass('d-none');

                $('#courier-section span').addClass('d-none');
                $('#courier-section input').removeClass('d-none');

                $('#tracking-section span').addClass('d-none');
                $('#tracking-section input').removeClass('d-none');
            });

            $('.btn-cancel-edit').on('click', function() {
                // Show SweetAlert 2 confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Changes will be discarded.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel',
                    cancelButtonText: 'No, keep editing',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, perform cancel action
                        // For example, you can reset the form or redirect
                        // Here, I'm using window.location to redirect to another page
                        window.location.href = '{{ route('new-order-list') }}';
                    }
                });
            });

            $('#save-profile-button').on('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Confirm Save',
                    text: 'Are you sure you want to save the changes?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, save',
                    cancelButtonText: 'No, cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, submit the form
                        $('#status-form-{{ $order->id }}').submit(); // Submit the correct form to the controller
                    }
                });
            });
        });

    </script>

@endsection
