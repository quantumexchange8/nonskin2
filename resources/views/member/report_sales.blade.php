@extends('layouts.master')
@section('title') Sales Report @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Sales Report @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="reportSales" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_num }}</td>
                                    <td>RM {{ number_format($order->total_amount,2) }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y, h:i:s') }}</td>
                                </tr>
                            @endforeach
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
        new DataTable('#reportSales', {
            responsive: true,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
