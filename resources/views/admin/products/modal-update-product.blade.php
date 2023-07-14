<!-- Extra Large modal button -->

<!--  Extra Large modal example -->
<div class="modal fade modal-update-product" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post">
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
                                                        <label class="form-label" for="name-en">Product Name (EN)</label>
                                                        <input id="name-en" name="name_en" placeholder="Enter Product Name" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="name-cn">Product Name (CN)</label>
                                                        <input id="name-cn" name="name_cn" placeholder="Enter Product Name" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="desc-en">Description (EN)</label>
                                                        <textarea class="form-control" id="desc_en" placeholder="Enter English Description" rows="4"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="desc-cn">Description (CN)</label>
                                                        <textarea class="form-control" name="desc_cn" id="desc-cn" placeholder="Enter Chinese Description" rows="4"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="choices-single-default" class="form-label">Category</label>
                                                        <select class="form-control" name="category_id"
                                                            id="category">
                                                            <option value="{{ null }}">Select Category</option>
                                                            <option value="1">Retail Products</option>
                                                            <option value="2">Package</option>
                                                            <option value="3">Mask</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="shipping_quantity">Shipping Quantity</label>
                                                        <input id="shipping_quantity" name="shipping_quantity" placeholder="e.g. 2" type="number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="price">Price</label>
                                                        <div class="input-group">
                                                            <div class="input-group-text">RM</div>
                                                            <input id="price" name="price" placeholder="e.g. 388.50" type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-img-collapse">
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
                                                    <label for="formFile" class="form-label">Upload Main Image</label>
                                                    <input class="form-control" type="file" id="formFile">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mt-4 mt-xl-0">
                                                        <div class="mt-4">
                                                            <label for="formFile" class="form-label">Upload Image 2</label>
                                                            <input class="form-control" type="file" id="formFile">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mt-4 mt-xl-0">
                                                        <div class="mt-4">
                                                            <label for="formFile" class="form-label">Upload Image 3</label>
                                                            <input class="form-control" type="file" id="formFile">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mt-4 mt-xl-0">
                                                        <div class="mt-4">
                                                            <label for="formFile" class="form-label">Upload Image 4</label>
                                                            <input class="form-control" type="file" id="formFile">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mt-4 mt-xl-0">
                                                        <div class="mt-4">
                                                            <label for="formFile" class="form-label">Upload Image 5</label>
                                                            <input class="form-control" type="file" id="formFile">
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
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
