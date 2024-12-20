@extends('layouts.master')
@section('title')
    Product Listing
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ route('list') }} @endslot
        @slot('li_1') Products @endslot
        @slot('title') Product Listing @endslot
    @endcomponent

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@include('admin.products.modal-update-product')
@if(session('added'))
    <div class="alert alert-dismissible alert-success" role="alert">
        {{ session('added') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
<div class="col-xl-12 col-lg-8">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end pt-2">
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
                                    <th class="text-end">Price</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td><img class="img-fluid" width="60" src="{{ asset('images/products/' . $product->image_1) }}" alt="{{ $product->name_en }}"></td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name_en }}</td>
                                    <td>{{ $product->category->name_en }}</td>
                                    <td>{{ $product->shipping_quantity }}</td>
                                    <td class="text-end">RM {{ number_format($product->price,2,'.',',') }}</td>
                                    <td>{{ number_format($product->discount,1,'.') }} %</td>
                                    <td><span class="badge badge-pill {{ $product->status == 'Active' ? 'badge-soft-success' : 'badge-soft-danger' }}">{{ $product->status }}</span></td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('edit', $product->id) }}" class="text-success" data-bs-placement="top" data-bs-toggle="tooltip" title="Edit" data-bs-original-title="Edit">
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
