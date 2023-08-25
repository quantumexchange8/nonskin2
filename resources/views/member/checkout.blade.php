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

    <style>
        .error-input {
            border-color: red;
            color: red;
        }
    </style>
<form action="{{ route('place-order') }}" method="POST" id="checkout-form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-8">
            <div class="custom-accordion">
                <div class="card">
                    <div class="collapse show">
                        <div class="p-4 border-top">
                            <h5 class="font-size-14 mb-3 required">Select delivery method :</h5>
                            <div class="row">
                                @foreach ($delivery_methods as $res)
                                    @if($res->status == 1)
                                        <div class="col-lg-3 col-sm-6">
                                            <div data-bs-toggle="collapse">
                                                <label class="card-radio-label">
                                                    <input type="radio" name="delivery_method" id="shippingMethod"
                                                        class="card-radio-input" value="{{ $res->name }}">
                                                    <span class="card-radio text-center text-truncate" data-bs-toggle="tooltip" data-placement="top"
                                                    title="" data-bs-original-title="{{ $res->name }}">
                                                        <i class="{{ $res->icon_class }} d-block h2 mb-3"></i>
                                                        {{ $res->name }}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-3 col-sm-6">
                                            <div data-bs-toggle="collapse">
                                                <label class="card-radio-label">
                                                    <input type="radio" name="delivery_method" id="selfpickupMethod"
                                                        class="card-radio-input" value="{{ $res->name }}">
                                                    <span class="card-radio text-center text-truncate" data-bs-toggle="tooltip" data-placement="top"
                                                    title="" data-bs-original-title="{{ $res->name }}">
                                                        <i class="{{ $res->icon_class }} d-block h2 mb-3"></i>
                                                        {{ $res->name }}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div id="shippinginfo" style="display: none;">
                    <div class="card">
                        @include('member.partials._checkout_shipping_info')
                    </div>
                    
                    <div class="card">
                        @include('member.partials._checkout_payment_info_ship')
                    </div>              
                </div>

                <div id="selfpickupinfo" style="display: none;">
                    <div class="card" >
                        @include('member.partials._checkout_selfpickup_info')
                    </div>
                    <div class="card">
                        @include('member.partials._checkout_payment_info_self')
                    </div>
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
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {

            function resetShippingInfo() {
                // Reset the selected address and payment fields in the shipping section
                $('input[name="address"]').prop('checked', false);
                $('input[name="payment_method"]').prop('checked', false);
            }

            // Initially hide the shippinginfo card
            $('#shippinginfo').hide();
            $('#selfpickupinfo').hide();
            
            $('input[name="delivery_method"]').change(function () {
                // Check if the "shippingMethod" radio button is selected
                if ($('#shippingMethod').is(':checked')) {
                    // If it's selected, show the shippinginfo card
                    $('#shippinginfo').show();
                    // Also hide the selfpickupinfo card if it was previously shown
                    $('#selfpickupinfo').hide();

                     // Show the shipping table and hide the self-pickup table
                    $('#shippingTable').show();
                    $('#selfpickupTable').hide();

                    // Reset the shipping info fields
                    resetShippingInfo();

                    // Update the shipping charge and total amount
                    updateShippingCharge(true);
                } else if ($('#selfpickupMethod').is(':checked')) {
                    // If it's not selected, hide the shippinginfo card
                    $('#shippinginfo').hide();
                    // Also show the selfpickupinfo card if it was previously hidden
                    $('#selfpickupinfo').show();

                    // Hide the shipping table and show the self-pickup table
                    $('#shippingTable').hide();
                    $('#selfpickupTable').show();

                    // Reset the shipping info fields
                    resetShippingInfo();

                    // Update the shipping charge and total amount
                    updateShippingCharge(false);
                } else {
                    // If neither deliveryMethod nor selfpickupMethod is selected
                    // Hide both shipping and self-pickup info cards and show 0.00 for shipping charge
                    $('#shippinginfo').hide();
                    $('#selfpickupinfo').hide();
                    $('#shipping').text('RM 0.00');
                    $('#delivery-fee-input').val('0.00');
                }
            });

             // Attach change event handler to the payment method radio buttons
            $('input[name="payment_method"]').change(function() {
                const selectedPaymentMethod = $('input[name="payment_method"]:checked').val();
                const paymentProofSection = $('#payment-proof-section');
                const paymentProofSection2 = $('#payment-proof-section2');
                
                const pruchaseWalletSection = $('#purchase-wallet-balance-section');
                const pruchaseWalletSection2 = $('#purchase-wallet-balance-section2');
                
                if (selectedPaymentMethod === 'Manual Transfer') {
                    paymentProofSection.show();
                    paymentProofSection2.show();

                    pruchaseWalletSection.hide();
                    pruchaseWalletSection2.hide();

                } else if (selectedPaymentMethod === 'Purchase Wallet') {
                    pruchaseWalletSection.show();
                    pruchaseWalletSection2.show();

                    paymentProofSection.hide();
                    paymentProofSection2.hide();
                } else {
                    paymentProofSection.hide();
                    paymentProofSection2.hide();

                    pruchaseWalletSection.hide();
                    pruchaseWalletSection2.hide();
                }
            });

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

                // Get the data-name and data-contact attributes from the selected radio button
                let name = null;
                let contact = null;

                
                if (selectedAddressRadio) {
                    name = selectedAddressRadio.data('name');
                    contact = selectedAddressRadio.data('contact');
                }
                if (selectedDeliveryMethod === 'Delivery') {
                    if (!selectedAddressRadio.is(':checked')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select your delivery address to proceed'
                        })
                        return;
                    }
                }else if (selectedDeliveryMethod === 'Self-Pickup') {
                    if (!selectedAddressRadio.is(':checked')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select the self-pickup address'
                        })
                        return;
                    }
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
                

                    // Check the delivery method post to controller accordingly
                    if (selectedDeliveryMethod === 'Delivery') {
                        if(selectedPaymentMethod === 'Manual Transfer') {

                            const walletInput = document.getElementById('wallet-input');
                            const walletAmount = parseFloat(walletInput.value) || 0;
                            const totalAmountPrice = parseFloat(document.getElementById('totalAmountValue').value);

                            let formData = new FormData();

                            // Append the fields that are always present
                            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                            formData.append('user_id', {{ $user->id }});
                            formData.append('email', '{{ $user->email }}');
                            formData.append('total_amount', formattedTotal);
                            formData.append('delivery_method', selectedDeliveryMethod); // Append delivery method
                            formData.append('address', $('input[name="address"]:checked').val()); // Append address
                            formData.append('payment_method', selectedPaymentMethod); // Append payment method
                            formData.append('delivery_fee', shippingCharge ); // Append delivery fee
                            formData.append('receiver', name);
                            formData.append('contact', contact);
                            formData.append('price', totalAmountPrice);
                            formData.append('discount_amt', '{{ $total_discounted }}');
                            formData.append('product_wallet', walletAmount);
                            
                            // Get the payment proof file input
                            const paymentProofInput = document.getElementById('payment_proof');
                            if (paymentProofInput.files.length > 0) {
                                // Add the payment_proof to the FormData
                                formData.append('payment_proof', paymentProofInput.files[0]);
                            } else {
                                formData.append('payment_proof', null);
                            }

                            $.ajax({
                                url: '{{ route("place-order") }}',
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    if (response && response.message) {
                                        var timerInterval;
                                        Swal.fire({
                                        title: response.message,
                                        html: 'Please do not click on anywhere while being redirected to the payment page',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        allowOutsideClick: false, // Prevent outside click
                                        showConfirmButton: false, // Hide the confirm button
                                        didOpen:function () {
                                            Swal.showLoading()
                                            timerInterval = setInterval(function() {
                                            var content = Swal.getHtmlContainer()
                                            if (content) {
                                                var b = content.querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                }
                                            }
                                            }, 100)
                                        },
                                        onClose: function () {
                                            clearInterval(timerInterval);
                                            window.location.href = "{{ route('member.order-pending') }}";
                                        }
                                        }).then(function (result) {
                                            /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                window.location.href = "{{ route('member.order-pending') }}";
                                            }
                                        })
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // console.log(formData);
                                    console.log(xhr);
                                    console.log(status);
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: error
                                })
                                return;
                                }
                            });

                        } else if ( selectedPaymentMethod === 'Purchase Wallet') {

                            const walletInput = document.getElementById('wallet-input');
                            const walletAmount = parseFloat(walletInput.value) || 0;

                            const totalPrice = Number({{ $subtotal }});
                            const proWallet = Number({{ $user->product_wallet }});
                            const totalAmountPrice = parseFloat(document.getElementById('totalAmountValue').value);

                            $.ajax({
                                url: '{{ route("get-user-purchase-wallet-balance") }}',
                                method: 'GET',
                                success: function(response) {
                                    const UserPurchaseWalletBalance = response.purchase_wallet_balance;
                                    
                                    // Check if the user's purchase wallet balance is sufficient
                                    if(walletAmount <= totalPrice) {
                                        if (UserPurchaseWalletBalance >= formattedTotal) {
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
                                                name: 'price',
                                                value: totalAmountPrice
                                            }, {
                                                name: 'discount_amt',
                                                value: '{{ $total_discounted }}'
                                            }, {
                                                name: 'total_amount',
                                                value: formattedTotal
                                            }, {
                                                name: 'product_wallet',
                                                value: walletAmount
                                            });

                                            formData.push({
                                                name: 'receiver',
                                                value: name
                                            }, {
                                                name: 'contact',
                                                value: contact
                                            });

                                            $.ajax({
                                                url: '{{ route("place-order") }}',
                                                method: 'POST',
                                                data: formData,
                                                success: function(response) {
                                                    if (response && response.message) {
                                                        var timerInterval;
                                                        Swal.fire({
                                                        title: response.message,
                                                        html: 'Please do not click on anywhere while being redirected to the payment page',
                                                        timer: 3000,
                                                        timerProgressBar: true,
                                                        allowOutsideClick: false, // Prevent outside click
                                                        showConfirmButton: false, // Hide the confirm button
                                                        didOpen:function () {
                                                            Swal.showLoading()
                                                            timerInterval = setInterval(function() {
                                                            var content = Swal.getHtmlContainer()
                                                            if (content) {
                                                                var b = content.querySelector('b')
                                                                if (b) {
                                                                    b.textContent = Swal.getTimerLeft()
                                                                }
                                                            }
                                                            }, 100)
                                                        },
                                                        onClose: function () {
                                                            clearInterval(timerInterval);
                                                            window.location.href = "{{ route('member.order-pending') }}";
                                                        }
                                                        }).then(function (result) {
                                                            /* Read more about handling dismissals below */
                                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                                window.location.href = "{{ route('member.order-pending') }}";
                                                            }
                                                        })
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    console.log(xhr);
                                                    console.log(status);
                                                    Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: error
                                                    })
                                                    return;
                                                }

                                            });
                                        } else {
                                            // User has insufficient balance, show an error message
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Insufficient Purchase Wallet Balance',
                                                text: 'Your purchase wallet balance is not sufficient to complete this transaction.',
                                            });
                                        }
                                    } else {
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Invalid Amount...',
                                        text: 'Insufficient Amount'
                                        })
                                        return;
                                    }
                                    
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });

                        } else {

                            const walletInput = document.getElementById('wallet-input');
                            const walletAmount = parseFloat(walletInput.value) || 0;
                            const totalAmountPrice = parseFloat(document.getElementById('totalAmountValue').value);

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
                                name: 'price',
                                value: totalAmountPrice
                            }, {
                                name: 'discount_amt',
                                value: '{{ $total_discounted }}'
                            }, {
                                name: 'product_wallet',
                                value: walletAmount
                            });

                            formData.push({
                                name: 'receiver',
                                value: name
                            }, {
                                name: 'contact',
                                value: contact
                            }, {
                                name: 'product_wallet',
                                value: walletAmount
                            });

                            $.ajax({
                                url: '{{ route("place-order") }}',
                                method: 'POST',
                                data: formData,
                                success: function(response) {
                                    if (response && response.message) {
                                        var timerInterval;
                                        Swal.fire({
                                        title: response.message,
                                        html: 'Please do not click on anywhere while being redirected to the payment page',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        allowOutsideClick: false, // Prevent outside click
                                        showConfirmButton: false, // Hide the confirm button
                                        didOpen:function () {
                                            Swal.showLoading()
                                            timerInterval = setInterval(function() {
                                            var content = Swal.getHtmlContainer()
                                            if (content) {
                                                var b = content.querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                }
                                            }
                                            }, 100)
                                        },
                                        onClose: function () {
                                            clearInterval(timerInterval);
                                            window.location.href = "{{ route('member.order-pending') }}";
                                        }
                                        }).then(function (result) {
                                            /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                window.location.href = "{{ route('member.order-pending') }}";
                                            }
                                        })
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr);
                                    console.log(status);
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: error
                                    })
                                    return;
                                }

                            });
                        }
                        
                        
                    } else if (selectedDeliveryMethod === 'Self-Pickup') {
                        if(selectedPaymentMethod === 'Manual Transfer'){

                            const walletInput = document.getElementById('wallet-input');
                            const walletAmount = parseFloat(walletInput.value) || 0;
                            const totalAmountPrice = parseFloat(document.getElementById('totalAmountValue').value);

                            let formData = new FormData();

                            // Append the fields that are always present
                            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                            formData.append('user_id', {{ $user->id }});
                            formData.append('email', '{{ $user->email }}');
                            formData.append('total_amount', formattedTotal);
                            formData.append('delivery_method', selectedDeliveryMethod); // Append delivery method
                            formData.append('address', $('input[name="address"]:checked').val()); // Append address
                            formData.append('payment_method', selectedPaymentMethod); // Append payment method
                            formData.append('delivery_fee', shippingCharge ); // Append delivery fee
                            formData.append('receiver', name);
                            formData.append('contact', contact);
                            formData.append('price', totalAmountPrice);
                            formData.append('discount_amt', '{{ $total_discounted }}');
                            formData.append('product_wallet', walletAmount);

                            // Get the payment proof file input
                            const paymentProofInput = document.getElementById('payment_proof2');
                            if (paymentProofInput.files.length > 0) {
                                // Add the payment_proof to the FormData
                                formData.append('payment_proof', paymentProofInput.files[0]);
                            } else {
                                formData.append('payment_proof', null);
                            }

                            $.ajax({
                                url: '{{ route("place-order") }}',
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    if (response && response.message) {
                                        var timerInterval;
                                        Swal.fire({
                                        title: response.message,
                                        html: 'Please do not click on anywhere while being redirected to the payment page',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        allowOutsideClick: false, // Prevent outside click
                                        showConfirmButton: false, // Hide the confirm button
                                        didOpen:function () {
                                            Swal.showLoading()
                                            timerInterval = setInterval(function() {
                                            var content = Swal.getHtmlContainer()
                                            if (content) {
                                                var b = content.querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                }
                                            }
                                            }, 100)
                                        },
                                        onClose: function () {
                                            clearInterval(timerInterval);
                                            window.location.href = "{{ route('member.order-pending') }}";
                                        }
                                        }).then(function (result) {
                                            /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                window.location.href = "{{ route('member.order-pending') }}";
                                            }
                                        })
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // console.log(formData);
                                    console.log(xhr);
                                    console.log(status);
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: error
                                })
                                return;
                                }
                            });
                        } else if (selectedPaymentMethod === 'Purchase Wallet') {

                            const walletInput = document.getElementById('wallet-input');
                            const walletAmount = parseFloat(walletInput.value) || 0;
                            const totalAmountPrice = parseFloat(document.getElementById('totalAmountValue').value);
                            const totalPrice = Number({{ $subtotal }});

                            $.ajax({
                                url: '{{ route("get-user-purchase-wallet-balance") }}',
                                method: 'GET',
                                success: function(response) {
                                    const UserPurchaseWalletBalance = response.purchase_wallet_balance;
                                    
                                    if(walletAmount >= 0 && walletAmount <= totalPrice) {
                                        // Check if the user's purchase wallet balance is sufficient
                                        if (UserPurchaseWalletBalance >= formattedTotal) {
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
                                                name: 'price',
                                                value: totalAmountPrice
                                            }, {
                                                name: 'discount_amt',
                                                value: '{{ $total_discounted }}'
                                            }, {
                                                name: 'total_amount',
                                                value: formattedTotal
                                            }, {
                                                name: 'product_wallet',
                                                value: walletAmount
                                            });

                                            formData.push({
                                                name: 'receiver',
                                                value: '{{ $user->full_name }}'
                                            }, {
                                                name: 'contact',
                                                value: {{ $user->contact }}
                                            });

                                            $.ajax({
                                                url: '{{ route("place-order") }}',
                                                method: 'POST',
                                                data: formData,
                                                success: function(response) {
                                                    if (response && response.message) {
                                                        var timerInterval;
                                                        Swal.fire({
                                                        title: response.message,
                                                        html: 'Please do not click on anywhere while being redirected to the payment page',
                                                        timer: 3000,
                                                        timerProgressBar: true,
                                                        allowOutsideClick: false, // Prevent outside click
                                                        showConfirmButton: false, // Hide the confirm button
                                                        didOpen:function () {
                                                            Swal.showLoading()
                                                            timerInterval = setInterval(function() {
                                                            var content = Swal.getHtmlContainer()
                                                            if (content) {
                                                                var b = content.querySelector('b')
                                                                if (b) {
                                                                    b.textContent = Swal.getTimerLeft()
                                                                }
                                                            }
                                                            }, 100)
                                                        },
                                                        onClose: function () {
                                                            clearInterval(timerInterval);
                                                            window.location.href = "{{ route('member.order-pending') }}";
                                                        }
                                                        }).then(function (result) {
                                                            /* Read more about handling dismissals below */
                                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                                window.location.href = "{{ route('member.order-pending') }}";
                                                            }
                                                        })
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    console.log(xhr);
                                                    console.log(status);
                                                    Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: error
                                                    })
                                                    return;
                                                }

                                            });
                                        } else {
                                            // User has insufficient balance, show an error message
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Insufficient Purchase Wallet Balance',
                                                text: 'Your purchase wallet balance is not sufficient to complete this transaction.',
                                            });
                                        }
                                    } else {
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Invalid Amount...',
                                        text: 'Insufficient Amount'
                                        })
                                        return;
                                    }
                                    
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        } else {

                            const walletInput = document.getElementById('wallet-input');
                            const walletAmount = parseFloat(walletInput.value) || 0;
                            const totalAmountPrice = parseFloat(document.getElementById('totalAmountValue').value);

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
                                name: 'price',
                                value: totalAmountPrice
                            }, {
                                name: 'product_wallet',
                                value: walletAmount
                            }, {
                                name: 'discount_amt',
                                value: '{{ $total_discounted }}'
                            }, {
                                name: 'product_wallet',
                                value: walletAmount
                            });

                            formData.push({
                                name: 'receiver',
                                value: '{{ $user->full_name }}'
                            }, {
                                name: 'contact',
                                value: {{ $user->contact }}
                            });

                            $.ajax({
                                url: '{{ route("place-order") }}',
                                method: 'POST',
                                data: formData,
                                success: function(response) {
                                    if (response && response.message) {
                                        var timerInterval;
                                        Swal.fire({
                                        title: response.message,
                                        html: 'Please do not click on anywhere while being redirected to the payment page',
                                        timer: 3000,
                                        timerProgressBar: true,
                                        allowOutsideClick: false, // Prevent outside click
                                        showConfirmButton: false, // Hide the confirm button
                                        didOpen:function () {
                                            Swal.showLoading()
                                            timerInterval = setInterval(function() {
                                            var content = Swal.getHtmlContainer()
                                            if (content) {
                                                var b = content.querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                }
                                            }
                                            }, 100)
                                        },
                                        onClose: function () {
                                            clearInterval(timerInterval);
                                            window.location.href = "{{ route('member.order-pending') }}";
                                        }
                                        }).then(function (result) {
                                            /* Read more about handling dismissals below */
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                window.location.href = "{{ route('member.order-pending') }}";
                                            }
                                        })
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr);
                                    console.log(status);
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: error
                                    })
                                    return;
                                }

                            });
                        }
                    }
            });
        });

        // update shipping fee base on user selection address
        let shippingCharge = 0; 
        function updateShippingCharge(isShippingMethod) {
            const deliveryMethod = $('input[name="delivery_method"]:checked').val();
            const shippingElement = document.getElementById('shipping');
            const selectedAddress = $('input[name="address"]:checked');
            const shippingQty = document.getElementById('shipqty').value;
            
            if (deliveryMethod === 'Delivery' && selectedAddress.length > 0) {
                 // Check if any address is selected
                 shippingCharge = parseFloat(selectedAddress.data('shipping-charge')) * shippingQty;
            } else {
                shippingCharge = 0;
            }

            const shippingAmount = shippingCharge.toFixed(2);
            shippingElement.innerText = `RM ${shippingAmount}`;

            // Set the value of the hidden input field for both shipping and self-pickup
            const deliveryFeeInput = document.getElementById('delivery-fee-input');
            const selfPickupFeeInput = document.getElementById('selfpickup-fee-input');
            deliveryFeeInput.value = shippingCharge;
            selfPickupFeeInput.value = shippingCharge;

            // Calculate and update the total amount
            const totalPrice = Number({{ $subtotal }});
            const totalAmount = (totalPrice + shippingCharge).toFixed(2);
            const totalElement = document.getElementById('total');
            totalElement.innerText = `RM ${totalAmount}`;
        }

        // Call the function when the address or delivery method changes
        $('input[name="delivery_method"], input[name="address"]').on('change', updateShippingCharge);

        function updateTotalAmount() {
            const walletInput = document.getElementById('wallet-input');
            const walletAmount = parseFloat(walletInput.value) || 0; // Get the value from the input or default to 0

            const maxWalletBalance = parseFloat({{ $user->product_wallet }});

            // Calculate the total amount to pay
            const totalPrice = Number({{ $subtotal }}); 

            let totalAmount = (totalPrice + shippingCharge - walletAmount).toFixed(2);

            const placeOrderButton = document.getElementById('place-order-btn');

            if (totalAmount < 0) {
                totalAmount = 0;
                Swal.fire({
                    icon: 'error',
                    title: 'Product Wallet Amount exceeded',
                    text: 'Your product wallet balance has exceeded the limit.',
                });
                walletInput.classList.add('error-input');
                walletInput.classList.add('disable');
                
                // Disable the "Place Order" button
                placeOrderButton.disabled = true;
            } else if (walletAmount > maxWalletBalance) {
                Swal.fire({
                    icon: 'error',
                    title: 'Insufficient Purchase Wallet Balance',
                    text: 'Your product wallet balance has exceeded the limit.',
                });
                walletInput.classList.add('error-input');
                walletInput.classList.add('disable');

                // Disable the "Place Order" button
                placeOrderButton.disabled = true;
            } else {
                walletInput.classList.remove('error-input');
                walletInput.classList.remove('disable');

                // Enable the "Place Order" button
                placeOrderButton.disabled = false;
            }

            const totalElement = document.getElementById('total');
            totalElement.innerText = `RM ${totalAmount}`;
        }

        function updateTotalAmount2() {
            const walletInput = document.getElementById('wallet-input2');
            const walletAmount = parseFloat(walletInput.value) || 0; // Get the value from the input or default to 0

            const maxWalletBalance = parseFloat({{ $user->product_wallet }});

            // Calculate the total amount to pay
            const totalPrice = Number({{ $subtotal }}); 

            let totalAmount = (totalPrice + shippingCharge - walletAmount).toFixed(2);

            const placeOrderButton = document.getElementById('place-order-btn');

            if (totalAmount < 0) {
                totalAmount = 0;
                Swal.fire({
                    icon: 'error',
                    title: 'Insufficient Purchase Wallet Balance',
                    text: 'Your purchase wallet balance is not sufficient to complete this transaction.',
                });
                walletInput.classList.add('error-input');
                walletInput.classList.add('disable');
                
                // Disable the "Place Order" button
                placeOrderButton.disabled = true;
            } else if (walletAmount > maxWalletBalance) {
                Swal.fire({
                    icon: 'error',
                    title: 'Insufficient Purchase Wallet Balance',
                    text: 'Your product wallet balance has exceeded the limit.',
                });
                walletInput.classList.add('error-input');
                walletInput.classList.add('disable');

                // Disable the "Place Order" button
                placeOrderButton.disabled = true;
            } else {
                walletInput.classList.remove('error-input');
                walletInput.classList.remove('disable');

                // Enable the "Place Order" button
                placeOrderButton.disabled = false;
            }

            const totalElement = document.getElementById('total2');
            totalElement.innerText = `RM ${totalAmount}`;
        }


    // Call the function when the wallet input changes
    document.getElementById('wallet-input').addEventListener('input', updateTotalAmount);
    document.getElementById('wallet-input2').addEventListener('input', updateTotalAmount2);
    
    </script>
@endsection
