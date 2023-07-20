@extends('layouts.master')
@section('title')
    Checkout
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Checkout @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-8">
            <div class="custom-accordion">
                <div class="card">
                    @include('member.partials._checkout_billing_info')
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

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
