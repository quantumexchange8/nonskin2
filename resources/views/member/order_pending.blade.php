@extends('layouts.master')
@section('title')
    My Orders
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') My Orders @endslot
    @endcomponent

    @section('modal')
        @foreach($orders as $order)
            @include('member.modals.order_detail_modal')
        @endforeach
    @endsection

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="input-group">
                        <input type="date" id="date-filter-input" class="form-control">
                    </div>

                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="1">Processing</option>
                        <option value="2">Packing</option>
                        <option value="3">Delivering</option>
                        <option value="4">Complete</option>
                        <option value="5">Cancel</option>
                    </select>

                    <table id="allOrder" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Price</th>
                                <th>Shipping Type</th>
                                <th>Courier</th>
                                <th>Consignment No</th>
                                <th>Tracking No</th>
                                <th>Date</th>
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
                                <td>RM {{ number_format($order->total_amount, 2) }}</td>
                                <td>{{$order->delivery_method}}</td>
                                <td>{{ $order->courier ?? '-' }}</td>
                                <td>{{ $order->cn ?? '-' }}</td>
                                <td>{{ $order->tracking_number ?? '-' }}</td>
                                <td>{{$order->created_at->format('d/m/Y, h:i:s')}}</td>
                                <td>{{$order->payment_method}}</td>
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
                                            {{-- <button type="button" class="btn btn-link view-invoice-button" data-bs-toggle="modal" data-bs-target="#orderinvoice{{ $order->id }}" id="{{$order->id}}">
                                                <i class="mdi mdi-printer-settings"></i>
                                            </button> --}}
                                            <button type="button" class="btn btn-link btn-sm btn-rounded view-detail-button" data-bs-toggle="modal" data-bs-target="#orderdetailsModal_{{ $order->id }}" id="{{$order->id}}">
                                                <i class="mdi mdi-printer-settings"></i>
                                            </button>
                                            <form action="{{ route('cancelorder', $order->id) }}" method="POST" id="delete-form-{{ $order->id }}">
                                                @csrf
                                                <input type="hidden" name="remark" id="remark-{{ $order->id }}">
                                                <button type="button" class="btn btn-link text-danger delete-button" data-order-id="{{ $order->id }}" data-order-status="{{ $order->status }}">
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
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>

        const customLanguage = {
            search: "Search Order ID:"
        };

        var table = new DataTable('#allOrder', {
            responsive: true,
            pagingType: 'simple_numbers',
            lengthChange: false,
            order: [[0, 'desc']], // Default sorting order
            language: customLanguage // Custom language object
        });

        // Add event listener to the date filter input
        document.getElementById('date-filter-input').addEventListener('change', function() {
            var selectedDate = this.value;
            table.search('').column(4).search(selectedDate).draw();
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

        // Handle click event for "View Details" button
        document.querySelectorAll('.view-details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const orderNum = this.getAttribute('data-bs-order-num');
                document.getElementById('order-id').textContent = orderNum;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Add click event listeners to all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const orderStatus = this.getAttribute('data-order-status');

                    if (orderStatus === '5') {
                        Swal.fire({
                            title: 'Error',
                            text: 'This order has already been cancelled!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else if(orderStatus === '4') {
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
                    } else {
                        // Show SweetAlert 2 confirmation dialog
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'You will not be able to recover this order!',
                            icon: 'warning',
                            input: 'text', // Use a text input
                            inputLabel: 'Remark',
                            inputPlaceholder: 'Enter your remark...',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const remark = result.value;
                                if (remark) {
                                    const form = document.getElementById('delete-form-' + orderId);
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
                    }
                });
            });
        });


    </script>
@endsection
