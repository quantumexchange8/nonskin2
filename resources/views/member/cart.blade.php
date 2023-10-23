@extends('layouts.master')
@section('title') @lang('translation.Cart') @endsection

    @section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Cart @endslot
    @endcomponent

    @if(session('message'))
    <input data-bs-toggle="modal" data-bs-target="#staticBackdrop" hidden>
    @include('member.modals.message-modal')
    @endif

    @include('includes.alerts')

            <div class="row">
                @if($cartItems->isEmpty())
                    <div class="col-xl-12 pt-4 pb-4 d-flex flex-column">
                        <p class="pt-4 pb-2 d-flex justify-content-center align-items-center">This shopping cart is empty</p>
                        <a href="{{ route('product-list') }}" class="btn btn-md btn-primary d-flex justify-content-center align-items-center align-self-center">CONTINUE SHOPPING</a>
                    </div>
                @endif
                <div class="col-xl-8">
                    @php
                        $userCart = App\Models\CartItem::where('cart_id', Auth::user()->cart->id)->get();
                    @endphp
                    @forelse ($userCart as $row)
                        <div class="card border shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="{{ asset('images/products/' . $row->product->image_1) }}" alt="" class="avatar-md">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-16"><a href="{{ route('showdetails', $row->product->id) }}" class="text-dark">{{ $row->product->name }}</a></h5>
                                            @if ($row->product->discount > 0)
                                            <p class="mb-1">{{ $row->product->discount }}% off</p>
                                            @endif

                                            {{-- <p>Size : <span class="fw-medium">08</span></p> --}}
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <ul class="list-inline mb-0 font-size-16">
                                                <!-- Delete button -->
                                            <li class="list-inline-item">
                                                <button class="btn text-muted px-1 font-size-20 delete-button" data-bs-toggle="modal" data-bs-target="#cart-remove-modal-{{ $row->cart->id }}-{{ $row->product_id }}" data-cart-id="{{ $row->cart->id }}" data-product_id="{{ $row->product_id }}">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                                {{-- {{ $row->cart->id }} --}}
                                                {{-- @include('member.modals.cart-remove-item') --}}
                                                <div class="card-body">
                                                    <div>
                                                        <!-- center modal -->
                                                        <div class="modal fade cart-remove-item" id="cart-remove-modal-{{ $row->cart->id }}-{{ $row->product_id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Remove item from cart?</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure you want to remove this item from cart?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('cart.item.destroy', ['cart' => $row->cart->id, 'productId' => $row->product->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-primary remove-button">Save changes</button>
                                                                        </form>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                    </div>
                                                </div><!-- end card body -->
                                                
                                            </li>
                                            <!-- Like button -->
                                            {{-- <li class="list-inline-item">
                                                <a href="#" class="text-muted px-1">
                                                    <i class="mdi mdi-heart-outline"></i>
                                                </a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Unit Price {{number_format($row->product->price, 2)}}</p>
                                                <h5 class="font-size-16">RM {{ number_format(($row->product->price*(100-$row->product->discount)/100),2,'.') }}</h5>
                                                @if ($row->product->discount > 0)
                                                <del class="text-muted">RM {{ number_format($row->product->price,2,'.',',') }}</del>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Quantity</p>
                                                <div class="d-inline-flex">
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-light btn-sm minus-btn" data-product-id="{{ $row->product->id }}" data-product-price="{{ $row->product->price }}" data-discount-price="{{ $row->discount_price }}">
                                                            <i class="bx bx-minus"></i>
                                                        </button>
                                                        <input type="text" class="form-control quantity-input" name="quantity" value="{{ $row->quantity }}" data-product-id="{{ $row->product->id }}" data-product-price="{{ $row->product->price }}" data-discount-price="{{ $row->discount_price }}">
                                                        <button type="button" class="btn btn-light btn-sm plus-btn" data-product-id="{{ $row->product->id }}" data-product-price="{{ $row->product->price }}" data-discount-price="{{ $row->discount_price }}">
                                                            <i class="bx bx-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Total</p>
                                                @if($discountAmt > 0 )
                                                    <del>
                                                        <h5 class="font-size-16 total1" data-product-id="{{ $row->product->id }}">
                                                            <span class="fw-bold nodis">
                                                                RM {{ number_format(($row->product->price * (100-$row->product->discount)/100) * $row->quantity,2,'.') }}
                                                            </span>
                                                        </h5>
                                                    </del> 
                                                    <h6>{{ $discountAmt }}% Off</h6>
                                                    <h5 class="font-size-16 total1" data-product-id="{{ $row->product->id }}"><span class="fw-bold dis">
                                                        RM {{ number_format((($row->product->price - $row->discount_price) * $row->quantity), 2, '.') }}
                                                    </span>
                                                    {{-- <span id="discountedprice" class="fw-bold" data-product-id="{{ $row->product->id }}">
                                                        RM 0.00
                                                    </span> --}}
                                                    @if ($row->product->discount > 0)
                                                    <del class="text-muted product-discount" data-product-id="{{ $row->product->id }}">RM {{ number_format($row->product->price * $row->quantity,2,'.',',') }}</del>
                                                    @endif
                                                @else
                                                    <h5 class="font-size-16 total1" data-product-id="{{ $row->product->id }}"><span class="fw-bold nodis">
                                                        RM {{ number_format(($row->product->price * (100-$row->product->discount)/100) * $row->quantity,2,'.') }}
                                                    </span>
                                                @endif
                                                
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                    @endforelse
                    <!-- end card -->
                </div>

                @if(!$cartItems->isEmpty())
                <div class="col-xl-4">
                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none">
                            <div class="card-header bg-transparent border-bottom py-3 px-4">
                                <h5 class="font-size-16 mb-0">Order Summary <!-- <span class="float-end">#MN0124</span> --></h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            {{-- <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end sub-total">RM 0.00</td>
                                            </tr> --}}
                                            <tr>
                                                <td>Total Discount: </td>
                                                <td class="text-end">
                                                    {{-- {{ number_format($disAmt, 2) }} --}}
                                                    <span id="total2" class="fw-bold">
                                                        RM 0.00
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>Total Merchandise:</th>
                                                <td class="text-end total">
                                                    <span id="total" class="fw-bold">
                                                        RM 0.00
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                                <div class="row my-4">
                                    <div class="col-sm-6">
                                        <a href="{{ route('product-list') }}" class="btn btn-link text-muted">
                                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-sm-end mt-2 mt-sm-0">
                                            <a href="{{ route('member.checkout') }}" class="btn btn-success {{ $cartItems->count() == 0 ? 'disabled' : '' }}">
                                                <i class="mdi mdi-cart-outline me-1 checkout"></i> Checkout </a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(() => {
            getCartData();
            // Set the CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let typingTimer; // Timer identifier
            let doneTypingInterval = 200; // Delay time in milliseconds

            function updateTotalAmount() {
                let totalAmount = 0;
                let totalDis = 0;

                $('.quantity-input').each(function() {
                    let quantityInput = $(this);
                    let productPrice = quantityInput.data('product-price');
                    let discountPrice = quantityInput.data('discount-price');
                    let currentValue = Number(quantityInput.val());

                    if (!isNaN(currentValue)) {
                        totalAmount += currentValue * productPrice;
                        totalDis += currentValue * discountPrice;
                    }
                });

                // Format and update the total amount
                let formattedTotalAmount = 'RM ' + totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2 });
                let formattedTotalAmount1 = 'RM ' + totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2 });
                let formattedTotalAmount2 = 'RM ' + totalDis.toLocaleString(undefined, { minimumFractionDigits: 2 });
                $('#total').text(formattedTotalAmount);
                $('#total1').text(formattedTotalAmount1);
                $('#total2').text(formattedTotalAmount2);
            }

            // Handle keyup event on quantity input
            $('.quantity-input').keyup(function() {
                let quantityInput = $(this);
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let currentValue = Number(quantityInput.val());

                if (isNaN(currentValue) || currentValue <= 0) {
                    // Display a SweetAlert error message for invalid input
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Input',
                        text: 'Please enter a valid quantity greater than 0.',
                    });

                    // Reset the input value to 1
                    quantityInput.val(1);
                    currentValue = 1;
                }

                // Update the product price based on the input value
                let totalProductPrice = currentValue * productPrice;
                let formattedTotalProductPrice = 'RM ' + totalProductPrice.toLocaleString(undefined, { minimumFractionDigits: 2 });
                quantityInput.siblings('.total-product-price').text(formattedTotalProductPrice);

                // Update the total amount
                updateTotalAmount();

                // Clear the previous timer
                clearTimeout(typingTimer);

                // Set a new timer to trigger update after the specified delay
                typingTimer = setTimeout(() => {
                    if (currentValue >= 1) {
                        updateCartItem(productId, currentValue, productPrice);
                    } else {
                        // You may show an error message here if needed
                    }
                }, doneTypingInterval);
            });
            updateTotalAmount();


            // Handle minus button click
            $('.minus-btn').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let currentValue = Number(quantityInput.val());

                quantityInput.val(currentValue - 1);
                quantityInput.trigger('keyup'); // Trigger a keyup event to update the UI and cart item

                // Calculate and update the total amount
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let discountPrice = quantityInput.data('discount-price');
                let newQuantity = Number(quantityInput.val());
                let newTotalAmount = newQuantity * productPrice;
                let newDiscountAmount = newQuantity * discountPrice;
                let FinalAmount = newTotalAmount - newDiscountAmount;

                // Find the specific <span> element and update its content
                let totalAmountElement = $(`[data-product-id="${productId}"] .nodis`);
                let totalDisAmountElement = $(`[data-product-id="${productId}"] .dis`);

                totalAmountElement.text('RM ' + newTotalAmount.toFixed(2));
                totalDisAmountElement.text('RM ' + FinalAmount.toFixed(2));

                // You may also want to update the server-side data via AJAX if needed
                updateCartItem(productId, newQuantity, productPrice);
            });

            // Handle plus button click
            $('.plus-btn').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let currentValue = Number(quantityInput.val());

                quantityInput.val(currentValue + 1);
                quantityInput.trigger('keyup'); // Trigger a keyup event to update the UI and cart item

                // Calculate and update the total amount
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let discountPrice = quantityInput.data('discount-price');
                let newQuantity = Number(quantityInput.val());
                let newTotalAmount = newQuantity * productPrice;
                let newDiscountAmount = newQuantity * discountPrice;
                let FinalAmount = newTotalAmount - newDiscountAmount;

                // Find the specific <span> element and update its content
                let totalAmountElement = $(`[data-product-id="${productId}"] .nodis`);
                let totalDisAmountElement = $(`[data-product-id="${productId}"] .dis`);

                totalAmountElement.text('RM ' + newTotalAmount.toFixed(2));
                totalDisAmountElement.text('RM ' + FinalAmount.toFixed(2));

                // You may also want to update the server-side data via AJAX if needed
                updateCartItem(productId, newQuantity, productPrice);
            });


             // Function to update cart item and cart via AJAX
             function updateCartItem(productId, quantity, productPrice) {

                // var totalprice = 
                console.log(productPrice)
                $.ajax({
                    url: '{{ route("ajax.cart.update") }}',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        price: productPrice
                    },
                    success: function(response) {
                        // Perform any actions after successful update, if needed
                        getCartData();
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.log('Error updating cart item:', error);
                    }
                });
            }

            $('.checkout').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let currentValue = Number(quantityInput.val());
                updateCartItem(productId, currentValue, productPrice);
            })

            function getCartData() {
                $.ajax({
                    url: '{{ url("member/cart/get") }}',
                    method: 'GET',
                    success: function(response) {
                        if (response.cart) {
                            // Update the Sub Total and Total in the cart view
                            console.log(response.total_price_with_discount)
                            $('.sub-total').text('RM ' + response.total_price_without_discount.toLocaleString(undefined, { minimumFractionDigits: 2 }));
                            $('#total').text('RM ' + response.total_price_with_discount.toLocaleString(undefined, { minimumFractionDigits: 2 }));
                        } else {
                            // Handle the case when the cart data is not found
                            console.log('Cart not found');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.log('Error fetching cart data:', error);
                    }
                });
            }

            // Initial update of total amount
            updateTotalAmount();

            $('.checkout').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let currentValue = Number(quantityInput.val());

                // Send an AJAX request to handle the checkout process
                $.ajax({
                    url: '{{ route("ajax.cart.update") }}',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: currentValue,
                        price: productPrice
                    },
                    success: function(response) {
                        // Handle success
                    },
                    error: function(xhr, status, error) {
                        // You can also show an error message to the user if needed
                        alert('Error during checkout. Please try again.');
                    }
                });
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            if ({{ json_encode(session('from_modal', false)) }}) {
                $('#checkCartItem').modal('show');
            }
        });
    </script>

@endsection