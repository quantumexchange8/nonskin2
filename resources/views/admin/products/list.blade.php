@extends('layouts.master')
@section('title')
    Product List
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('admin.products.list') }} @endslot
        @slot('li_1') Products @endslot
        @slot('title') Product List @endslot
    @endcomponent

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@include('admin.products.modal-update-product')

<div class="col-xl-12 col-lg-8">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="modal-button mt-2">
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#updateProduct"><i class="mdi mdi-plus me-1"></i> Add New Product</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Shipping Qty.</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td><img class="img-fluid" width="60" src="{{ asset('images/' . $product->image_1) }}" alt="{{ $product->name_en }}"></td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name_en }}</td>
                                    <td>{{ $product->category->name_en }}</td>
                                    <td>{{ $product->shipping_quantity }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->status }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-primary" data-bs-placement="top" title="View" data-bs-original-title="View">
                                                <i class="mdi mdi-eye-outline font-size-18"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-success" data-bs-placement="top" title="Edit" data-bs-original-title="Edit">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" data-product-id="{{ $product->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100%">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
