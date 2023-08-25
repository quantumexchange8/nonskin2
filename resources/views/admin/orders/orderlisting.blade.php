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
                        <div class="row justify-content-end">
                            <div class="col-lg-3">
                                <label class="form-label">Status</label>
                                <select class="mb-3 form-select" id="statusFilter">
                                    <option value="">All Status</option>
                                    <option value="1">Processing</option>
                                    <option value="2">Packing</option>
                                    <option value="3">Delivering</option>
                                    <option value="4">Complete</option>
                                    <option value="5">Cancel</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label class="form-label">Date</label>
                                <input type="date" id="date-filter" class="form-control">
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Search</label>
                                <input type="text" id="search-input" class="form-control" placeholder="Enter keywords here...">
                            </div>
                            <div class="col-lg-1" style="display: flex;align-items: center;margin-top: 14px; ">
                                <form id="myForm">
                                    <button type="submit" value="reset" class="btn btn-primary">Clear</button>
                                </form>
                                
                            </div>
                            {{-- <div class="col-lg-3">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary w-100">Search</button>
                            </div> --}}
                        </div>
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
                                <td class="fw-bold">{{$order->order_num}}</td>
                                <td>{{ $order->receiver}}</td>
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
                                <td data-status="{{ $order->status }}">
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
                                            <form action="{{ route('orders.rejectorder', $order->id) }}" method="POST" id="reject-form-{{ $order->id }}">
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

        var table = new DataTable('#allOrder', {
            responsive: true,
            searching: false,
            pagingType: 'simple_numbers',
            lengthChange: false,
            order: [[0, 'desc']], // Default sorting order
            language: customLanguage // Custom language object
        });

        // Add event listener to the date filter input
        document.getElementById('date-filter').addEventListener('change', function() {
            var selectedDate = this.value;
            table.search(selectedDate).draw();
        });

        document.addEventListener("DOMContentLoaded", function () {
            const statusFilter = document.getElementById("statusFilter");
            const tableBody = document.querySelector("#allOrder tbody");

            statusFilter.addEventListener("change", function () {
                const selectedStatus = statusFilter.value;

                const rows = tableBody.querySelectorAll("tr");
                rows.forEach(function (row) {
                    const statusCell = row.querySelector("td[data-status]");

                    if (!statusCell) {
                        return; // Skip rows without data-status attribute
                    }

                    const statusBadge = statusCell.querySelector(".badge");

                    if (!selectedStatus || (statusBadge && selectedStatus === statusCell.getAttribute("data-status"))) {
                        row.style.display = ""; // Show the row
                    } else {
                        row.style.display = "none"; // Hide the row
                    }
                });
            });
        });


        @if (!$orders->isEmpty())
            $(document).ready(function() {
                var isEditing = false; // Variable to track editing status
                $('.btn-edit').on('click', function() {

                    var order_id = $(this).data('order-edit');

                    // Show Save and Cancel buttons, hide Edit Profile button
                    $('#save-profile-button, #cancel-edit-button').removeClass('d-none');
                    $('.btn-edit').addClass('d-none');
                    $('.btn-close-modal').addClass('d-none');

                    // Show input fields and hide labels
                    $('#status-section-' + order_id + ' span').addClass('d-none');
                    $('#status-section-' + order_id + ' select').removeClass('d-none');

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
                            window.location.href = '{{ route('orders.listing') }}';
                        }
                    });
                });

                $('.reject-button').on('click', function() {
                    var order_id = $(this).data('order-id');
                    var order_status = $(this).data('order-status');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action will reject the order. Are you sure you want to proceed?',
                        icon: 'warning',
                        input: 'text', // Use a text input
                        inputLabel: 'Remark',
                        inputPlaceholder: 'Enter your remark...',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, reject',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const remark = result.value;
                            if(remark) {
                                const form = document.getElementById('reject-form-' + order_id);
                                const remarkInput = document.createElement('input');
                                remarkInput.type = 'hidden';
                                remarkInput.name = 'remark';
                                remarkInput.value = remark;
                                form.appendChild(remarkInput);
                                form.submit();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Remark cannot be empty.',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            }
                        }
                    });
                });

                $('.btn-save-profile').on('click', function(event) {
                    event.preventDefault();

                    var order_id = $(this).data('order-id');

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
                             $('#status-form-' + order_id).submit(); // Submit the correct form to the controller
                        }
                    });
                });
            });
        @endif


    </script>

@endsection
