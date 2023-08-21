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

    @include('includes.alerts')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.settings.company-info-store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $info->id }}">
                        <div class="mb-3 row col-md-6">
                            <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control @error('description') is-invalid @enderror" name="name" type="text" value="{{ $info->name }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row col-md-6">
                            <label for="example-text-input" class="col-md-2 col-form-label">Contact</label>
                            <div class="col-md-10">
                                <input class="form-control @error('description') is-invalid @enderror" name="contact" type="text" value="{{ $info->contact }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row col-md-6">
                            <label for="example-text-input" class="col-md-2 col-form-label">Company Registration No.</label>
                            <div class="col-md-10">
                                <input class="form-control @error('description') is-invalid @enderror" name="register_no" type="text" value="{{ $info->register_no }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row col-md-6">
                            <label for="example-text-input" class="col-md-2 col-form-label">Address</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address" rows="4">{{ $info->address }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row col-md-6">
                            <label for="example-text-input" class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Description" rows="4">{{ $info->description }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">@lang('translation.save changes')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
    {{-- <script>
        ClassicEditor
        .create( document.querySelector( '#address' ) )
        .then( function(editor) {
            editor.ui.view.editable.element.style.height = '200px';
        } )
        .catch( function(error) {
            console.error( error );
        } );
    </script> --}}
    <script>
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .then( function(editor) {
            editor.ui.view.editable.element.style.height = '200px';
        } )
        .catch( function(error) {
            console.error( error );
        } );
    </script>
@endsection
