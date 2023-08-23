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
                                        @if (isset($product->image_1))
                                        <img src="{{ asset('images/products/' . $product->image_1) }}" alt="Image 1 of Product" class="swiper-slide object-fit-contain" style="height: 650px;" />
                                        @else
                                        <img src="{{ asset('assets/images/nonskin/non-logo.jpg') }}" alt="Image 1 of Product" class="swiper-slide object-fit-contain" style="height: 650px;" />
                                        @endif
                                        @if (isset($product->image_2))
                                        <img src="{{ asset('images/products/' . $product->image_2) }}" alt="Image 2 of Product" class="swiper-slide object-fit-contain" style="height: 650px;" />
                                        @endif
                                        @if (isset($product->image_3))
                                        <img src="{{ asset('images/products/' . $product->image_3) }}" alt="Image 3 of Product" class="swiper-slide object-fit-contain" style="height: 650px;" />
                                        @endif
                                        @if (isset($product->image_4))
                                        <img src="{{ asset('images/products/' . $product->image_4) }}" alt="Image 4 of Product" class="swiper-slide object-fit-contain" style="height: 650px;" />
                                        @endif
                                        @if (isset($product->image_5))
                                        <img src="{{ asset('images/products/' . $product->image_5) }}" alt="Image 5 of Product" class="swiper-slide object-fit-contain" style="height: 650px;" />
                                        @endif
                                    </div>

                                    <div class="d-none d-md-block">
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                                <div class="product-desc-color mt-3">
                                    {{-- <h5 class="font-size-14">Colors :</h5> --}}
                                    <ul class="list-inline text-center">
                                        @if (isset($product->image_1))
                                            <li class="list-inline-item">
                                                <a href="#" class="thumbnail-selector" data-index="1">
                                                    <div class="product-color-item">
                                                        <img src="{{ asset('images/products/' . $product->image_1) }}" alt="" class="avatar-md">
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($product->image_2))
                                            <li class="list-inline-item">
                                                <a href="#" class="thumbnail-selector" data-index="2">
                                                    <div class="product-color-item">
                                                        <img src="{{ asset('images/products/' . $product->image_2) }}" alt="" class="avatar-md">
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($product->image_3))
                                        <li class="list-inline-item">
                                            <a href="#" class="thumbnail-selector" data-index="3">
                                                <div class="product-color-item">
                                                    <img src="{{ asset('images/products/' . $product->image_3) }}" alt="" class="avatar-md">
                                                </div>
                                            </a>
                                        </li>
                                        @endif
                                        @if (isset($product->image_4))
                                            <li class="list-inline-item">
                                                <a href="#" class="thumbnail-selector" data-index="4">
                                                    <div class="product-color-item">
                                                        <img src="{{ asset('images/products/' . $product->image_4) }}" alt="" class="avatar-md">
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                        @if (isset($product->image_5))
                                            <li class="list-inline-item">
                                                <a href="#" class="thumbnail-selector" data-index="5">
                                                    <div class="product-color-item">
                                                        <img src="{{ asset('images/products/' . $product->image_5) }}" alt="" class="avatar-md">
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="mt-4 mt-xl-3 ps-xl-4">
                                <h4 class="font-size-20 mb-3">{{ $product->name }}</h4>
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
                                        <p class="mt-4 font-bold">{{ $product->category->name_en }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <p class="mt-4 text-muted">Description</p>
                                    </div>
                                    <div class="col-10">
                                        <p class="mt-4 font-bold">{!! $product->description ?? 'Product description unavailable' !!}</p>
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
    <script>
        $(document).ready(function() {
            let gallerySwiper = new Swiper('.product-thumbnail-slider', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
            });

            $('.thumbnail-selector').on('click', function(e) {
                e.preventDefault();
                let clickedIndex = $(this).data('index');
                gallerySwiper.slideTo(clickedIndex);

                $('.thumbnail-selector').removeClass('active');
                $(this).addClass('active');
            });

            $('.next-image').on('click', function() {
                gallerySwiper.slideNext();
                updateActiveThumbnail();
            });

            $('.prev-image').on('click', function() {
                gallerySwiper.slidePrev();
                updateActiveThumbnail();
            });

            $('.thumbnail-selector[data-index="0"]').addClass('active');

            function updateActiveThumbnail() {
                let activeSlideIndex = gallerySwiper.realIndex;
                $('.thumbnail-selector').removeClass('active');
                $('.thumbnail-selector[data-index="' + activeSlideIndex + '"]').addClass('active');
            }
        });
    </script>


@endsection
