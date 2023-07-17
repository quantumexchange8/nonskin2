@extends('layouts.master')
@section('title')
    @lang('translation.Starter_Page')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Products
        @endslot
        @slot('title')
            Product List
        @endslot
    @endcomponent

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@include('admin.products.modal-update-product')

<div class="col-xl-12 col-lg-8">

    <div class="tab-content p-3 text-muted">
        <div class="tab-pane active" id="popularity" role="tabpanel">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target=".modal-update-product"><i
                                    class='bx bx-plus-circle'></i> Add Product</button>
                        </div>
                        <div class="card-body">
                            <div id="table-product-list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script>
    (function() {
        var products = {!! json_encode($products) !!};
        var __webpack_exports__ = {};
        // Basic Table
        new gridjs.Grid({
            columns: ["Product Code", "Product Name", "Category", "Shipping Quantity", "Price", "Image",
                "Action"
            ],
            pagination: {
                limit: 5
            },
            sort: true,
            search: true,
            data: products.map(product => [
                product.code,
                product.name,
                product.category,
                product.shipping_quantity,
                product.price,
                product.image,
                "Action" // Replace this with the appropriate action for each row
            ])
        }).render(document.getElementById("table-product-list"));
    })();
</script>
@endsection
