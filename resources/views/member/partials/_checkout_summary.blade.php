<div class="card-body ">
    <div class="p-3 bg-light mb-4">
        <h5 class="font-size-16 mb-0">Order Summary <span class="float-end ms-2">#MN0124</span></h5>
    </div>
    <div class="table-responsive">
        <table class="table table-centered mb-0 table-nowrap">
            <thead>
                <tr>
                    <th class="border-top-0" style="width: 110px;" scope="col">Product</th>
                    <th class="border-top-0" scope="col">Product Desc</th>
                    <th class="border-top-0" scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><img src="{{ URL::asset('assets/images/product/img-1.png') }}"
                            alt="product-img" title="product-img" class="avatar-md"></th>
                    <td>
                        <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail"
                                class="text-dark">Nike N012 Running Shoes</a></h5>
                        <p class="text-muted mb-0">$ 260 x 2</p>
                    </td>
                    <td>$ 520</td>
                </tr>
                <tr>
                    <th scope="row"><img src="{{ URL::asset('assets/images/product/img-2.png') }}"
                            alt="product-img" title="product-img" class="avatar-md"></th>
                    <td>
                        <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail"
                                class="text-dark">Adidas Running Shoes</a></h5>
                        <p class="text-muted mb-0">$ 260 x 1</p>
                    </td>
                    <td>$ 260</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Sub Total :</h5>
                    </td>
                    <td> $ 780 </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Discount :</h5>
                    </td>
                    <td> - $ 78 </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Shipping Charge :</h5>
                    </td>
                    <td> $ 25 </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Estimated Tax :</h5>
                    </td>
                    <td> $ 18.20 </td>
                </tr>

                <tr class="bg-light">
                    <td colspan="2">
                        <h5 class="font-size-14 m-0">Total:</h5>
                    </td>
                    <td> $ 745.2 </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row my-4">
        <div class="col">
            <a href="{{ route('products.index') }}" class="btn btn-link text-muted">
                <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
        </div> <!-- end col -->
        <div class="col">
            <div class="text-end mt-2 mt-sm-0">
                <a href="#" class="btn btn-success">
                    <i class="mdi mdi-cart-outline me-1"></i> Place Order </a>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row-->
</div>
