@extends('layouts.master')
@section('title') Checkout @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Checkout @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Checkout</h4>
                    {{-- <p class="card-title-desc">
                        Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>
                        to make them scroll horizontally on small devices (under 768px).
                    </p> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Qty.</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $k => $v)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>Image Unavailable</td>
                                        <td>{{ $v->product->code }}</td>
                                        <td>{{ $v->product->name_en }}</td>
                                        <td>{{ $v->quantity }}</td>
                                        <td>RM {{ number_format($v->price, 2,'.',',') }}</td>
                                        <td>Table cell</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Payment:</td>
                                    <td>Table cell</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
