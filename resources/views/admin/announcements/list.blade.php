@extends('layouts.master')
@section('title')
    Announcement Listing
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('url') {{ url('/') }} @endslot
        @slot('li_1') Home @endslot
        @slot('title') Announcement Listing @endslot
    @endcomponent

    @include('includes.alerts')

    @section('modal')
        @foreach ($announcements as $k => $v)
            @include('member.modals.announcement-detail')
        @endforeach
    @endsection
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="announcementsTable" class="stripe nowrap" style="width:100">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Image</td>
                                <td>Title</td>
                                <td>Content</td>
                                <td>Status</td>
                                <td>Popup</td>
                                <td>Popup Once</td>
                                <td>Last Updated By</td>
                                <td>View Details</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($announcements as $k => $v)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img class="object-fit-cover" src="{{ asset('images/announcements/' . $v->image) }}" style="height: 80px" alt="{{ Str::words($v->title,1) }}"></td>
                                <td>{{ $v->title }}</td>
                                <td>{{ Str::limit($v->content, 50) }}</td>
                                <td>
                                    @if($v->status == 1)
                                    <span class="badge badge-pill badge-soft-success font-size-12">
                                        Active
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-soft-danger font-size-12">
                                        Inactive
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($v->popup == 1)
                                    <span class="badge badge-pill badge-soft-primary font-size-12">
                                        Enabled
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-soft-warning font-size-12">
                                        Disabled
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($v->popup_once == 1)
                                    <span class="badge badge-pill badge-soft-primary font-size-12">
                                        Enabled
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-soft-warning font-size-12">
                                        Disabled
                                    </span>
                                    @endif
                                </td>
                                <td>{{ $v->user->name }} - {{ $v->updated_at->format('d/m/Y, h:m:s') }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-rounded view-detail-button" data-bs-toggle="modal" data-bs-target="#announcementModal{{ $v->id }}">
                                        View Details
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('announcements.edit', $v->id) }}"><i class="mdi mdi-pencil font-size-18"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        new DataTable('#announcementsTable', {
            responsive: true,
            pagingType: 'simple_numbers'
        });
    </script>
@endsection
