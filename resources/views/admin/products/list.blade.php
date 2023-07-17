@extends('layouts.master')
@section('title') @lang('translation.Starter_Page') @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Products @endslot
    @slot('title') Product List @endslot
@endcomponent

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@include('admin.products.modal-update-product')

    <div class="col-xl-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="popularity" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".modal-update-product"><i class='bx bx-plus-circle'></i> Add Product</button>
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <div id="table-product-list"></div>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>

                    <!-- Pagination Start -->
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0">Page 1 of 84</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                <ul class="pagination pagination-rounded mb-sm-0">
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination End -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script>

    (function() {
    var __webpack_exports__ = {};
    // Basic Table
    new gridjs.Grid({
    columns: ["Product Code", "Product Name", "Category", "Shipping Quantity", "Price", "Image", "Action"],
    pagination: {
        limit: 5
    },
    sort: true,
    search: true,
    data: [["Br2", "Brush (Short)", "Retail Products", "1", "58", "Image unavailable"],
            ["Br1", "Brush (Long)", "Retail Products", "1", "68", "Image unavailable"]]
    }).render(document.getElementById("table-product-list"));
    })()
    ;

    </script>
@endsection
