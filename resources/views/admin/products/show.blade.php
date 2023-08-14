@extends('layouts.master')
@section('title') {{ $product->name }} @endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}">
@endsection

@section('content')
@component('components.breadcrumb')
@slot('url') {{ route('list') }} @endslot
@slot('li_1') Products @endslot
@slot('title') {{ $product->name }} @endslot
@endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="product-detail" dir="ltr">
                                {{-- <div class="product-wishlist">
                                    <a href="#">
                                        <i class="mdi mdi-heart-outline"></i>
                                    </a>
                                </div> --}}
                                <div class="swiper product-thumbnail-slider rounded border overflow-hidden position-relative">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"><img src="{{ asset('images/products/' . $product->image_1) }}" alt="{{ $product->name }}" class="img-fluid d-block" /></div>
                                        <div class="swiper-slide"><img src="{{ asset('images/products/' . $product->image_2) }}" alt="{{ $product->name }}" class="img-fluid d-block" /></div>
                                        <div class="swiper-slide"><img src="{{ asset('images/products/' . $product->image_3) }}" alt="{{ $product->name }}" class="img-fluid d-block" /></div>
                                        <div class="swiper-slide"><img src="{{ asset('images/products/' . $product->image_4) }}" alt="{{ $product->name_en }}" class="img-fluid d-block" /></div>
                                        <div class="swiper-slide"><img src="{{ asset('assets/images/product/img-5.png') }}" alt="{{ $product->name_en }}" class="img-fluid d-block" /></div>
                                    </div>

                                    <div class="d-none d-md-block">
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="mt-4 mt-xl-3 ps-xl-4">
                                <h4 class="font-size-20 mb-3">{{ $product->name_en }}</h4>
                                @if ($product->discount != 0)
                                    <h5 class="mt-4 pt-2"><del class="text-muted me-2 font-size-14">RM{{ number_format($product->price,2,".",",") }}</del>RM{{ number_format($product->price - ($product->price * $product->discount/100),2,".",",") }} <span class="text-danger font-size-14 ms-2">- {{ $product->discount }} % Off</span></h5>
                                @else
                                <h5 class="mt-4 pt-2">RM{{ number_format($product->price,2,".",",") }}</h5>
                                @endif
                                <div class="row">
                                    <div class="col-2">
                                        <p class="mt-4 text-muted">Shipping Quantity</p>
                                    </div>
                                    <div class="col-10">
                                        <p class="mt-4 font-bold">{{ $product->shipping_quantity }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <p class="mt-4 text-muted">Category</p>
                                    </div>
                                    <div class="col-10">
                                        <p class="mt-4 font-bold">{{ $product->category->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <p class="mt-4 text-muted">Description</p>
                                    </div>
                                    <div class="col-10">
                                        <p class="mt-4 font-bold">{{ $product->description ?? 'Product description unavailable' }}</p>
                                    </div>
                                </div>

                                <div class="row text-center mt-3">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="d-grid">

                                                <a href="{{ route('edit', $product->id) }}" class="btn btn-primary btn"><i class='bx bxs-edit'></i> Edit Product</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>

    <div id="color-img" class="modal fade" tabindex="-1" aria-labelledby="color-imgLabel" aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="color-imgLabel">Product Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="product-desc-color">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="#" class="active" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Gray">
                                    <div class="product-color-item">
                                        <img src="{{ URL::asset('assets/images/product/img-1.png') }}" alt="" class="avatar-md">
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dark">
                                    <div class="product-color-item">
                                        <img src="{{ URL::asset('assets/images/product/img-2.png') }}" alt="" class="avatar-md">
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Purple">
                                    <div class="product-color-item">
                                        <img src="{{ URL::asset('assets/images/product/img-3.png') }}" alt="" class="avatar-md">
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Sky">
                                    <div class="product-color-item">
                                        <img src="{{ URL::asset('assets/images/product/img-4.png') }}" alt="" class="avatar-md">
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Green">
                                    <div class="product-color-item">
                                        <img src="{{ URL::asset('assets/images/product/img-5.png') }}" alt="" class="avatar-md">
                                    </div>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="White">
                                    <div class="product-color-item">
                                        <img src="{{ URL::asset('assets/images/product/img-6.png') }}" alt="" class="avatar-md">
                                    </div>
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Get the input field and buttons
            var quantityInput = $('#quantity');
            var minusButton = $('.minus-btn');
            var plusButton = $('.plus-btn');

            // Decrement the value when minus button is clicked
            minusButton.click(function() {
                var currentValue = parseInt(quantityInput.val());
                if (currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                }
            });

            // Increment the value when plus button is clicked
            plusButton.click(function() {
                var currentValue = parseInt(quantityInput.val());
                quantityInput.val(currentValue + 1);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Set the CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.add-to-cart-btn').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the product ID from the data attribute
                var productId = $(this).data('product-id');
                var productPrice = $(this).data('product-price');
                var quantity = $('#quantity').val();
                console.log("Product ID:", productId);
                console.log("Quantity:", quantity);

                // Send an AJAX request to add the product to the cart
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: {
                        product_id: productId,
                        price: productPrice,
                        quantity: quantity
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    }
                });
            });
        });
    </script>
@endsection
