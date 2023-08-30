@extends('layouts.master')
@section('title')
    @lang('translation.Company Info')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ route('admin-dashboard') }} @endslot
        @slot('li_1') @lang('translation.Dashboard') @endslot
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
                        <div class="mb-3 row col-md-12">
                            <label for="example-text-input" class="col-md-3 col-sm-4 col-form-label">Name</label>
                            <div class="col-md-9 col-sm-8">
                                <input class="form-control @error('description') is-invalid @enderror" name="name" type="text" value="{{ $info->name }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row col-md-12">
                            <label for="example-text-input" class="col-md-3 col-sm-4 col-form-label">Contact</label>
                            <div class="col-md-9 col-sm-8">
                                <input class="form-control @error('description') is-invalid @enderror" name="contact" type="text" value="{{ $info->contact }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row col-md-12">
                            <label for="example-text-input" class="col-md-3 col-sm-4 col-form-label">Company Registration No.</label>
                            <div class="col-md-9 col-sm-8">
                                <input class="form-control @error('description') is-invalid @enderror" name="register_no" type="text" value="{{ $info->register_no }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row col-md-12">
                            <label for="example-text-input" class="col-md-3 col-sm-4 col-form-label">Address</label>
                            <div class="col-md-9 col-sm-8">
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Enter Address" rows="4">{{ $info->address }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row col-md-12">
                            <label for="example-text-input" class="col-md-3 col-sm-4 col-form-label">Description</label>
                            <div class="col-md-9 col-sm-8">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Description" rows="4">{{ $info->description }}</textarea>
                            </div>
                        </div>

                        <div class="mt-3 row">
                            <h2 class="col-md-3 col-form-label fw-bold font-size-20 py-0">Bank Name</h2>
                            <div class="col-lg-8 col-md-9">
                                <label class="col-md-3 col-form-label">
                                </label>
                            </div>
                        </div>
                        <hr>

                        <div class="mb-3 row col-md-12">
                            <label for="bank_name" class="col-md-3 col-sm-12 col-form-label">Bank Name</label>
                            <div class="col-md-9 col-sm-12">
                                <select class="form-select" name="bank_name" required>
                                    @foreach ($banks as $bank)
                                        <option class="form-select" {{ $bank->name == $info->bank_name ? 'selected' : '' }} value="{{ $bank->name }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row col-md-12">
                            <label for="bank_holder_name" class="col-md-3 col-sm-12 col-form-label">Bank Holder Name</label>
                            <div class="col-md-9 col-sm-12">
                                <input class="form-control @error('bank_holder_name') is-invalid @enderror" name="bank_holder_name" id="bank_holder_name" placeholder="Enter holder name" rows="4" value="{{ $info->bank_holder_name }}" >
                            </div>
                        </div>
                        <div class="mb-3 row col-md-12">
                            <label for="bank_acc" class="col-md-3 col-sm-12 col-form-label">Bank Account No.</label>
                            <div class="col-md-9 col-sm-12">
                                <input class="form-control @error('bank_acc') is-invalid @enderror" name="bank_acc" id="bank_acc" placeholder="Enter bank account" rows="4" value="{{ $info->bank_acc }}" >
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
