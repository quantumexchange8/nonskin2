@extends('layouts.master')
@section('title') Commission @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Commission @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <table id="commissionTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Transaction ID</td>
                                            <td>Billing Name</td>
                                            <td>Date</td>
                                            <td>Total</td>
                                            <td>Payment Status</td>
                                            <td>Payment Method</td>
                                            <td>View Details</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <span data-bs-toggle="modal" data-bs-target=".orderdetailsModal"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-bs-original-title="View" class="text-primary"><i class="mdi mdi-eye-outline font-size-18"></i></a></span>
                                                    {{-- <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-bs-original-title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a> --}}
                                                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2">Product Id: <span class="text-primary">#SK2540</span></p>
                                    <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap">
                                            <thead>
                                                <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <img src="{{ URL::asset('assets/images/product/img-1.png') }}" alt="" class="avatar-md">
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14">Nike N012 Shoes</h5>
                                                            <p class="text-muted mb-0">$ 225 x 1</p>
                                                        </div>
                                                    </td>
                                                    <td>$ 255</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <img src="{{ URL::asset('assets/images/product/img-4.png') }}" alt="" class="avatar-md">
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14">Sports S120 Shoes</h5>
                                                            <p class="text-muted mb-0">$ 145 x 1</p>
                                                        </div>
                                                    </td>
                                                    <td>$ 145</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                                    </td>
                                                    <td>
                                                        $ 400
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <h6 class="m-0 text-right">Shipping:</h6>
                                                    </td>
                                                    <td>
                                                        Free
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <h6 class="m-0 text-right">Total:</h6>
                                                    </td>
                                                    <td>
                                                        $ 400
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    <script>
        new DataTable('#commissionTable', {
            responsive: true,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
