@extends('layouts.master')
@section('title')
    New Orders
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') New Orders @endslot
    @endcomponent

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

<div class="col-xl-12 col-lg-8">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="table-new-order"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script>
    new gridjs.Grid({
        columns: ['ID', 'Order Number', 'Total Amount', 'Receiver', 'Contact', 'Email', 'Delivery Method', 'Payment Method', 'Delivery Address', 'Delivery Fee', 'Remarks'],
        search: true,
        sort: true,
        pagination: {
            limit: 10
        },
        server: {
            url: 'admin/order-list/new-order-gridData', // Update the URL here
        }
    }).render(document.getElementById("table-new-order"));
</script>
@endsection
