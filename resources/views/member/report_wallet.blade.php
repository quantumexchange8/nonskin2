@extends('layouts.master')
@section('title') Wallet Report @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Home @endslot
    @slot('title') Wallet Report @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
