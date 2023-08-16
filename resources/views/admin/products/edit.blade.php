@extends('layouts.master')
@section('title') Edit Product @endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Edit @endslot
        @slot('title2') Edit Product @endslot
    @endcomponent

    @include('includes.alerts')

    <form action="{{ route('update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="card">
                        <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    {{-- <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                01
                                            </div>
                                        </div>
                                    </div> --}}
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
                                            <input class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="e.g Br2" type="text" value="{{ $product->code }}">
                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label required">Upload Main Image</label>
                                            <div class="input-group">
                                                <input name="image_1" class="form-control @error('image_1') is-invalid @enderror" type="file" id="formFile" value="{{ $product->image_1 }}">
                                                <a href="{{ route('remove-picture', $product->id) }}" role="button" class="btn btn-danger" id="remove" data-confirm-delete="true">Remove </a>
                                            </div>
                                            @if ($product->image_1)
                                                <p>Current Image: {{ $product->image_1 }}</p>
                                            @endif
                                            @error('image_1')
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
                                            <label class="form-label required" for="name">Product Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Product Name" type="text" value="{{ $product->name }}">
                                            @error('name')
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
                                            <label for="choices-single-default" class="form-label required">Category</label>
                                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $k => $v)
                                                    <option value="{{ $k }}" {{ $product->category->id == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>Select one category</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label required" for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter English Description" rows="4">{!! $product->description !!}</textarea>
                                            @error('description')
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
                                                @foreach ($statuses as $status)
                                                <option value="{{ $status }}" {{ $product->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                                @endforeach
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
                                                @foreach ($quantities as $qty)
                                                    <option value="{{ $qty }}" {{ $product->shipping_quantity == $qty ? 'selected' : '' }}>{{ $qty }}</option>
                                                @endforeach
                                            </select>
                                            @error('shipping_quantity')
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
                                            <label class="form-label required" for="price">Price</label>
                                            <div class="input-group">
                                                <div class="input-group-text">RM</div>
                                                <input class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="e.g. 388.50" type="number" value="{{ $product->price }}">
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
                                            <input id="discount" name="discount" placeholder="e.g. 5 (without %)" type="number" class="form-control" value="{{ $product->discount }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
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
                        <div id="addproduct-img-collapse" data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 2</label>
                                                <input name="image_2" class="form-control" type="file" id="formFile">
                                                @if ($product->image_2)
                                                    <p>Current Image: {{ $product->image_2 }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 3</label>
                                                <input name="image_3" class="form-control" type="file" id="formFile">
                                                @if ($product->image_3)
                                                    <p>Current Image: {{ $product->image_3 }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 4</label>
                                                <input name="image_4" class="form-control" type="file" id="formFile">
                                                @if ($product->image_4)
                                                    <p>Current Image: {{ $product->image_4 }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-xl-0">
                                            <div class="mt-4">
                                                <label for="formFile" class="form-label">Upload Image 5</label>
                                                <input name="image_5" class="form-control" type="file" id="formFile">
                                                @if ($product->image_5)
                                                    <p>Current Image: {{ $product->image_5 }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-end">
                <a href="{{ route('list') }}" class="btn btn-danger cancel-btn"> <i class="bx bx-x me-1"></i> Cancel </a>
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
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .then( function(editor) {
            editor.ui.view.editable.element.style.height = '200px';
        } )
        .catch( function(error) {
            console.error( error );
        } );
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        // Select the cancel button by its class name
        const cancelButton = document.querySelector('.cancel-btn');

        // Add a click event listener to the cancel button
        cancelButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            // Show the SweetAlert2 confirmation popup
            Swal.fire({
                title: 'Cancel edit product?',
                text: 'The edited product will not be save.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                // If the user confirms, navigate to the specified route
                if (result.isConfirmed) {
                    window.location.href = cancelButton.getAttribute('href');
                }
            });
        });
    });
    </script>
@endsection
