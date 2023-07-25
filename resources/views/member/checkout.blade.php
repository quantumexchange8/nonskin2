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
                const selectedAddressRadio = $('input[name="address"]:checked');
                const input = document.querySelector("#address");
                const totalElement = document.getElementById('total');
                const totalAmount = Number(totalElement.innerText.match(/\d+\.\d+/)[0]);
                const formattedTotal = totalAmount.toFixed(2);
                console.log(formattedTotal);
                // Get the data-name and data-contact attributes from the selected radio button
                const name = selectedAddressRadio.data('name');
                const contact = selectedAddressRadio.data('contact');

                if (!selectedAddressRadio) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select your delivery address to proceed'
                    })
                    return;
                }
                if (!selectedDeliveryMethod) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select delivery method to proceed'
                    })
                    return;
                }
                if (!selectedPaymentMethod) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select payment method to proceed'
                    })
                    return;
                }

                // Serialize the form data
                let formData = $('#checkout-form').serializeArray();

                formData.push({
                    name: '_token',
                    value: $('meta[name="csrf-token"]').attr('content')
                }, {
                    name: 'user_id',
                    value: {{ $user->id }}
                }, {
                    name: 'email',
                    value: '{{ $user->email }}'
                }, {
                    name: 'total_amount',
                    value: formattedTotal
                }, {
                    name: 'receiver',
                    value: name
                }, {
                    name: 'contact',
                    value: contact
                });

                // Use AJAX to post the form data to the server
                $.ajax({
                    url: '{{ route("place-order") }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(formData);
                        window.location.href = "{{ route('member.cart') }}";
                    },
                    error: function(xhr, status, error) {
                        console.log(formData);
                        console.log('Error placing order:', error);

                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error
                    })
                    return;
                    }
                });
            });
        });
        function updateShippingCharge(radio) {
            const totalElement = document.getElementById('total');
            const shippingCharge = radio.value.includes('Sabah') || radio.value.includes('Sarawak') ? 5 : 0;
            const shippingElement = document.getElementById('shipping');
            const shippingAmount = shippingCharge.toFixed(2);
            const totalPrice = Number({{ $user->cart->total_price }});
            const totalAmount = (totalPrice + shippingCharge).toFixed(2);

            totalElement.innerText = `RM ${totalAmount}`;
            shippingElement.innerText = `RM ${shippingAmount}`;

            // Set the value of the hidden input field
            const deliveryFeeInput = document.getElementById('delivery-fee-input');
            deliveryFeeInput.value = shippingCharge;
        }
    </script>
@endsection
