@extends('layouts.master')
@section('title') Pending Topup @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Home @endslot
    @slot('title') Pending Topup @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
