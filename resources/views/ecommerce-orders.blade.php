@extends('layouts.master')
@section('title') @lang('translation.Orders') @endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection

    @section('content')
    @component('components.breadcrumb')
    @slot('li_1') Ecommerce @endslot
    @slot('title') Orders @endslot
    @endcomponent


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="position-relative">
                                <div class="modal-button mt-2">
                                    <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".add-new-order"><i class="mdi mdi-plus me-1"></i> Add New Order</button>
                                </div>
                            </div>
                            <div id="table-ecommerce-orders"></div>
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
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-orders.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    {{-- <script>
        new gridjs.Grid({
            columns:
                [
                    {
                        name: '#',
                        sort: {
                            enabled: false
                        },
                        formatter: (function (cell) {
                            return gridjs.html('<div class="form-check font-size-16"><input class="form-check-input" type="checkbox" id="orderidcheck01"><label class="form-check-label" for="orderidcheck01"></label></div>');
                        })
                    },
                    {
                        name: 'Order ID',
                        formatter: (function (cell) {
                            return gridjs.html('<span class="fw-semibold">' + cell + '</span>');
                        })
                    },
                    "Billing Name", "Date", "Total",
                    {
                        name: 'Payment Status',
                        formatter: (function (cell) {
                            switch (cell) {
                                case "Paid":
                                    return gridjs.html('<span class="badge badge-pill badge-soft-success font-size-12">' + cell + '</span>');

                                case "Chargeback":
                                    return gridjs.html('<span class="badge badge-pill badge-soft-danger font-size-12">' + cell + '</span>');

                                case "Refund":
                                    return gridjs.html('<span class="badge badge-pill badge-soft-warning font-size-12">' + cell + '</span>');

                                default:
                                    return gridjs.html('<span class="badge badge-pill badge-soft-success font-size-12">' + cell + '</span>');
                            }
                        })
                    },
                    {
                        name: "Payment Method",
                        formatter: (function (cell) {
                            switch (cell) {
                                case "Mastercard":
                                    return gridjs.html('<i class="fab fa-cc-mastercard me-2"></i>' + cell);
                                case "Visa":
                                    return gridjs.html('<i class="fab fa-cc-visa me-2"></i>' + cell);
                                case "Paypal":
                                    return gridjs.html('<i class="fab fa-cc-paypal me-2"></i>' + cell);
                                case "COD":
                                    return gridjs.html('<i class="fas fa-money-bill-alt me-2"></i>' + cell);
                            }
                        })
                    },
                    {
                        name: "View Details",
                        formatter: (function (cell) {
                            return gridjs.html('<button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target=".orderdetailsModal">' + cell + '</button>');
                        })
                    },
                    {
                        name: "Action",
                        sort: {
                            enabled: false
                        },
                        formatter: (function (cell) {
                            return gridjs.html('<div class="d-flex gap-3"><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a></div>');
                        })
                    }
                ],
            pagination: {
                limit: 8
            },
            sort: true,
            search: true,
            data: [
                ["", "#SK2540", "Neal Matthews", "07 Oct, 2021", "$400", "Paid", "Mastercard", "View Details"],
                ["", "#SK5623", "Jamal Burnett", "05 Oct, 2021", "$452", "Chargeback", "Visa", "View Details"],
                ["", "#SK6263", "Juan Mitchell", "06 Oct, 2021", "$632", "Refund", "Paypal", "View Details"],
                ["", "#SK4521", "Barry Dick", "07 Oct, 2021", "$521", "Refund", "COD", "View Details"],
                ["", "#SK5263", "Ronald Taylor", "07 Oct, 2021", "$521", "Paid", "Mastercard", "View Details"],
                ["", "#SK4526", "Jacob Hunter", "06 Oct, 2021", "$365", "Chargeback", "Visa", "View Details"],
                ["", "#SK8965", "William Cruz", "07 Oct, 2021", "$452", "Paid", "Paypal", "View Details"],
                ["", "#SK9658", "Dustin Moser", "08 Oct, 2021", "$365", "Paid", "COD", "View Details"],
                ["", "#SK7458", "Clark Benson", "09 Oct, 2021", "$254", "Refund", "COD", "View Details"],
                ["", "#SK2685", "John Fane", "07 Oct, 2021", "$400", "Paid", "Mastercard", "View Details"],
                ["", "#SK4526", "Stacie Parker", "05 Oct, 2021", "$452", "Chargeback", "Visa", "View Details"],
                ["", "#SK8522", "Betty Wilson", "06 Oct, 2021", "$632", "Refund", "Paypal", "View Details"],
                ["", "#SK4545", "Roman Crabtree", "07 Oct, 2021", "$521", "Refund", "COD", "View Details"],
                ["", "#SK9652", "Marisela Butler", "07 Oct, 2021", "$521", "Paid", "Mastercard", "View Details"],
                ["", "#SK4256", "Roger Slayton", "06 Oct, 2021", "$365", "Chargeback", "Visa", "View Details"],
                ["", "#SK4125", "Barbara Torres", "07 Oct, 2021", "$452", "Paid", "Paypal", "View Details"],
                ["", "#SK6523", "Daniel Rigney", "08 Oct, 2021", "$365", "Paid", "COD", "View Details"],
                ["", "#SK6563", "Kenneth Linck", "09 Oct, 2021", "$254", "Refund", "COD", "View Details"],

            ]
        }).render(document.getElementById("table-ecommerce-orders"));



        flatpickr('#order-date', {
            defaultDate: new Date(),
            dateFormat: "d M, Y",
        });

    </script> --}}
@endsection
