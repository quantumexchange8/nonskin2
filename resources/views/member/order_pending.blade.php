@extends('layouts.master')
@section('title')
    My Orders
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('url') {{ route('user-dashboard') }} @endslot
        @slot('title') My Orders @endslot
    @endcomponent

    @section('modal')
        @foreach($orders as $order)
            @include('member.modals.order_detail_modal')
            @include('member.modals.order_payment_modal')
        @endforeach
    @endsection

    <style>
        .custom-excel-button {
            background-color: #2b8972;
            color: #ffffff;
            width: 100px;
            height: 40px;
            border: none;
            border-radius: 10px;
        }
        .dt-buttons {
            display: flex;
            justify-content: flex-end; /* Adjust as needed */
            margin-bottom: 30px; /* Adjust as needed */
        }
        .dataTables_wrapper .dataTables_filter input[type="search"] {
            /* Your custom styles here */
            /* display: block;
            width: 100%; */
            padding: 0.47rem 0.75rem;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e5e8;
            /* Add more styles as needed */
        }
        .dataTables_wrapper .dataTables_filter {
            float: left; /* Move the search field to the left */
            text-align: left;
            width: 570px;
        }
        .dataTables_filter input {
            width: 570px;
        }
    </style>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="allOrder" class="stripe nowrap" style="width:100%">
                        <div style="display: flex;align-items: flex-end;justify-content: center;padding-left: 26px;padding-right: 26px;padding-bottom: 30px;">
                            <div class="col-lg-4" style="width:50%;margin-right:10px">
                                <label class="form-label">Date</label>
                                <input type="date" id="date-filter-input" class="form-control">
                            </div>
                            <div class="col-lg-4" style="width:50%">
                                <label class="form-label">Status</label>
                                <select class="form-control" id="status-filter-input">
                                    <option value="">All Status</option>                                                                               
                                    <option value="Processing">Processing</option>
                                    <option value="Packing">Packing</option>
                                    <option value="Delivering">Delivering</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Reject">Reject</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div style="margin-left: 10px;">
                                <form>
                                    <button class="btn btn-primary" type="submit" value="reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Price</th>
                                <th>Shipping Type</th>
                                <th>Courier</th>
                                <th>Tracking No</th>
                                
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->updated_at }}</td>
                                <td class="fw-bold">{{$order->order_num}}</td>
                                <td>RM {{ number_format($order->total_amount, 2) }}</td>
                                <td>{{$order->delivery_method}}</td>
                                <td>{{ $order->courier ?? '-' }}</td>
                                <td>{{ $order->tracking_number ?? '-' }}</td>
                                <td>{{$order->payment_method}}</td>
                                <td>
                                    @php
                                        $statusMapping = [
                                            1 => ['class' => 'badge badge-pill badge-soft-secondary', 'text' => 'Processing'],
                                            2 => ['class' => 'badge badge-pill badge-soft-success', 'text' => 'Packing'],
                                            3 => ['class' => 'badge badge-pill badge-soft-warning', 'text' => 'Delivering'],
                                            4 => ['class' => 'badge badge-pill badge-soft-success', 'text' => 'Complete'],
                                            5 => ['class' => 'badge badge-pill badge-soft-danger', 'text' => 'Cancel'],
                                            6 => ['class' => 'badge badge-pill badge-soft-danger', 'text' => 'Reject'],
                                            9 => ['class' => 'badge badge-pill badge-soft-danger', 'text' => 'Unpaid'],
                                        ];
                                    @endphp
                                    <span class="{{ $statusMapping[$order->status]['class'] }}">{{ $statusMapping[$order->status]['text'] }}</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                            @if($order->status == 9)
                                                <button type="button" class="btn btn-link btn-sm btn-rounded upload-payment-button" data-bs-toggle="modal" data-bs-target="#orderPaymentModal_{{ $order->id }}" id="{{$order->id}}">
                                                    <i class="mdi mdi-upload"></i>
                                                </button>
                                            @endif
                                            <button type="button" class="btn btn-link btn-sm btn-rounded view-detail-button" data-bs-toggle="modal" data-bs-target="#orderdetailsModal_{{ $order->id }}" id="{{$order->id}}">
                                                <i class="mdi mdi-printer-settings"></i>
                                            </button>
                                            <form action="{{ route('member.cancelorder', $order->id) }}" method="POST" id="delete-form-{{ $order->id }}">
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {

        var table = $('#allOrder').DataTable({
            lengthChange: false,
            order: [[0, 'desc']],
            dom: '<"row"<"col-lg-10"f><"col-lg-2"B>>' +
                    '<"row"<"col-lg-12"t>>' +
                    '<"row"<"col-lg-6"i><"col-lg-6"p>>',
            buttons: [
                {
                    extend: 'excel',
                    text: 'Export Excel',
                    className: 'custom-excel-button'
                }
            ],
            "columnDefs": [
                {
                    "targets": [1],
                    "type": "date-range",
                    "searchable": true
                }
            ],
            language: {
                search: 'Search:'
            }
        });

        // Add an event listener to the date input field
        $('#date-filter-input').on('change', function() {
            var selectedDate = $(this).val();
            if (selectedDate) {
                // Use DataTables search to filter rows based on a custom function
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var dateColumn = data[1]; // Assuming date is in the second column
                        // Format the selected date to match the database format ('YYYY-MM-DD HH:mm:ss')
                        var formattedDate = moment(selectedDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
                        return dateColumn.includes(formattedDate);
                    }
                );
                // Redraw the DataTable to apply the filter
                table.draw();
                // Remove the custom filter function to avoid interference with other searches
                $.fn.dataTable.ext.search.pop();
            } else {
                // If no date is selected, clear the filter
                table.search('').draw();
            }
        });

        $('#status-filter-input').on('change', function() {
            var selectedStatus = $(this).val();
            if (selectedStatus) {
                // Use DataTables search to filter rows based on the selected status
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var statusColumn = data[8]; // Assuming status is in the ninth column (index 8) //table column
                        return statusColumn === selectedStatus;
                    }
                );
                // Redraw the DataTable to apply the filter
                table.draw();
                // Remove the custom filter function to avoid interference with other searches
                $.fn.dataTable.ext.search.pop();
            } else {
                // If no status is selected, clear the filter
                table.search('').draw();
            }
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

    {{-- <script>

        const customLanguage = {
            search: "Search Order ID:"
        };

        var table = new DataTable('#allOrder', {
            responsive: true,
            searching: false,
            pagingType: 'simple_numbers',
            lengthChange: false,
            order: [[0, 'desc']], // Default sorting order
            language: customLanguage, // Custom language object
            buttons: [
                'excelHtml5'
            ]
        });

        // Add event listener to the date filter input
        document.getElementById('date-filter-input').addEventListener('change', function() {
            var selectedDate = this.value;

            // Filter the table based on the selected date
            filterTableByDate(selectedDate);
        });

        function filterTableByDate(selectedDate) {
            var rows = document.querySelectorAll("#allOrder tbody tr");

            rows.forEach(function(row) {
                var dateCell = row.querySelector("td:nth-child(8)"); // Assuming date is in the 8th column
                var dateCellValue = dateCell.textContent;

                // Extract the date part from the full date-time value
                var cleanedDateCellValue = dateCellValue.split(' ')[0];

                var formattedCellValue = formatDate(cleanedDateCellValue);
                var formattedSelectedDate = formatDate(selectedDate);

                if (formattedCellValue === formattedSelectedDate) {
                    row.style.display = "table-row"; // Show the row
                } else {
                    row.style.display = "none"; // Hide the row
                }
            });
        }

        function formatDate(date) {
            // Convert date format from 'YYYY-MM-DD' to 'DD/MM/YYYY'
            var parts = date.split("-");
            var formattedDate = parts[2] + "/" + parts[1] + "/" + parts[0];
            return formattedDate;
        }



        document.addEventListener("DOMContentLoaded", function () {
            const tableBody = document.querySelector("#allOrder tbody");
            const searchInput = document.getElementById("search-input");
            const dataTable = $('#allOrder').DataTable(); // Initialize DataTables

            // Store order data globally
            const orders = []; // An array to store all order objects
            const rows = tableBody.querySelectorAll("tr");

            // Populate the orders array with data from the rows
            rows.forEach(function (row) {
                const orderNumberCell = row.querySelector("td[data-order-no]");
                if (orderNumberCell) {
                    const orderNumber = orderNumberCell.getAttribute("data-order-no");
                    orders.push({
                        orderNumber: orderNumber.toLowerCase(),
                        row: row,
                    });
                }
            });

            searchInput.addEventListener("input", function () {
                const searchText = searchInput.value.trim().toLowerCase();

                // Filter orders that match the search
                const filteredOrders = orders.filter(order => order.orderNumber.includes(searchText));

                // Update the visibility of rows based on filteredOrders
                rows.forEach(row => {
                    const isVisible = filteredOrders.some(filteredOrder => filteredOrder.row === row);
                    row.style.display = isVisible ? "" : "none";
                });

                // Update DataTables search term and redraw
                dataTable.search(searchText).draw();
            });
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


    </script> --}}
@endsection
