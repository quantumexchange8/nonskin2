@extends('layouts.master')
@section('title') New Internal Transfer @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Home @endslot
    @slot('title') New Internal Transfer @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
