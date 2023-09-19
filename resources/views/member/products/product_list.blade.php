@extends('layouts.master')
@section('title')
    Product List
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/nouislider/nouislider.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('url') {{ route('user-dashboard') }} @endslot
        @slot('title') Product List @endslot
    @endcomponent

    @include('includes.alerts')

    <div class="row">

        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-inline float-md-end">
                                    <div class="search-box ms-2">
                                        <div class="position-relative">
                                            {{-- <input type="text" class="form-control bg-light border-light rounded"
                                                placeholder="Search...">
                                            <i class="bx bx-search search-icon"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="popularity" role="tabpanel">
                                <div class="row">
                                    @if (isset($products))
                                        @foreach ($products as $product)
                                            <div class="col-xl-2 col-sm-6 mb-4">
                                                <div class="product-box h-100 d-flex flex-column">
                                                    @if ($product->discount != 0)
                                                        <div class="product-ribbon">
                                                            - {{ $product->discount }} %
                                                        </div>
                                                    @endif
                                                    <div class="product-img pt-4 px-4">
                                                        <a href="{{ route('showdetails', $product->id) }}">
                                                            <img src="{{ $product->image_1 !== null ? asset('images/products/' . $product->image_1) : asset('assets/images/nonskin/non-logo.jpg') }}"
                                                                alt="{{ $product->name }}" class="img-fluid mx-auto d-block" style="width: 70% !important;">
                                                        </a>
                                                    </div>
                                                    <div class="product-content p-4 mt-auto">
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <div>
                                                                <h5 class="mb-1">
                                                                    <a href="{{ route('showdetails', $product->id) }}" class="font-size-14">{{ Str::limit($product->name, 21, '...') }}</a>
                                                                </h5>
                                                                {{-- <p class="text-muted font-size-13">{{ $product->desc_en }}</p> --}}
                                                                <h5 class="mt-3 mb-0 font-size-16">
                                                                    @if ($product->discount != 0)
                                                                        <span class="text-muted me-2 font-size-12">
                                                                            <del>RM{{ number_format($product->price, 2, '.', ',') }}</del>
                                                                        </span>
                                                                        RM{{ number_format($product->price - ($product->price * $product->discount) / 100, 2, '.', ',') }}
                                                                    @else
                                                                        RM{{ number_format($product->price, 2, '.', ',') }}
                                                                    @endif
                                                                </h5>
                                                            </div>
                                                            <div>

                                                            </div>
                                                        </div>
                                                        <form action="{{ route('cart.add') }}" method="POST">
                                                            @csrf
                                                            <div class="row pt-4">
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <input type="hidden" name="price" value="{{ $product->selling_price }}">
                                                                <input type="hidden" name="quantity" value="1">
                                                                @if (Auth::user()->role == 'user')
                                                                    <div class="d-inline-flex">
                                                                        <div class="input-group">
                                                                            <button type="button" class="btn btn-light btn-sm minus-btn" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}">
                                                                                <i class="bx bx-minus"></i>
                                                                            </button>
                                                                            <input type="text" class="form-control quantity-input" name="quantity" value="1" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}">
                                                                            <button type="button" class="btn btn-light btn-sm plus-btn" data-product-id="{{ $product->id }}" data-product-price="{{ $product->price }}">
                                                                                <i class="bx bx-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-primary btn"><i class='bx bx-cart-alt'></i> Add to Cart</button>
                                                                @else
                                                                    <a href="{{ route('edit', $product->id) }}" class="btn btn-primary btn"><i class='bx bxs-edit'></i> Edit Product</a>
                                                                @endif
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Set the CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.minus-btn').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let currentValue = Number(quantityInput.val());

                if (currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                }

                // Trigger a keyup event to update the UI and cart item
                quantityInput.trigger('keyup');
            });

            // Handle plus button click
            $('.plus-btn').click(function() {
                let quantityInput = $(this).siblings('.quantity-input');
                let currentValue = Number(quantityInput.val());

                quantityInput.val(currentValue + 1);

                // Trigger a keyup event to update the UI and cart item
                quantityInput.trigger('keyup');
            });

            $('.add-to-cart-btn').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the product ID from the data attribute
                const productId = $(this).data('product-id');
                const productPrice = $(this).data('product-price');

                const quantity = $(this).siblings('.quantity-input');
                const qty = Number(quantityInput.val());
                

                // Send an AJAX request to add the product to the cart
                $.ajax({
                    url: 'products/cart/add',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        price: productPrice,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Show SweetAlert2 success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Product added to cart successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add product to cart.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>
@endsection
