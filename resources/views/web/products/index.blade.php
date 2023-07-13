@extends('layouts.master')
@section('title')
    @lang('translation.Products')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/nouislider/nouislider.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Ecommerce
        @endslot
        @slot('title')
            Products
        @endslot
    @endcomponent

    @include('web.admin.products.modal-update-product')

    <div class="row">
        {{-- <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="p-4">
                    <h5 class="font-size-14 mb-3">Categories</h5>
                    <div class="custom-accordion">
                        <a class="text-body fw-semibold pb-2 d-block" data-bs-toggle="collapse" href="#categories-collapse"
                            role="button" aria-expanded="false" aria-controls="categories-collapse">
                            <i class="mdi mdi-chevron-up accor-down-icon text-primary me-1"></i> Footwear
                        </a>
                        <div class="collapse show" id="categories-collapse">
                            <div class="card p-2 border shadow-none">
                                <ul class="list-unstyled categories-list mb-0">
                                    <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Formal Shoes</a></li>
                                    <li class="active"><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Sports
                                            Shoes</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> casual Shoes</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Sandals</a></li>
                                    <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Slippers</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-top">
                    <div>
                        <h5 class="font-size-14 mb-3">Price</h5>
                        <div id="priceslider" class="mb-4"></div>
                    </div>
                </div>
                <div class="custom-accordion">
                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filtersizes-collapse" class="text-dark d-block"
                                    data-bs-toggle="collapse">Sizes <i
                                        class="mdi mdi-chevron-up float-end accor-down-icon"></i></a></h5>
                            <div class="collapse show" id="filtersizes-collapse">
                                <div class="mt-4">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="font-size-15 mb-0">Select Sizes</h5>
                                        </div>
                                        <div class="w-xs">
                                            <select class="form-select">
                                                <option value="1">3</option>
                                                <option value="2">4</option>
                                                <option value="3">5</option>
                                                <option value="4">6</option>
                                                <option value="5" selected>7</option>
                                                <option value="6">8</option>
                                                <option value="7">9</option>
                                                <option value="8">10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filterprodductcolor-collapse" class="text-dark d-block"
                                    data-bs-toggle="collapse">Colors <i
                                        class="mdi mdi-chevron-up float-end accor-down-icon"></i></a></h5>
                            <div class="collapse show" id="filterprodductcolor-collapse">
                                <div class="mt-4">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck1">
                                        <label class="form-check-label" for="productcolorCheck1"><i
                                                class="mdi mdi-circle text-dark mx-1"></i> Black</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck2">
                                        <label class="form-check-label" for="productcolorCheck2"><i
                                                class="mdi mdi-circle text-light mx-1"></i> White</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck3">
                                        <label class="form-check-label" for="productcolorCheck3"><i
                                                class="mdi mdi-circle text-secondary mx-1"></i> Gray</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck4">
                                        <label class="form-check-label" for="productcolorCheck4"><i
                                                class="mdi mdi-circle text-primary mx-1"></i> Blue</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck5">
                                        <label class="form-check-label" for="productcolorCheck5"><i
                                                class="mdi mdi-circle text-success mx-1"></i> Green</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck6">
                                        <label class="form-check-label" for="productcolorCheck6"><i
                                                class="mdi mdi-circle text-danger mx-1"></i> Red</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck7">
                                        <label class="form-check-label" for="productcolorCheck7"><i
                                                class="mdi mdi-circle text-warning mx-1"></i> Yellow</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input" id="productcolorCheck8">
                                        <label class="form-check-label" for="productcolorCheck8"><i
                                                class="mdi mdi-circle text-purple mx-1"></i> Purple</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filterproduct-color-collapse"
                                    class="text-dark d-block" data-bs-toggle="collapse">Customer Rating <i
                                        class="mdi mdi-chevron-up float-end accor-down-icon"></i></a></h5>
                            <div class="collapse show" id="filterproduct-color-collapse">
                                <div class="mt-4">
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productratingRadio1" name="productratingRadio1"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productratingRadio1">4 <i
                                                class="mdi mdi-star text-warning"></i> & Above</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productratingRadio2" name="productratingRadio1"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productratingRadio2">3 <i
                                                class="mdi mdi-star text-warning"></i> & Above</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productratingRadio3" name="productratingRadio1"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productratingRadio3">2 <i
                                                class="mdi mdi-star text-warning"></i> & Above</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productratingRadio4" name="productratingRadio1"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productratingRadio4">1 <i
                                                class="mdi mdi-star text-warning"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-top">
                        <div>
                            <h5 class="font-size-14 mb-0"><a href="#filterproduct-discount-collapse"
                                    class="collapsed text-dark d-block" data-bs-toggle="collapse">Discount <i
                                        class="mdi mdi-chevron-up float-end accor-down-icon"></i></a></h5>
                            <div class="collapse" id="filterproduct-discount-collapse">
                                <div class="mt-4">
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productdiscountRadio1" name="productdiscountRadio"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productdiscountRadio1">50% or more</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productdiscountRadio2" name="productdiscountRadio"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productdiscountRadio2">40% or more</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productdiscountRadio3" name="productdiscountRadio"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productdiscountRadio3">30% or more</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productdiscountRadio4" name="productdiscountRadio"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productdiscountRadio4">20% or more</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productdiscountRadio5" name="productdiscountRadio"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productdiscountRadio5">10% or more</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" id="productdiscountRadio6" name="productdiscountRadio"
                                            class="form-check-input">
                                        <label class="form-check-label" for="productdiscountRadio6">Less than 10%</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    {{-- <h5>Showing result for "Shoes"</h5>
                                    <ol class="breadcrumb p-0 bg-transparent mb-2">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Footwear</a></li>
                                        <li class="breadcrumb-item active">Shoes</li>
                                    </ol> --}}
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
                        {{-- <ul class="nav nav-tabs nav-tabs-custom mt-3 mb-2 ecommerce-sortby-list">
                            <li class="nav-item">
                                <a class="nav-link disabled fw-medium" href="#" tabindex="-1"
                                    aria-disabled="true">Sort by:</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#popularity" role="tab"
                                    href="#">Popularity</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#newest" role="tab"
                                    href="#">Newest</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#discount" role="tab"
                                    href="#">Discount</a>
                            </li>
                        </ul> --}}
                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="popularity" role="tabpanel">
                                <div class="row">
                                    @if (isset($products))
                                    @foreach ($products as $product)
                                    <div class="col-xl-2 col-sm-6">
                                        <div class="product-box">
                                            @if ($product->discount != 0)
                                            <div class="product-ribbon">
                                                - {{ $product->discount }} %
                                            </div>
                                            @endif
                                            <div class="product-img pt-4 px-4">
                                                <div class="product-wishlist">
                                                    <a href="#">
                                                        <i class="mdi mdi-heart-outline"></i>
                                                    </a>
                                                </div>
                                                <a href="{{ route('products.show', $product->id) }}">
                                                    <img src="{{ URL::asset('assets/images/nonskin/7.jpg') }}" alt=""
                                                    class="img-fluid mx-auto d-block" style="width: 70% !important;">
                                                </a>
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="{{ route('products.show', $product->id) }}"
                                                                class="text-dark font-size-14">{{ Str::limit($product->name_en, 21, '...') }}</a></h5>
                                                        {{-- <p class="text-muted font-size-13">{{ $product->desc_en }}</p> --}}
                                                        <h5 class="mt-3 mb-0 font-size-16">
                                                            @if ($product->discount != 0)
                                                                <span class="text-muted me-2 font-size-12">
                                                                    <del>RM{{ number_format($product->price,2,".",",") }}</del>
                                                                </span>
                                                                    RM{{ number_format($product->price - ($product->price * $product->discount/100),2,".",",") }}
                                                            @else
                                                                RM{{ number_format($product->price,2,".",",") }}
                                                            @endif
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        {{-- <ul class="list-inline mb-0 text-muted product-color">
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
                                                        </ul> --}}
                                                    </div>
                                                </div>
                                                <div class="row pt-4">
                                                    <button type="submit" class="btn btn-primary btn"><i class='bx bx-cart' ></i> Add to Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                                <!-- end row -->
                            </div>
                            {{-- <div class="tab-pane" id="newest" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6">
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
                                                <img src="{{ URL::asset('assets/images/nonskin/6.jpg') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="ecommerce-product-detail"
                                                                class="text-dark font-size-16">Puma P103 Shoes</a></h5>
                                                        <p class="text-muted font-size-13">Purple, Shoes</p>
                                                        <h5 class="mt-3 mb-0"><span
                                                                class="text-muted me-2"><del>$260</del></span> $250</h5>
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
                                            <div class="product-ribbon">
                                                New
                                            </div>
                                            <div class="product-img pt-4 px-4">
                                                <div class="product-wishlist">
                                                    <a href="#">
                                                        <i class="mdi mdi-heart-outline"></i>
                                                    </a>
                                                </div>
                                                <img src="{{ URL::asset('assets/images/nonskin/7.jpg') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="ecommerce-product-detail"
                                                                class="text-dark font-size-16">Sports S120 Shoes</a></h5>
                                                        <p class="text-muted font-size-13">Cyan, Shoes</p>
                                                        <h5 class="mt-3 mb-0"><span
                                                                class="text-muted me-2"><del>$240</del></span> $230</h5>
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
                                            <div class="product-ribbon">
                                                New
                                            </div>
                                            <div class="product-img pt-4 px-4">
                                                <div class="product-wishlist">
                                                    <a href="#">
                                                        <i class="mdi mdi-heart-outline"></i>
                                                    </a>
                                                </div>
                                                <img src="{{ URL::asset('assets/images/nonskin/8.jpg') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="ecommerce-product-detail"
                                                                class="text-dark font-size-16">Adidas AB23 Shoes</a></h5>
                                                        <p class="text-muted font-size-13">Blue, Shoes</p>
                                                        <h5 class="mt-3 mb-0"><span
                                                                class="text-muted me-2"><del>$240</del></span> $250</h5>
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
                                                New
                                            </div>
                                            <div class="product-img pt-4 px-4">
                                                <div class="product-wishlist">
                                                    <a href="#">
                                                        <i class="mdi mdi-heart-outline"></i>
                                                    </a>
                                                </div>
                                                <img src="{{ URL::asset('assets/images/nonskin/9.jpg') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="ecommerce-product-detail"
                                                                class="text-dark font-size-16">Adidas Running Shoes</a>
                                                        </h5>
                                                        <p class="text-muted font-size-13">Black, Shoes</p>
                                                        <h5 class="mt-3 mb-0"><span
                                                                class="text-muted me-2"><del>$250</del></span> $240</h5>
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
                                                <img src="{{ URL::asset('assets/images/nonskin/10.jpg') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="ecommerce-product-detail"
                                                                class="text-dark font-size-16">Nike N012 Shoes</a></h5>
                                                        <p class="text-muted font-size-13">Gray, Shoes</p>
                                                        <h5 class="mt-3 mb-0"><span
                                                                class="text-muted me-2"><del>$280</del></span> $260</h5>
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
                                                <img src="{{ URL::asset('assets/images/nonskin/11.jpg') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="ecommerce-product-detail"
                                                                class="text-dark font-size-16">Adidas Running Shoes</a>
                                                        </h5>
                                                        <p class="text-muted font-size-13">Black, Shoes</p>
                                                        <h5 class="mt-3 mb-0"><span
                                                                class="text-muted me-2"><del>$250</del></span> $240</h5>
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
                                            <div class="product-ribbon">
                                                - 20 %
                                            </div>
                                            <div class="product-img pt-4 px-4">
                                                <div class="product-wishlist">
                                                    <a href="#">
                                                        <i class="mdi mdi-heart-outline"></i>
                                                    </a>
                                                </div>
                                                <img src="{{ URL::asset('assets/images/nonskin/12.jpg') }}"
                                                    alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                            <div class="product-content p-4">
                                                <div class="d-flex justify-content-between align-items-end">
                                                    <div>
                                                        <h5 class="mb-1"><a href="ecommerce-product-detail"
                                                                class="text-dark font-size-16">Nike N012 Shoes</a></h5>
                                                        <p class="text-muted font-size-13">Gray, Shoes</p>
                                                        <h5 class="mt-3 mb-0"><span
                                                                class="text-muted me-2"><del>$270</del></span> $260</h5>
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
                            </div> --}}
                        </div>
                        <!-- Pagination Start -->
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
                        <!-- Pagination End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/product-filter-range.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
