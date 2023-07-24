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

            <div class="row">
                <div class="col-xl-8">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @If(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-block-helper me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @foreach ($cartItems as $k => $v)
                        <div class="card border shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="{{ asset('images/' . $v->product->image_1) }}" alt="" class="avatar-md">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-16"><a href="{{ route('member.product-detail', $v->product->id) }}" class="text-dark">{{ $v->product->name_en }}</a></h5>
                                            {{-- <p class="mb-1">Color : <span class="fw-medium">Gray</span></p>
                                            <p>Size : <span class="fw-medium">08</span></p> --}}
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <ul class="list-inline mb-0 font-size-16">
                                                <!-- Delete button -->
                                            <li class="list-inline-item">
                                                <button class="btn text-muted px-1 font-size-20" data-bs-toggle="modal" data-bs-target=".cart-remove-item">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                                @include('member.modals.cart-remove-item')
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
                                                <p class="text-muted mb-2">Price</p>
                                                <h5 class="font-size-16 price" data-product-id="{{ $v->product->id }}">RM {{ number_format($v->product->price,2,'.',',') }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Quantity</p>
                                                <div class="d-inline-flex">
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-light btn-sm minus-btn" data-product-id="{{ $v->product->id }}" data-product-price="{{ $v->product->price }}">
                                                            <i class="bx bx-minus"></i>
                                                        </button>
                                                        <input type="text" class="form-control quantity-input" name="quantity" value="{{ $v->quantity }}" data-product-id="{{ $v->product->id }}" data-product-price="{{ $v->product->price }}">
                                                        <button type="button" class="btn btn-light btn-sm plus-btn" data-product-id="{{ $v->product->id }}" data-product-price="{{ $v->product->price }}">
                                                            <i class="bx bx-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Total</p>
                                                <h5 class="font-size-16 total" data-product-id="{{ $v->product->id }}">RM {{ number_format($v->product->price*$v->quantity,2,'.',',') }}</h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end card -->
                </div>

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
                                            <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end sub-total">RM {{ number_format($cart->total_price,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Discount : </td>
                                                <td class="text-end">- RM 0</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>Total :</th>
                                                <td class="text-end total">
                                                    <span class="fw-bold">
                                                        RM {{ number_format($cart->total_price,2,'.',',') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                                <div class="row my-4">
                                    <div class="col-sm-6">
                                        <a href="{{ route('member.product-list') }}" class="btn btn-link text-muted">
                                            <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="text-sm-end mt-2 mt-sm-0">
                                            <a href="{{ route('member.checkout') }}" class="btn btn-success {{ $cartItems->count() == 0 ? 'disabled' : '' }}">
                                                <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
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

            // Handle keyup event on quantity input
            $('.quantity-input').keyup((event) => {
                let quantityInput = $(this);
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let currentValue = Number(quantityInput.val());

                // Clear the previous timer
                clearTimeout(typingTimer);

                // Set a new timer to trigger update after the specified delay
                typingTimer = setTimeout(() => {
                    if (currentValue >= 1) { // Ensure quantity is valid
                        updateCartItem(productId, currentValue, productPrice);
                    } else {
                        // You may show an error message here if needed
                    }
                }, doneTypingInterval);
            });

            // Handle minus button click
            $('.minus-btn').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let currentValue = Number(quantityInput.val());

                if (currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                    updateCartItem(productId, currentValue - 1, productPrice);
                }
                getCartData();
            });

            // Handle plus button click
            $('.plus-btn').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let productId = quantityInput.data('product-id');
                let productPrice = quantityInput.data('product-price');
                let currentValue = Number(quantityInput.val());

                quantityInput.val(currentValue + 1);
                updateCartItem(productId, currentValue + 1, productPrice);
                getCartData();
            });

            function getCartData() {
                $.ajax({
                    url: '{{ route("cart.get") }}',
                    method: 'GET',
                    success: function(response) {
                    // Handle the successful response and update the cart view accordingly
                    if (response.cart) {
                        // Update the Sub Total and Total in the cart view
                        $('.sub-total').text('RM ' + response.total_price.toFixed(2));
                        $('.total').text('RM ' + response.total_price.toFixed(2));

                        // Update the quantity and total price for each cart item in the view
                        $.each(response.cartItems, function(index, item) {
                            var row = $('.cart-item-row[data-product-id="' + item.product_id + '"]');
                            row.find('.quantity-input').val(item.quantity);
                            row.find('.total-price').text('RM ' + item.total_price.toFixed(2));

                            // Update the price and total for each item in the cart view
                            $('.price[data-product-id="' + item.product_id + '"]').text('RM ' + item.product.price.toFixed(2));
                            $('.total[data-product-id="' + item.product_id + '"]').text('RM ' + item.total_price.toFixed(2));
                        });
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

            // Function to update cart item and cart via AJAX
            function updateCartItem(productId, quantity, productPrice) {
                $.ajax({
                    url: '{{ route("cart.update") }}',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        price: productPrice
                    },
                    success: function(response) {
                        // Perform any actions after successful update, if needed
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.log('Error updating cart item:', error);
                    }
                });
            }
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
