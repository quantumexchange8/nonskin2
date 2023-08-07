@extends('layouts.master')
@section('title') Wallet Deposit @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Wallet Deposit @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
