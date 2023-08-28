@extends('layouts.master')
@section('title') @lang('translation.Downline Sales') @lang('translation.Report') @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/members/dashboard') }} @endslot
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('title') @lang('translation.Downline Sales') @lang('translation.Report') @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="reportDownlineSales" class="stripe nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Member Name</th>
                                <th>Price (RM)</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @foreach ($user->orders as $order)
                                <tr>
                                    <td>{{ $order->order_num }}</td>
                                    <td>{{ $user->referrer_id }} | {{ $user->full_name }}</td>
                                    <td>{{ number_format($order->total_amount,2) }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y, h:i:s') }}</td>
                                    {{-- <td>{{ $user->orders }}</td> --}}
                                    {{-- <td>RM {{ number_format($user->orders->total_amount,2) }}</td> --}}
                                    {{-- <td>{{ $user->orders->created_at->format('d/m/Y, h:i:s') }}</td> --}}
                                </tr>
                                @endforeach
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
        new DataTable('#reportDownlineSales', {
            responsive: true,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
