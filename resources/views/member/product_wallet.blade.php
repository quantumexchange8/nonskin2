@extends('layouts.master')
@section('title') Product Wallet @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Product Wallet @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="productWallet" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Payment ID</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Receipt</th>
                                <th>Amount (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($orders as $order) --}}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        new DataTable('#productWallet', {
            responsive: true,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
