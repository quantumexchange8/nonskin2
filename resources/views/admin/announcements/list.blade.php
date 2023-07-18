@extends('layouts.master')
@section('title')
    Announcement
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            Announcement
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Announcement Listing</h4>
                            {{-- <button class="btn btn-m btn-success"><i class='bx bx-plus-circle'></i> Add Announcement</button> --}}
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
                                @if (isset($announcements))
                                @foreach ($announcements as $k => $v)
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
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="7">No data available</td>
                                </tr>
                                @endif
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
