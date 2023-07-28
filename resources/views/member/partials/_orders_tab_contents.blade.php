<div class="tab-pane active" id="all" role="tabpanel">
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
                        // dd($v->product_id)
                    @endphp
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ asset('images/' . $v->product->image_1) }}"
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
<div class="tab-pane" id="toPay" role="tabpanel">
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
                                        <img src="{{ asset('images/' . $v->product->image_1) }}"
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
</div>
