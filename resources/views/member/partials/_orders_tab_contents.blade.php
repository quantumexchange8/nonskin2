<!-- Tab panes -->
{{-- <div class="tab-content p-3 text-muted">
    @include('member.partials._orders_tab_contents')
</div> --}}
<div class="tab-pane active" id="all" role="tabpanel">
    @forelse ($orders as $order)
    <div class="row">
        <div class="col-12">
            <div class="card-body">
                <table id="allOrder">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Order ID</td>
                            <td>Billing Name</td>
                            <td>Date</td>
                            <td>Total</td>
                            <td>Payment Status</td>
                            <td>Payment Method</td>
                            <td>View Details</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>1</td>
                            <td class="fw-bold">#Order ID</td>
                            <td>Billing Name</td>
                            <td>Date</td>
                            <td>Total</td>
                            <td>Payment Status</td>
                            <td>Payment Method</td>
                            <td>View Details</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="#" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary"><i class="mdi mdi-eye-outline font-size-18"></i></a>
                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
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
    @empty

    @endforelse
    <!-- end row -->
</div>
{{-- <div class="tab-pane" id="toPay" role="tabpanel">
    @forelse ($orders as $order)
        <div class="row">
            <div class="col-xl-12 col-sm-6">
                <div class="card p-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <p class="lead fw-normal mb-0">Order <span class="fw-bold">#{{ $order->order_num }}</span></p>
                        <p class="fw-bold mb-0 gap-2 d-flex align-items-center">
                            <span><span class="text-muted fw-normal">Transaction Number :</span> {{ $order->payment->payment_num }}</span>
                            <span class="btn btn-warning btn-rounded btn-sm" >Payment Pending</span>
                            <span><a href="#">Pay Now</a></span>
                        </p>
                    </div>
                    @foreach ($order->orderItems as $k => $v)
                    @php
                        // dd($order->orderItems)
                    @endphp
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ asset('images/products/' . $v->product->image_1) }}"
                                            class="img-fluid" alt="{{ $v->product->name_en }}" width="80%">
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-left align-items-center">
                                        <p class="fw-bold font-size-14 mb-0"><a href="{{ route('member.product-detail', $v->product_id) }}">{{ $v->product->name_en }}</a></p>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-end align-items-center gap-3">
                                        @if ($v->product->discount > 0)
                                            <del>RM <span class="text-muted">{{ number_format($v->product->price,2,'.',',') }}</span></del>
                                        @endif
                                            <span class="font-size-14 mb-0 small">RM {{ number_format($v->price,2,'.',',') }}</span>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-end align-items-center">
                                        <p class="font-size-14 mb-0 small">Qty: {{ $v->quantity }}</p>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-end align-items-center">
                                        <p class="font-size-14 mb-0 small"><a href="#" class="link">Cancel</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="card shadow-0 border mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="font-size-14">Order <span class="fw-bold">#{{ $order->order_num }}</span></p>
                                    <p class="mb-0">Order placed on <span class="fw-bold">{{ $order->created_at->format('D, d/M/Y, h:m:s') }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="col-md-12 font-size-14">
                                        <p class="fw-bold mb-2">Receiver Details</p>
                                        <p class="mb-0">{{ $order->receiver }}</p>
                                        <p class="mb-0">{{ $order->contact }}</p>
                                        <p class="mb-0">{{ $order->delivery_address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="col-md-12 font-size-14">
                                        <p class="fw-bold mb-2">Summary Details</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0">Subtotal ({{ $order->orderItems->count() }} items)</p>
                                            <p class="mb-0">RM {{ number_format($order->total_amount-$order->delivery_fee,2,'.',',') }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0">Shipping Fee</p>
                                            <p class="mb-0">RM {{ number_format($order->delivery_fee,2,'.',',') }}</p>
                                        </div>
                                        <hr>
                                        <div class="fw-bold d-flex justify-content-between">
                                            <p class="mb-0">Total</p>
                                            <p class="mb-0">RM {{ number_format($order->total_amount,2,'.',',') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty

    @endforelse
    <!-- end row -->
</div>
<div class="tab-pane" id="toShip" role="tabpanel">
    <div class="row">
        <div class="col-xl-4 col-sm-6">
            <div class="product-box">
                <div class="product-ribbon">
                    New
                </div>
                <div class="product-img pt-4 px-4">

                    <div class="product-wishlist">
                        <a href="#">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </div>
                    <img src="{{ URL::asset('assets/images/product/img-3.png') }}" alt=""
                        class="img-fluid mx-auto d-block">
                </div>

                <div class="product-content p-4">
                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <h5 class="mb-1"><a href="ecommerce-product-detail"
                                    class="text-dark font-size-16">Puma P103 Shoes</a></h5>
                            <p class="text-muted font-size-13">Purple, Shoes</p>
                            <h5 class="mt-3 mb-0"><span
                                    class="text-muted me-2"><del>$260</del></span> $250</h5>
                        </div>

                        <div>
                            <ul class="list-inline mb-0 text-muted product-color">
                                <li class="list-inline-item">
                                    Colors :
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-purple"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-light"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-dark"></i>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="product-box">
                <div class="product-ribbon">
                    New
                </div>
                <div class="product-img pt-4 px-4">
                    <div class="product-wishlist">
                        <a href="#">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </div>
                    <img src="{{ URL::asset('assets/images/product/img-4.png') }}" alt=""
                        class="img-fluid mx-auto d-block">
                </div>

                <div class="product-content p-4">

                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <h5 class="mb-1"><a href="ecommerce-product-detail"
                                    class="text-dark font-size-16">Sports S120 Shoes</a></h5>
                            <p class="text-muted font-size-13">Cyan, Shoes</p>
                            <h5 class="mt-3 mb-0"><span
                                    class="text-muted me-2"><del>$240</del></span> $230</h5>
                        </div>

                        <div>
                            <ul class="list-inline mb-0 text-muted product-color">
                                <li class="list-inline-item">
                                    Colors :
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-info"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-success"></i>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="product-box">
                <div class="product-ribbon">
                    New
                </div>
                <div class="product-img pt-4 px-4">
                    <div class="product-wishlist">
                        <a href="#">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </div>
                    <img src="{{ URL::asset('assets/images/product/img-5.png') }}" alt=""
                        class="img-fluid mx-auto d-block">
                </div>

                <div class="product-content p-4">

                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <h5 class="mb-1"><a href="ecommerce-product-detail"
                                    class="text-dark font-size-16">Adidas AB23 Shoes</a></h5>
                            <p class="text-muted font-size-13">Blue, Shoes</p>
                            <h5 class="mt-3 mb-0"><span
                                    class="text-muted me-2"><del>$240</del></span> $250</h5>
                        </div>
                        <div>
                            <ul class="list-inline mb-0 text-muted product-color">
                                <li class="list-inline-item">
                                    Colors :
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-dark"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-light"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-primary"></i>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="product-box">
                <div class="product-ribbon">
                    New
                </div>
                <div class="product-img pt-4 px-4">
                    <div class="product-wishlist">
                        <a href="#">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </div>
                    <img src="{{ URL::asset('assets/images/product/img-2.png') }}" alt=""
                        class="img-fluid mx-auto d-block">
                </div>

                <div class="product-content p-4">

                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <h5 class="mb-1"><a href="ecommerce-product-detail"
                                    class="text-dark font-size-16">Adidas Running Shoes</a>
                            </h5>
                            <p class="text-muted font-size-13">Black, Shoes</p>
                            <h5 class="mt-3 mb-0"><span
                                    class="text-muted me-2"><del>$250</del></span> $240</h5>
                        </div>

                        <div>
                            <ul class="list-inline mb-0 text-muted product-color">
                                <li class="list-inline-item">
                                    Colors :
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-danger"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-dark"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-light"></i>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
</div>
<div class="tab-pane" id="toReceive" role="tabpanel">
    <div class="row">
        <div class="col-xl-4 col-sm-6">
            <div class="product-box">
                <div class="product-ribbon">
                    - 20 %
                </div>
                <div class="product-img pt-4 px-4">
                    <div class="product-wishlist">
                        <a href="#">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </div>
                    <img src="{{ URL::asset('assets/images/product/img-1.png') }}" alt=""
                        class="img-fluid mx-auto d-block">
                </div>

                <div class="product-content p-4">

                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <h5 class="mb-1"><a href="ecommerce-product-detail"
                                    class="text-dark font-size-16">Nike N012 Shoes</a></h5>
                            <p class="text-muted font-size-13">Gray, Shoes</p>
                            <h5 class="mt-3 mb-0"><span
                                    class="text-muted me-2"><del>$280</del></span> $260</h5>
                        </div>

                        <div>
                            <ul class="list-inline mb-0 text-muted product-color">
                                <li class="list-inline-item">
                                    Colors :
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-dark"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-light"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-primary"></i>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="product-box">
                <div class="product-ribbon">
                    - 20 %
                </div>
                <div class="product-img pt-4 px-4">
                    <div class="product-wishlist">
                        <a href="#">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </div>
                    <img src="{{ URL::asset('assets/images/product/img-2.png') }}" alt=""
                        class="img-fluid mx-auto d-block">
                </div>

                <div class="product-content p-4">

                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <h5 class="mb-1"><a href="ecommerce-product-detail"
                                    class="text-dark font-size-16">Adidas Running Shoes</a>
                            </h5>
                            <p class="text-muted font-size-13">Black, Shoes</p>
                            <h5 class="mt-3 mb-0"><span
                                    class="text-muted me-2"><del>$250</del></span> $240</h5>
                        </div>

                        <div>
                            <ul class="list-inline mb-0 text-muted product-color">
                                <li class="list-inline-item">
                                    Colors :
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-danger"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-dark"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-light"></i>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="product-box">
                <div class="product-ribbon">
                    - 20 %
                </div>
                <div class="product-img pt-4 px-4">
                    <div class="product-wishlist">
                        <a href="#">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </div>
                    <img src="{{ URL::asset('assets/images/product/img-6.png') }}" alt=""
                        class="img-fluid mx-auto d-block">
                </div>

                <div class="product-content p-4">
                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <h5 class="mb-1"><a href="ecommerce-product-detail"
                                    class="text-dark font-size-16">Nike N012 Shoes</a></h5>
                            <p class="text-muted font-size-13">Gray, Shoes</p>
                            <h5 class="mt-3 mb-0"><span
                                    class="text-muted me-2"><del>$270</del></span> $260</h5>
                        </div>

                        <div>
                            <ul class="list-inline mb-0 text-muted product-color">
                                <li class="list-inline-item">
                                    Colors :
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-dark"></i>
                                </li>
                                <li class="list-inline-item">
                                    <i class="mdi mdi-circle text-light"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div> --}}
