@extends('layouts.master')
@section('title') @lang('translation.Cart') @endsection

    @section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Cart @endslot
    @endcomponent


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
                    @php
                        // dd($v);
                    @endphp
                        <div class="card border shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="{{ URL::asset('./assets/images/product/img-1.png') }}" alt="" class="avatar-md">
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
                                                <h5 class="font-size-16">RM {{ number_format($v->product->price,2,'.',',') }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Quantity</p>
                                                <div class="d-inline-flex">
                                                    <div class="input-group">
                                                        {{-- <form action="{{ route('updateQty', ['itemId' => $v->id, 'action' => 'minus']) }}" method="POST" class="update-quantity-form"> --}}
                                                            @csrf
                                                            <button type="submit" class="btn btn-light btn-sm minus-btn">
                                                                <i class="bx bx-minus"></i>
                                                            </button>
                                                        {{-- </form> --}}
                                                        <input type="text" class="form-control quantity-input" name="quantity" value="{{ $v->quantity }}">
                                                        {{-- <form action="{{ route('updateQty', ['itemId' => $v->id, 'action' => 'plus']) }}" method="POST" class="update-quantity-form"> --}}
                                                            @csrf
                                                            <button type="submit" class="btn btn-light btn-sm plus-btn">
                                                                <i class="bx bx-plus"></i>
                                                            </button>
                                                        {{-- </form> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Total</p>
                                                <h5 class="font-size-16">RM {{ number_format($v->product->price*$v->quantity,2,'.',',') }}</h5>
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
                                                <td class="text-end">RM {{ number_format($subtotal,2,'.',',') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Discount : </td>
                                                <td class="text-end">- RM 0</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping Charge :</td>
                                                <td class="text-end">RM 0</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>Total :</th>
                                                <td class="text-end">
                                                    <span class="fw-bold">
                                                        RM {{ number_format($subtotal,2,'.',',') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                            <div class="row my-4 px-4">
                                <div class="col-sm-6">
                                    <a href="{{ route('member.product-list') }}" class="btn btn-link text-muted">
                                        <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-end mt-2 mt-sm-0">
                                        <a href="ecommerce-checkout" class="btn btn-success">
                                            <i class="mdi mdi-cart-outline me-1"></i> Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Get the input fields and buttons
            var quantityInput = $('input[name="quantity"]');
            var minusButton = $('.minus-btn');
            var plusButton = $('.plus-btn');

            // Decrement the value when minus button is clicked
            minusButton.click(function() {
                var currentIndex = minusButton.index($(this));
                var currentValue = parseInt(quantityInput.eq(currentIndex).val());
                if (currentValue > 1) {
                    quantityInput.eq(currentIndex).val(currentValue - 1);
                }
            });

            // Increment the value when plus button is clicked
            plusButton.click(function() {
                var currentIndex = plusButton.index($(this));
                var currentValue = parseInt(quantityInput.eq(currentIndex).val());
                quantityInput.eq(currentIndex).val(currentValue + 1);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.update-quantity-form').submit(function(event) {
                event.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle the success response and update the quantity field if needed
                        var quantityInput = form.find('.quantity-input');
                        quantityInput.val(response.quantity);
                    },
                    error: function(xhr) {
                        // Handle the error response if needed
                    }
                });
            });
        });
    </script>


@endsection
