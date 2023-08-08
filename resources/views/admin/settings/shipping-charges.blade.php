@extends('layouts.master')
@section('title')
    @lang('translation.Shipping Charges Setting')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') @lang('translation.Home') @endslot
        @slot('title') @lang('translation.Shipping Charges Setting') @endslot
    @endcomponent

    @include('includes.alerts')

    @section('modal')
        @include('admin.settings.modal-add-charge')
        @foreach ($res as $k => $v)
            @include('admin.settings.modal-update-charge')
        @endforeach
    @endsection

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end pt-2">
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#addCharge" class="btn btn-primary"><i class='bx bx-plus-circle' ></i> @lang('translation.add shipping charge')</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('translation.state name')</th>
                                    <th>@lang('translation.amount')</th>
                                    <th>@lang('translation.created at')</th>
                                    <th>@lang('translation.created by')</th>
                                    <th>@lang('translation.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($res as $k => $v)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $v->name }}</td>
                                        <td>RM {{ number_format($v->amount,2,'.',',') }}</td>
                                        <td>{{ $v->created_at?->format('d/m/Y') }}</td>
                                        <td>{{ $v->updatedBy->name  }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#updateCharge{{ $v->id }}" class="btn btn-sm btn-soft-primary waves-effect waves-light"><i class="bx bx-edit font-size-14 align-middle"></i></a>
                                                <form method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('admin.settings.charge-destroy', $v->id) }}" class="btn btn-sm btn-soft-danger waves-effect waves-light bx bxs-trash font-size-14 align-middle" data-confirm-delete="true"></a>
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
