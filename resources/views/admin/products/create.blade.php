@extends('layouts.master')
@section('title') @lang('translation.Add_Product') @endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Add Product @endslot
    @endcomponent
    @if(session('error'))
    <div class="alert alert-dismissible alert-danger" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div id="addproduct-accordion" class="custom-accordion">
                    <div class="card">
                        <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Product Info</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="addproduct-productinfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label required" for="code">Product Code</label>
                                            <input class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="e.g Br2" type="text" value="{{ old('code') }}">
                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="choices-single-default" class="form-label required">Category</label>
                                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $k => $v)
                                                    <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>Select one category</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label required" for="name-en">Product Name (EN)</label>
                                            <input class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en" placeholder="Enter Product Name" type="text" value="{{ old('name_en') }}">
                                            @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label required" for="name-cn">Product Name (CN)</label>
                                            <input class="form-control @error('name_cn') is-invalid @enderror" id="name_cn" name="name_cn" placeholder="Enter Product Name" type="text" value="{{ old('name_cn') }}">
                                            @error('name_cn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label required" for="desc-en">Description (EN)</label>
                                            <textarea class="form-control @error('desc_en') is-invalid @enderror" name="desc_en" id="desc_en" placeholder="Enter English Description" rows="4" value="{{ old('desc_en') }}"></textarea>
                                            @error('desc_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label required" for="desc-cn">Description (CN)</label>
                                            <textarea class="form-control @error('desc_cn') is-invalid @enderror" name="desc_cn" id="desc-cn" placeholder="Enter Chinese Description" rows="4" value="{{ old('desc_cn') }}"></textarea>
                                            @error('desc_cn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label required" for="status">Status</label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                                <option value="Active" selected>Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                            @error('shipping_quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label required" for="shipping_quantity">Shipping Quantity</label>
                                            {{-- <input id="shipping_quantity" name="shipping_quantity" placeholder="e.g. 2" type="number" class="form-select"> --}}
                                            <select class="form-select @error('shipping_quantity') is-invalid @enderror" id="shipping_quantity" name="shipping_quantity" >
                                                <option value="1" selected>1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            @error('shipping_quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label required" for="price">Price</label>
                                            <div class="input-group">
                                                <div class="input-group-text">RM</div>
                                                <input class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="e.g. 388.50" type="number">
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="discount">Discount in (%) <small class="text-muted">(Optional)</small></label>
                                            <input id="discount" name="discount" placeholder="e.g. 5 (without %)" type="number" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="true" aria-haspopup="true" aria-controls="addproduct-img-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                02
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Product Image</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="addproduct-img-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="mt-4 mt-xl-0">
                                    <div class="mt-4">
                                        <label for="formFile" class="form-label required">Upload Main Image</label>
                                        <input name="image_1" class="form-control @error('image_1') is-invalid @enderror" type="file" id="formFile">
                                        @error('image_1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 2</label>
                                                <input name="image_2" class="form-control" type="file" id="formFile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 3</label>
                                                <input name="image_3" class="form-control" type="file" id="formFile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 4</label>
                                                <input name="image_4" class="form-control" type="file" id="formFile">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 5</label>
                                                <input name="image_5" class="form-control" type="file" id="formFile">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-end">
                <a href="#" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Cancel </a>
                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i class=" bx bx-file me-1"></i> Save </button>
            </div> <!-- end col -->
        </div>
    </form>

    @if (session('added'))
    <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="bx bx-check-circle display-1 text-success"></i>
                        <h3 class="mt-3">Product Added Successfully</h3>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @endif

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
