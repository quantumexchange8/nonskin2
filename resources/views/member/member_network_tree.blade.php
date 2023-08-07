@extends('layouts.master')
@section('title') Member Network Tree @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Member Network Tree @endslot
    @endcomponent

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
