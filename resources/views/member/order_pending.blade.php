@extends('layouts.master')
@section('title')
    My Orders
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url')
            {{ url('/') }}
        @endslot
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            My Orders
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <table id="allOrder" class="stripe mb-0">
                                    <thead>
                                        <tr>
                                            <td>Order ID</td>
                                            <td>Name</td>
                                            <td>Contact</td>
                                            <td>Date</td>
                                            <td>Shipping Type</td>
                                            <td>Payment Method</td>
                                            <td>View Details</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->order_num}}</td>
                                            <td>
                                                @if($order->delivery_method == 'Delivery')
                                                    {{$order->receiver}}
                                                @endif
                                            </td>
                                            <td>{{$order->contact}}</td>
                                            <td>{{$order->updated_at}}</td>
                                            <td>{{$order->delivery_method}}</td>
                                            <td>{{$order->payment_method}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded view-detail-button" data-bs-toggle="modal" data-bs-target="#orderdetailsModal_{{ $order->id }}" id="{{$order->id}}">
                                                    View Details
                                                </button>
                                                @include('member.modals.order_detail_modal')
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
                                                    @else
                                                    <span class="badge badge-pill badge-soft-danger font-size-12">
                                                        Cancelled
                                                    </span>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    {{-- <span data-bs-toggle="modal" data-bs-target=".orderdetailsModal">
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary">
                                                            <i class="mdi mdi-eye-outline font-size-18"></i>
                                                        </a>
                                                    </span> --}}
                                                    {{-- <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a> --}}
                                                    {{-- <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" data-bs-original-title="Cancel" class="text-danger"> --}}
                                                        <form action="{{ route('cancelorder', $order->id) }}" method="POST" id="delete-form-{{ $order->id }}">
                                                            @csrf
                                                            <button type="button" class="btn btn-link text-danger delete-button" data-order-id="{{ $order->id }}">
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
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        new DataTable('#allOrder', {
            responsive: true,
            pagingType: 'simple_numbers',
            lengthChange: false
        });

        // Handle click event for "View Details" button
        document.querySelectorAll('.view-details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const orderNum = this.getAttribute('data-bs-order-num');
                document.getElementById('order-id').textContent = orderNum;

                console.log(orderNum)
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
        // Add click event listeners to all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the order ID from the data attribute
                const orderId = this.getAttribute('data-order-id');
                // Get the corresponding form
                const form = document.getElementById('delete-form-' + orderId);
                // Submit the form
                form.submit();
            });
        });
    });

        
    </script>
@endsection
