@extends('layouts.master')
@section('title')
    @lang('translation.Company Info')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') @lang('translation.Home') @endslot
        @slot('title') @lang('translation.Company Info') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        @foreach($infos as $info)
                            <div class="mb-3 row col-md-6">
                                <label for="example-text-input" class="col-md-2 col-form-label">{{ $info->key }}</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{ $info->value }}" id="example-text-input">
                                </div>
                            </div>
                        @endforeach
                        <div class="mb-3">
                            <button class="btn btn-primary">@lang('translation.save changes')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
