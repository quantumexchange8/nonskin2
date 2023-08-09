<div class="card-body ">
    <div class="p-3 bg-light mb-4">
        <h5 class="font-size-16 mb-0">Order Summary
            {{-- <span class="float-end ms-2">#MN0124</span> --}}
        </h5>
    </div>
    <div class="table-responsive" id="checkout-tables">
        <table class="table table-centered mb-0 table-nowrap" id="shippingTable">
            <thead>
                <tr>
                    <th class="border-top-0" style="width: 100px;" scope="col">Product</th>
                    <th class="border-top-0" scope="col">Product Name</th>
                    <th class="border-top-0" scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $k => $v )
                <tr>
                    <th scope="row"><img src="{{ asset('images/products/' . $v->product->image_1) }}"
                            alt="product-img" title="product-img" class="avatar-md"></th>
                    <td>
                        <h5 class="font-size-14 text-truncate"><a href="#"
                                class="text-dark">{{ $v->product->name_en }}</a></h5>
                        @if($v->product->discount == 0)
                            <p class="text-muted mb-0">RM {{ number_format($v->price,2,'.',',') }} x {{ $v->quantity,2 }}</p>
                        @else
                        <p class="text-muted mb-0">RM {{ number_format($v->price,2,'.',',') }} x {{ $v->quantity,2 }}</p>
                        <p class="font-size-12">({{ $v->product->discount }}% off)</p>
                        @endif
                    </td>
                    @if($v->product->discount > 0)
                        <td>RM {{ number_format($v->price * $v->quantity,2,'.',',') }}</td>
                    @else
                        <td>RM {{ number_format($v->price * $v->quantity,2,'.',',') }}</td>
                    @endif

                </tr>
                @endforeach
                @php 
                 $totalAmount = 0; // Initialize the total amount variable

                 foreach ($cartItems as $k => $v) {
                    // Calculate the total price for each item
                    $itemTotal = $v->product->price * $v->quantity;
                    $totalAmount += $itemTotal; // Add to the total amount
                }

                @endphp
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total Amount :</h5>
                    </td>
                    <td> RM {{ number_format(($totalAmount) ,2,'.',',') }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total Discount :</h5>
                    </td>
                    <td>- RM {{ number_format($totalDiscount,2,'.',',') }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total Shipping Charge :</h5>
                    </td>
                    <td id="shipping">RM 0.00</td>
                    <input type="hidden" name="delivery_fee" id="delivery-fee-input">
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Merchandise Sub Total :</h5>
                    </td>
                    <td>RM {{ number_format($subtotal,2,'.',',') }}</td>
                </tr>

                <tr class="bg-light" >
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total Payment:</h5>
                    </td>
                    <td id="total" class="fw-bold">RM {{ number_format($subtotal + $user->address[0]->shippingCharge->amount, 2, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-centered mb-0 table-nowrap" id="selfpickupTable" style="display: none;">
            <thead>
                <tr>
                    <th class="border-top-0" style="width: 100px;" scope="col">Product</th>
                    <th class="border-top-0" scope="col">Product Name</th>
                    <th class="border-top-0" scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $k => $v )
                <tr>
                    <th scope="row"><img src="{{ asset('images/products/' . $v->product->image_1) }}"
                            alt="product-img" title="product-img" class="avatar-md"></th>
                    <td>
                        <h5 class="font-size-14 text-truncate"><a href="#"
                                class="text-dark">{{ $v->product->name_en }}</a></h5>
                        @if($v->product->discount == 0)
                            <p class="text-muted mb-0">RM {{ number_format($v->price,2,'.',',') }} x {{ $v->quantity,2 }}</p>
                        @else
                        <p class="text-muted mb-0">RM {{ number_format($v->price,2,'.',',') }} x {{ $v->quantity,2 }}</p>
                        <p class="font-size-12">({{ $v->product->discount }}% off)</p>
                        @endif
                    </td>
                    @if($v->product->discount > 0)
                        <td>RM {{ number_format($v->price*$v->quantity,2,'.',',') }}</td>
                    @else
                        <td>RM {{ number_format($v->price*$v->quantity,2,'.',',') }}</td>
                    @endif

                </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Merchandise Sub Total :</h5>
                    </td>
                    <td>RM {{ number_format($subtotal,2,'.',',') }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total Discount :</h5>
                    </td>
                    <td>- RM {{ number_format($totalDiscount,2,'.',',') }}</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total Shipping Charge :</h5>
                    </td>
                    <td id="shipping">RM 0.00</td>
                    <input type="hidden" name="delivery_fee" id="selfpickup-fee-input">
                </tr>

                <tr class="bg-light" >
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total Payment:</h5>
                    </td>
                    <td id="total" class="fw-bold">RM {{ number_format($subtotal, 2, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="row my-4">
        <div class="col">
            <a href="{{ route('product-list') }}" class="btn btn-link text-muted">
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