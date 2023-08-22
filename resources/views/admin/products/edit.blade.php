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
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview1" style="height: 280px" src="{{ asset('images/products/' . ($product->image_1 ?? 'no_image.jpg')) }}" alt="Image 1 of Product">
                                                <br>
                                                <label for="formFile" class="form-label required">Upload Main Image</label>
                                                <div class="input-group">
                                                    <input name="image_1" class="form-control @error('image_1') is-invalid @enderror" id="imageInput1" type="file">
                                                    @if ($product->image_1)
                                                        <a href="{{ route('remove-picture', ['product' => $product->id, 'imageNumber' => 1]) }}" role="button" class="btn btn-danger" id="remove" data-confirm-delete="true">Remove </a>
                                                    @endif
                                                </div>
                                                @if ($product->image_1)
                                                    <div>Current image: {{ $product->image_1 }}</div>
                                                @endif
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
                                                <input class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="e.g Br2" type="text" value="{{ $product->code }}">
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
                                                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Product Name" type="text" value="{{ $product->name }}">
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
                                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter English Description" rows="4">{{ $product->description }}</textarea>
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
                                                            <option value="{{ $k }}" {{ $product->category_id == $k ? 'selected' : '' }}>{{ $v }}</option>
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
                                                        <input class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="e.g. 388.50" type="number" step=".01" value="{{ $product->price }}">
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
                                            <div class="col-lg-6">
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
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview2" style="height: 280px" src="{{ asset('images/products/' . ($product->image_2 ?? 'no_image.jpg')) }}" alt="Image 2 of Product">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 2</label>
                                                <div class="input-group">
                                                    <input name="image_2" class="form-control @error('image_2') is-invalid @enderror" id="imageInput2" type="file">
                                                    @if ($product->image_2)
                                                        <a href="{{ route('remove-picture', ['product' => $product->id, 'imageNumber' => 2]) }}" role="button" class="btn btn-danger" id="remove" data-confirm-delete="true">Remove </a>
                                                    @endif
                                                </div>
                                                @if ($product->image_2)
                                                    <div>Current image: {{ $product->image_2 }}</div>
                                                @endif
                                                @error('image_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview3" style="height: 280px" src="{{ asset('images/products/' . ($product->image_3 ?? 'no_image.jpg')) }}" alt="Image 3 of Product">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 3</label>
                                                <div class="input-group">
                                                    <input name="image_3" class="form-control @error('image_3') is-invalid @enderror" id="imageInput3" type="file">
                                                    @if ($product->image_3)
                                                        <a href="{{ route('remove-picture', ['product' => $product->id, 'imageNumber' => 3]) }}" role="button" class="btn btn-danger" id="remove" data-confirm-delete="true">Remove </a>
                                                    @endif
                                                </div>
                                                @if ($product->image_3)
                                                    <div>Current image: {{ $product->image_3 }}</div>
                                                @endif
                                                @error('image_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview4" style="height: 280px" src="{{ asset('images/products/' . ($product->image_4 ?? 'no_image.jpg')) }}" alt="Image 4 of Product">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 4</label>
                                                <div class="input-group">
                                                    <input name="image_4" class="form-control @error('image_4') is-invalid @enderror" id="imageInput4" type="file">
                                                    @if ($product->image_4)
                                                        <a href="{{ route('remove-picture', ['product' => $product->id, 'imageNumber' => 4]) }}" role="button" class="btn btn-danger" id="remove" data-confirm-delete="true">Remove </a>
                                                    @endif
                                                </div>
                                                @if ($product->image_4)
                                                    <div>Current image: {{ $product->image_4 }}</div>
                                                @endif
                                                @error('image_4')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <img class="img-thumbnail object-fit-cover mb-3" id="imagePreview5" style="height: 280px" src="{{ asset('images/products/' . ($product->image_5 ?? 'no_image.jpg')) }}" alt="Image 5 of Product">
                                                <br>
                                                <label for="formFile" class="form-label">Upload Image 5</label>
                                                <div class="input-group">
                                                    <input name="image_5" class="form-control @error('image_5') is-invalid @enderror" id="imageInput5" type="file">
                                                    @if ($product->image_5)
                                                        <a href="{{ route('remove-picture', ['product' => $product->id, 'imageNumber' => 5]) }}" role="button" class="btn btn-danger" id="remove" data-confirm-delete="true">Remove </a>
                                                    @endif
                                                </div>
                                                @if ($product->image_5)
                                                    <div>Current image: {{ $product->image_5 }}</div>
                                                @endif
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
@endsection
