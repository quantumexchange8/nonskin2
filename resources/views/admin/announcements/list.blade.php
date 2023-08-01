@extends('layouts.master')
@section('title')
    Announcement List
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Announcement List @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="row mb-50">
                            <div class="col-sm mr-n15">
                                <label for="tradingAccount" class="form-label">@lang('translation.status')</label>
                                <select class="form-select" name="status">
                                    <option selected disabled>@lang('translation.select status')</option>
                                    <option value="Active">@lang('translation.active')</option>
                                    <option value="Inactive">@lang('translation.inactive')</option>
                                </select>
                            </div>
                            <div class="col-sm mr-n15">
                                <label for="From Date" class="form-label">@lang('translation.from date')</label>
                                <input type="date" class="form-control rounded" id="datepicker3" placeholder="@lang('translation.from date')" name="start_date">
                            </div>
                            <div class="col-sm">
                                <label for="To Date" class="form-label">@lang('translation.to date')</label>
                                <input type="date" class="form-control rounded" id="datepicker4" placeholder="@lang('translation.to date')" name="end_date">
                            </div>
                            <div class="col-sm">
                                <label for="Search" class="form-label">&nbsp;</label>
                                <button type="submit" class="w-100 btn btn-primary">@lang('translation.search')</button>
                            </div>

                        </div>
                    </div>
                    {{-- <p class="card-title-desc">
                        Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive</code>
                        to make them scroll horizontally on small devices (under 768px).
                    </p> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Popup</th>
                                    <th>Popup Once</th>
                                    <th>Date Announced</th>
                                    <th>Announced By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($announcements as $k => $v)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $v->title }}</td>
                                        <td>{{ $v->content }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" {{ $v->status == 1 ? 'checked' : '' }} disabled>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" {{ $v->popup == 1 ? 'checked' : '' }} disabled>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" {{ $v->popup_once == 1 ? 'checked' : '' }} disabled>
                                            </div>
                                        </td>
                                        <td>{{ $v->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $v->user->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="" class="btn btn-sm btn-soft-dark waves-effect waves-light"><i class="bx bx-detail font-size-14 align-middle"></i></a>
                                                &nbsp;
                                                <a href="" class="btn btn-sm btn-soft-primary waves-effect waves-light"><i class="bx bx-edit font-size-14 align-middle"></i></a>
                                                &nbsp;
                                                <a href="" class="btn btn-sm btn-soft-danger waves-effect waves-light"><i class="bx bxs-trash font-size-14 align-middle"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="100%">No data available</td>
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
