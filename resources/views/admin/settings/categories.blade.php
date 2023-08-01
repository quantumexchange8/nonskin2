@extends('layouts.master')
@section('title')
    @lang('translation.Product Categories Setting')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') @lang('translation.Home') @endslot
        @slot('title') @lang('translation.Product Categories Setting') @endslot
    @endcomponent

<!--  Large modal example -->
    @foreach ($categories as $k => $v)
    <div class="modal fade" id="updateCategory{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryModalLabel">Add Category</h5>
                    @if ($v->id)
                    <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name (EN)</label>
                                    <input type="text" class="form-control" name="name_en" id="validationCustom01" placeholder="Enter Category Name in English" value="{{ $v->name_en }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Name(CN)</label>
                                    <input type="text" class="form-control" name="name_cn" id="validationCustom02" placeholder="Enter Category Name in Chinese" value="{{ $v->name_cn }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Status</label>
                                    <select class="form-select" name="status" id="validationCustom03" placeholder="Select Status">
                                        <option value="Active" {{ $v->status == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ $v->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid city.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom04">Remarks <small class="text-muted">(Leave empty if unnecessary)</small></label>
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="Nonskin" value="{{ $v->remarks }}" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end pt-2">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateCategory"><i class='bx bx-plus-circle' ></i> @lang('translation.add category')</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('translation.name_en')</th>
                                    <th>@lang('translation.name_cn')</th>
                                    <th>@lang('translation.status')</th>
                                    <th>@lang('translation.remarks')</th>
                                    <th>@lang('translation.created at')</th>
                                    <th>@lang('translation.created by')</th>
                                    <th>@lang('translation.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $k => $v)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $v->name_en }}</td>
                                        <td>{{ $v->name_cn }}</td>
                                        <td>
                                            @if($v->status == 'Active')
                                            <span class="badge badge-soft-success font-size-12">@lang('translation.active')</span>
                                            @else
                                            <span class="badge badge-soft-danger font-size-12">@lang('translation.inactive')</span>
                                            @endif
                                        </td>
                                        <td>{{ $v->remarks }}</td>
                                        <td>{{ $v->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $v->user->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#updateCategory{{ $v->id }}" class="btn btn-sm btn-soft-primary waves-effect waves-light"><i class="bx bx-edit font-size-14 align-middle"></i></a>
                                                <a href="" class="btn btn-sm btn-soft-danger waves-effect waves-light"><i class="bx bxs-trash font-size-14 align-middle"></i></a>
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
