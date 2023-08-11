@extends('layouts.master')
@section('title')
    @lang('translation.Banks Setting')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') @lang('translation.Home') @endslot
        @slot('title') @lang('translation.Banks Setting') @endslot
    @endcomponent

    @include('includes.alerts')

    @section('modal')
        @include('admin.settings.modal-add-bank')
        @foreach ($banks as $k => $v)
            @include('admin.settings.modal-update-bank')
        @endforeach
    @endsection

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end pt-2">
                        <button data-bs-toggle="modal" data-bs-target="#addBank" type="submit" class="btn btn-primary"><i class='bx bx-plus-circle' ></i> @lang('translation.add bank')</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('translation.name')</th>
                                    <th>@lang('translation.last updated at')</th>
                                    <th>@lang('translation.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banks as $k => $v)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $v->name }}</td>
                                        <td>{{ $v->updated_at->format('d/m/Y, h:i:s') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#updateBank{{ $v->id }}" class="btn btn-sm btn-soft-primary waves-effect waves-light bx bx-edit font-size-14 align-middle"></a>
                                                <form method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('admin.settings.bank-destroy', $v->id) }}" data-confirm-delete="true" class="btn btn-sm btn-soft-danger waves-effect waves-light bx bxs-trash font-size-14 align-middle"></a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="100%">@lang('translation.no data available')</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
