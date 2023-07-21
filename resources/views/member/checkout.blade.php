@extends('layouts.master')
@section('title')
    Checkout
@endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Checkout @endslot
    @endcomponent

<form action="" id="checkout-form">
    <div class="row">
        <div class="col-xl-8">
            <div class="custom-accordion">
                <div class="card">
                    {{-- @include('member.partials._checkout_billing_info') --}}
                </div>
                <div class="card">
                    @include('member.partials._checkout_shipping_info')
                </div>
                <div class="card">
                    @include('member.partials._checkout_payment_info')
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card checkout-order-summary">
                @include('member.partials._checkout_summary')
            </div>
        </div>
    </div>
</form>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Attach a click event handler to the "Place Order" button
            $('#place-order-btn').click(function() {
                // Check if delivery method and payment method are selected
                const selectedDeliveryMethod = $('input[name="delivery_method"]:checked').val();
                const selectedPaymentMethod = $('input[name="payment_method"]:checked').val();

                if (!selectedDeliveryMethod || !selectedPaymentMethod) {
                    // Display an error message or alert to inform the user to select both options
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select both delivery method and payment method'
                    })
                    return;
                }

                // Calculate the total amount including the shipping charge
                const totalAmount = {{ $user->cart->total_price }} + {{ $user->shipping_charge->amount }};

                // Serialize the form data
                let formData = $('#checkout-form').serializeArray();

                formData.push({
                    name: '_token', // Add the CSRF token field
                    value: $('meta[name="csrf-token"]').attr('content') // Extract the CSRF token value from the meta tag
                }, {
                    name: 'user_id',
                    value: {{ $user->id }}
                }, {
                    name: 'total_amount',
                    value: totalAmount // Use the calculated total amount
                }, {
                    name: 'receiver',
                    value: '{{ $user->name }}'
                }, {
                    name: 'contact',
                    value: '{{ $user->contact }}'
                }, {
                    name: 'email',
                    value: '{{ $user->email }}'
                }, {
                    name: 'delivery_method',
                    value: selectedDeliveryMethod
                }, {
                    name: 'payment_method',
                    value: selectedPaymentMethod
                }, {
                    name: 'delivery_address',
                    value: $('input[name="address"]:checked').val()
                }, {
                    name: 'delivery_fee',
                    value: '{{ $user->shipping_charge->amount }}'
                });

                // Use AJAX to post the form data to the server
                $.ajax({
                    url: '{{ route("place-order") }}', // Replace this with the appropriate route for your server
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(formData);
                        window.location.href = "{{ route('member.cart') }}";
                        // Handle the successful response, if needed
                        // For example, you can redirect the user to a success page or display a success message
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        console.log('Error placing order:', error);
                    }
                });
            });
        });
    </script>
@endsection
