@extends('layouts.master')
@section('title') My Orders @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') My Orders @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <h5>Showing result for "Shoes"</h5>
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
                                            <input type="text" class="form-control bg-light border-light rounded" placeholder="Search...">
                                            <i class="bx bx-search search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-custom mt-3 mb-2 ecommerce-sortby-list">
                            <li class="nav-item">
                                <a class="nav-link disabled fw-medium" href="#" tabindex="-1" aria-disabled="true">Sort orders by:</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#popularity" role="tab" href="#">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#newest" role="tab" href="#">To Pay</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab" href="#">To Ship</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab" href="#">To Receive</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab" href="#">Completed</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab" href="#">Cancelled</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab" href="#">Refund</a>
                            </li>
                        </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="popularity" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    - 20 %
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-2.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Adidas Running Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Black, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$250</del></span> $240</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-danger"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-img pt-4 px-4">

                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-3.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Puma P103 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Purple, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$260</del></span> $250</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-purple"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-4.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Sports S120 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Cyan, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$240</del></span> $230</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-info"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-success"></i>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-img pt-4 px-4">

                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-5.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Adidas AB23 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Blue, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$240</del></span> $250</h5>
                                                        </div>
                                                    <div>
                                                        <ul class="list-inline mb-0 text-muted product-color">
                                                            <li class="list-inline-item">
                                                                Colors :
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <i class="mdi mdi-circle text-dark"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <i class="mdi mdi-circle text-light"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <i class="mdi mdi-circle text-primary"></i>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    - 20 %
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-6.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Nike N012 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Gray, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$270</del></span> $260</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                                <div class="tab-pane" id="newest" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    New
                                                </div>
                                                <div class="product-img pt-4 px-4">

                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-3.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Puma P103 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Purple, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$260</del></span> $250</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-purple"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    New
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-4.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Sports S120 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Cyan, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$240</del></span> $230</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-info"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-success"></i>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    New
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-5.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Adidas AB23 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Blue, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$240</del></span> $250</h5>
                                                        </div>
                                                    <div>
                                                        <ul class="list-inline mb-0 text-muted product-color">
                                                            <li class="list-inline-item">
                                                                Colors :
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <i class="mdi mdi-circle text-dark"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <i class="mdi mdi-circle text-light"></i>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <i class="mdi mdi-circle text-primary"></i>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    New
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-2.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Adidas Running Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Black, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$250</del></span> $240</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-danger"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end row -->
                                </div>
                                <div class="tab-pane" id="discount" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    - 20 %
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-1.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Nike N012 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Gray, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$280</del></span> $260</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-primary"></i>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    - 20 %
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-2.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">

                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Adidas Running Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Black, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$250</del></span> $240</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-danger"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-sm-6">
                                            <div class="product-box">
                                                <div class="product-ribbon">
                                                    - 20 %
                                                </div>
                                                <div class="product-img pt-4 px-4">
                                                    <div class="product-wishlist">
                                                        <a href="#">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </a>
                                                    </div>
                                                    <img src="{{ URL::asset('assets/images/product/img-6.png') }}" alt="" class="img-fluid mx-auto d-block">
                                                </div>

                                                <div class="product-content p-4">
                                                    <div class="d-flex justify-content-between align-items-end">
                                                        <div>
                                                            <h5 class="mb-1"><a href="ecommerce-product-detail" class="text-dark font-size-16">Nike N012 Shoes</a></h5>
                                                            <p class="text-muted font-size-13">Gray, Shoes</p>
                                                            <h5 class="mt-3 mb-0"><span class="text-muted me-2"><del>$270</del></span> $260</h5>
                                                        </div>

                                                        <div>
                                                            <ul class="list-inline mb-0 text-muted product-color">
                                                                <li class="list-inline-item">
                                                                    Colors :
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-dark"></i>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <i class="mdi mdi-circle text-light"></i>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
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

    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
