@extends('layouts.master')
@section('title')
    New Orders
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') New Orders @endslot
    @endcomponent

    @section('css')
        <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    @endsection
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <div class="modal-button mt-2">
                            <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".add-new-order"><i class="mdi mdi-plus me-1"></i> Add New Order</button>
                        </div>
                    </div>
                    <div id="table-new-orders" data-new-orders="{{ $ordersJson }}"></div>
                    @php
                        // dd($orders);
                    @endphp
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Add New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="AddOrder-Product">Choose Product</label>
                            <select class="form-select" required>
                                <option value="" selected> Select Product </option>
                                <option>Adidas Running Shoes</option>
                                <option>Puma P103 Shoes</option>
                                <option>Adidas AB23 Shoes</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="AddOrder-Billing-Name">Billing Name</label>
                                <input type="text" class="form-control" placeholder="Enter Billing Name" id="AddOrder-Billing-Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control" placeholder="Select Date" id="order-date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="AddOrder-Total">Total</label>
                                <input type="text" class="form-control" placeholder="$565" id="AddOrder-Total" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="AddOrder-Payment-Status">Payment Status</label>
                                <select class="form-select" required>
                                    <option value="" selected> Select Card Type </option>
                                    <option>Paid</option>
                                    <option>Chargeback</option>
                                    <option>Refund</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="AddOrder-Payment-Method">Payment Method</label>
                                <select class="form-select" required>
                                    <option value="" selected> Select Payment Method </option>
                                    <option> Mastercard</option>
                                    <option>Visa</option>
                                    <option>Paypal</option>
                                    <option>COD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i class="bx bx-x me-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn" id="btn-save-event"><i class="bx bx-check me-1"></i> Confirm</button>
                    </div>
                </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="bx bx-check-circle display-1 text-success"></i>
                        <h3 class="mt-3">Order Completed Successfully</h3>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Product Id: <span class="text-primary">#SK2540</span></p>
                    <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="{{ URL::asset('assets/images/product/img-1.png') }}" alt="" class="avatar-md">
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">Nike N012 Shoes</h5>
                                            <p class="text-muted mb-0">$ 225 x 1</p>
                                        </div>
                                    </td>
                                    <td>$ 255</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="{{ URL::asset('assets/images/product/img-4.png') }}" alt="" class="avatar-md">
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">Sports S120 Shoes</h5>
                                            <p class="text-muted mb-0">$ 145 x 1</p>
                                        </div>
                                    </td>
                                    <td>$ 145</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                    </td>
                                    <td>
                                        $ 400
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Shipping:</h6>
                                    </td>
                                    <td>
                                        Free
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Total:</h6>
                                    </td>
                                    <td>
                                        $ 400
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/js/pages/admin-pending-orders.js') }}"></script> --}}
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
    const ordersData = document.getElementById("table-new-orders").dataset.newOrders;
    const orders = JSON.parse(ordersData);
    console.log(orders);
    new gridjs.Grid({
        columns: [
            { id: 'id', name: '#', width: '5%' },
            {
                id: 'order_num',
                name: 'Order Number',
                formatter: (cell) => gridjs.html(`<span class="fw-semibold">#${cell}</span>`),
            },
            {
                id: 'total_amount',
                name: 'Total Amount',
                width: '9%',
                formatter: (function (cell) {
                    return gridjs.html('RM ' + cell.toLocaleString(undefined, { minimumFractionDigits: 2 }))
                })
            },
            {
                id: "payment_method",
                name: "Payment Method",
                formatter: (function (cell) {
                    switch (cell) {
                        case "Online Banking":
                            return gridjs.html('<i class="fab fa-cc-mastercard me-2"></i>' + cell);
                        case "Visa":
                            return gridjs.html('<i class="fab fa-cc-visa me-2"></i>' + cell);
                        case "Manual Transfer":
                            return gridjs.html('<i class="fab fa-cc-paypal me-2"></i>' + cell);
                        case "Payment at Counter":
                            return gridjs.html('<i class="fas fa-money-bill-alt me-2"></i>' + cell);
                        default:
                            return gridjs.html('<i class="fab fa-cc-visa me-2"></i>' + cell);
                    }
                })
            },
            {
                id: "delivery_method",
                name: "Delivery Method",
                formatter: (function (cell) {
                    switch (cell) {
                        case "Self-Pickup":
                            return gridjs.html('<i class="bx bxs-store-alt me-2"></i>' + cell);
                        case "Delivery":
                            return gridjs.html('<i class="bx bxs-truck me-2"></i>' + cell);
                        default:
                            return gridjs.html('<i class="fab fa-cc-visa me-2"></i>' + cell);
                    }
                })
            },
            {
                id: "receiver",
                name: "Receiver"
            },
            {
                id: "contact",
                name: "Contact",
                width: '8%'
            },
            {
                id: "delivery_address",
                name: "Address",
                width: '20%'
            },
            {
                name: "Action",
                width: '7%',
                sort: {
                    enabled: false
                },
                formatter: (function (cell) {
                    return gridjs.html('<div class="d-flex gap-3"><a href="#" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary"><i class="mdi mdi-eye-outline font-size-18"></i></a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a></div>');
                })
            }
        ],
        pagination: {
            limit: 8
        },
        sort: true,
        search: true,
        data: orders,
    }).render(document.getElementById("table-new-orders"));



    flatpickr('#order-date', {
        defaultDate: new Date(),
        dateFormat: "d M, Y",
    });
</script>
@endsection
