<div class="card-body ">
    <div class="p-3 bg-light mb-4">
        <h5 class="font-size-16 mb-0">Order Summary
            {{-- <span class="float-end ms-2">#MN0124</span> --}}
        </h5>
    </div>
    <div class="table-responsive">
        <table class="table table-centered mb-0 table-nowrap">
            <thead>
                <tr>
                    <th class="border-top-0" style="width: 100px;" scope="col">Product</th>
                    <th class="border-top-0" scope="col">Product Name</th>
                    <th class="border-top-0" scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $k => $v )
                @php
                    // dd($user->address[0]->shippingCharge->amount);
                @endphp
                <tr>
                    <th scope="row"><img src="{{ asset('images/' . $v->product->image_1) }}"
                            alt="product-img" title="product-img" class="avatar-md"></th>
                    <td>
                        <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail"
                                class="text-dark">{{ $v->product->name_en }}</a></h5>
                        <p class="text-muted mb-0">RM {{ number_format($v->price,2,'.',',') }} x {{ number_format($v->quantity,2,'.',',') }}</p>
                    </td>
                    <td>RM {{ number_format($v->price*$v->quantity,2,'.',',') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Sub Total :</h5>
                    </td>
                    <td>RM {{ number_format($v->cart->total_price,2,'.',',') }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Discount :</h5>
                    </td>
                    <td>- RM 0.00</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Shipping Charge :</h5>
                    </td>
                    {{-- <td>RM {{ number_format($user->address->shippingCharge->amount,2,'.',',') }}</td> --}}
                </tr>

                <tr class="bg-light" >
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total:</h5>
                    </td>
                    {{-- <td class="fw-bold">RM {{ number_format($v->cart->total_price + $user->address->shippingCharge->amount,2,'.',',') }}</td> --}}
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row my-4">
        <div class="col">
            <a href="{{ route('member.product-list') }}" class="btn btn-link text-muted">
                <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
        </div> <!-- end col -->
        <div class="col">
            <div class="text-end mt-2 mt-sm-0">
                <a href="#" class="btn btn-success" id="place-order-btn">
                    <i class="mdi mdi-cart-outline me-1"></i> Place Order </a>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row-->
</div>
