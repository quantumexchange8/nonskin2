@extends('layouts.master')
@section('title') Member Tree @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Home @endslot
    @slot('title') Member Tree @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
