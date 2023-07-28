@extends('layouts.master')
@section('title')
    My Orders
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url')
            {{ url('/') }}
        @endslot
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            My Orders
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <h5>Showing result for "Orders"</h5>
                                <ol class="breadcrumb p-0 bg-transparent mb-2">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                                    <li class="breadcrumb-item active">Pending</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-inline float-md-end">
                                <div class="search-box ms-2">
                                    <div class="position-relative">
                                        <input type="text" class="form-control bg-light border-light rounded"
                                            placeholder="Search...">
                                        <i class="bx bx-search search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-tabs-custom mt-3 mb-2 ecommerce-sortby-list">
                        <li class="nav-item">
                            <a class="nav-link disabled fw-medium" href="#" tabindex="-1" aria-disabled="true">Sort
                                orders by:</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#all" role="tab"
                                href="#">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#toPay" role="tab" href="#">To Pay</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#toShip" role="tab" href="#">To
                                Ship</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#toReceive" role="tab" href="#">To
                                Receive</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab"
                                href="#">Completed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab"
                                href="#">Cancelled</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab"
                                href="#">Refund</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        @include('member.partials._orders_tab_contents')
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0">Page 2 of 84</p>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
