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

        document.addEventListener('DOMContentLoaded', function() {
            // Add click event listeners to all delete buttons
            const deleteButtons = document.querySelectorAll('.reject-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const orderStatus = this.getAttribute('data-order-status');

                    // if (orderStatus === '5') {
                    //     Swal.fire({
                    //         title: 'Error',
                    //         text: 'This order has already been cancelled!',
                    //         icon: 'error',
                    //         confirmButtonText: 'Ok'
                    //     });
                    // } else 
                    if(orderStatus === '4') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This order has already completed!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else if(orderStatus === '3') {
                        Swal.fire({
                            title: 'Warning',
                            text: 'This order has already shipped out!',
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        });
                    } else if(orderStatus === '6') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This order has already rejected!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        // Show SweetAlert 2 confirmation dialog
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'You will not be able to recover this order!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, reject it!',
                            cancelButtonText: 'Cancel',
                            input: 'text', // Add an input field
                            inputPlaceholder: 'Enter your remark', // Placeholder for the input field
                            inputValidator: (value) => {
                                // Check if the input field is not empty
                                if (!value) {
                                    return 'Remark is required'; // Show error message
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // If the user confirms, submit the form to delete the order
                                const remark = result.value; // Get the value of the input field
                                const form = document.getElementById('reject-form-' + orderId);
                                const remarkInput = form.querySelector('#remark-' + orderId);
                                remarkInput.value = remark; // Set the value of the hidden input field
                                form.submit();
                            }
                        });
                    }
                });
            });

            

            const modalCloseButtons = document.querySelectorAll('.modal .btn-secondary'); // Select all "Close" buttons in modals

            modalCloseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = button.closest('.modal'); // Find the closest modal to the clicked button
                    modal.classList.remove('show'); // Hide the modal
                    modal.setAttribute('aria-hidden', 'true');
                    modal.setAttribute('style', 'display: none');
                });
            });
        });

        $(document).ready(function () {
    // function toggleEditMode() {
    //     $(".edit-mode").toggle();
    //     $(".btn-edit").toggle();
    //     $(".btn-packing").toggle();
    //     $(".badge").toggle();
    // }

    // $(".btn-edit").click(function () {
    //     toggleEditMode();
    // });

    // $(".btn-cancel").click(function () {
    //     toggleEditMode();
    // });

    $(".btn-edit").click(function () {
        const orderId = this.getAttribute('data-order-id-edit');
        const orderStatus = this.getAttribute('data-order-status-edit'); // Assuming $order->status is accessible in this context

        let inputOptions = {};
        if (orderStatus == 1){
            inputOptions = {
                2: 'Packing',
                3: 'Delivering',
                4: 'Complete'
            };
        }else if (orderStatus == 2) {
            inputOptions = {
                3: 'Delivering',
                4: 'Complete'
            };
        } else if (orderStatus == 3) {
            inputOptions = {
                4: 'Complete'
            };
        } else if (orderStatus == 9) {
            inputOptions = {
                2: 'Packing',
                3: 'Delivering',
                4: 'Complete'
            };
        }

        // Show SweetAlert 2 confirmation dialog
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to update the status?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#51D28C',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel',
            input: 'select', // Use 'select' input type for a dropdown
            inputOptions: inputOptions,
            inputPlaceholder: 'Select new status',
            inputValidator: (value) => {
                if (!value) {
                    return 'Status selection is required';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const selectedStatus = result.value;
                
                if (selectedStatus) {
                    const statusInput = document.querySelector('#status-form-' + orderId + ' .form-select');
                    console.log(statusInput)
                    if (statusInput) {
                        statusInput.value = selectedStatus;
                        console.log(statusInput.value);
                        
                        const form = statusInput.closest('form');
                        form.submit();
                    } else {
                        console.log('Status input not found.');
                    }
                }
            }
        });
    });
});



    </script>
    
@endsection
