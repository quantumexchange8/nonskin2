@extends('layouts.master')
@section('title') Announcement @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.Dashboard') @endslot
        @slot('url') {{ route('user-dashboard') }} @endslot
        @slot('title') Announcement @endslot
    @endcomponent

    @foreach ($announcements as $k => $v)
        @include('member.modals.announcement-detail')
    @endforeach
    <div class="row">
        @forelse ($announcements as $k => $v)
            <div class="col-lg-3">
                <div class="card">
                    @if (isset($v->image))
                        <img class="object-fit-cover p-3" src="{{ asset('images/announcements/' . $v->image) }}" style="height: 350px" alt="{{ $v->title }}">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $v->title }}</h4>
                        <p class="card-text">{!! Str::words($v->content,8,'...') !!}</p>
                        <p class="card-text">
                            <small class="text-muted">Updated on <span class="fw-bold">{{ $v->created_at->format('d/M/Y, h:m:s') }}</span></small>
                        </p>
                        <div>
                            <button class="btn btn-primary col-md-3" data-bs-toggle="modal" data-bs-target="#announcementModal{{ $v->id }}">View</button>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-lg-12">
                There is no available announcement currently.
            </div>
        @endforelse
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
