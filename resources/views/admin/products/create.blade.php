@extends('layouts.master')
@section('title') @lang('translation.Add_Product') @endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ route('admin-dashboard') }} @endslot
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('title') Add Product @endslot
    @endcomponent
    @if(session('error'))
    <div class="alert alert-dismissible alert-danger" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data" id="product-form">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="card">
                        <a class="text-dark">
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
                                        <h5 class="font-size-16 mb-1">Product Information</h5>
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
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview1" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label required">Upload Main Image</label>
                                                <input name="image_1" class="form-control @error('image_1') is-invalid @enderror" id="imageInput1" type="file">
                                                @error('image_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
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
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label required" for="name">Product Name</label>
                                                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Product Name" type="text" value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label required" for="description">Description</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter English Description" rows="4">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="choices-single-default" class="form-label required">Category</label>
                                                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $k => $v)
                                                            <option value="{{ $k }}" {{ old('category_id') == $k ? 'selected' : '' }}>{{ $v }}</option>
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
                                                    <label class="form-label required" for="price">Price</label>
                                                    <div class="input-group">
                                                        <div class="input-group-text">RM</div>
                                                        <input class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="e.g. 388.50" type="number" step=".01" value="{{ old('price') }}">
                                                        @error('price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
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
                                            <div class="col-lg-6">
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
                                        </div>
                                    </div>
                                    <div class="col-lg-6 row">
                                        {{-- <div class="mb-3">
                                            <label for="mainImage" class="form-label required">Select Main Image</label>
                                            <select name="main_image_index" class="form-select">
                                                <option value="1">Image 1</option>
                                                <option value="2">Image 2</option>
                                                <option value="3">Image 3</option>
                                                <option value="4">Image 4</option>
                                                <option value="5">Image 5</option>
                                            </select>
                                        </div> --}}

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview2" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 2</label>
                                                <input name="image_2" class="form-control @error('image_2') is-invalid @enderror" id="imageInput2" type="file">
                                                @error('image_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview3" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 3</label>
                                                <input name="image_3" class="form-control @error('image_3') is-invalid @enderror" id="imageInput3" type="file">
                                                @error('image_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview4" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 4</label>
                                                <input name="image_4" class="form-control @error('image_4') is-invalid @enderror" id="imageInput4" type="file">
                                                @error('image_4')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview5" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 5</label>
                                                <input name="image_5" class="form-control @error('image_5') is-invalid @enderror" id="imageInput5" type="file">
                                                @error('image_5')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- If user needs more pictures, can uncomment below -->
                                        {{-- <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview5" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 6</label>
                                                <input name="image_6" class="form-control @error('image_6') is-invalid @enderror" id="imageInput6" type="file">
                                                @error('image_6')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview5" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 7</label>
                                                <input name="image_7" class="form-control @error('image_7') is-invalid @enderror" id="imageInput7" type="file">
                                                @error('image_7')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview5" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 8</label>
                                                <input name="image_8" class="form-control @error('image_8') is-invalid @enderror" id="imageInput8" type="file">
                                                @error('image_8')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview5" style="height: 280px" src="{{ asset('/images/products/no_image.jpg') }}" alt="">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 9</label>
                                                <input name="image_9" class="form-control @error('image_9') is-invalid @enderror" id="imageInput9" type="file">
                                                @error('image_9')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="card">
                        <a>
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
                                        <h5 class="font-size-16 mb-1">Sales Information</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="addproduct-img-collapse" data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top"> --}}
                                {{-- <div class="mt-4 mt-xl-0">
                                    <div class="mt-4">
                                        <label for="formFile" class="form-label required">Upload Main Image</label>
                                        <input name="image_1" class="form-control @error('image_1') is-invalid @enderror" type="file" id="formFile" value="{{ old('image_1') }}">
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
                                </div> --}}
                            {{-- </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-end">

                <button type="button" id="save-button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i class=" bx bx-file me-1"></i> Save </button>
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
        const imageInput1 = document.getElementById('imageInput1');
        const imagePreview1 = document.getElementById('imagePreview1');
        const imageInput2 = document.getElementById('imageInput2');
        const imagePreview2 = document.getElementById('imagePreview2');
        const imageInput3 = document.getElementById('imageInput3');
        const imagePreview3 = document.getElementById('imagePreview3');
        const imageInput4 = document.getElementById('imageInput4');
        const imagePreview4 = document.getElementById('imagePreview4');
        const imageInput5 = document.getElementById('imageInput5');
        const imagePreview5 = document.getElementById('imagePreview5');

        imageInput1.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview1.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
        imageInput2.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview2.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
        imageInput3.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview3.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
        imageInput4.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview4.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
        imageInput5.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview5.src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });

        // Repeat the above code for imageInput2, imageInput3, imageInput4, and imageInput5
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const saveButton = document.getElementById("save-button");
            const productForm = document.getElementById("product-form");

            saveButton.addEventListener("click", function () {
                Swal.fire({
                    title: 'Confirm',
                    text: 'Are you sure you want to add this product?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form
                        productForm.submit();
                    }
                });
            });
        });
    </script>

@endsection
