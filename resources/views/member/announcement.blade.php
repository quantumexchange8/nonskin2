@extends('layouts.master')
@section('title') Announcement @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') @lang('translation.Home') @endslot
    @slot('title') Announcement @endslot
    @endcomponent

    @foreach ($announcements as $announcement)
        <div id="announcementModal" class="modal fade" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="announcementModalLabel">Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="card-img-top img-fluid mb-3" src="{{ URL::asset('assets/images/nonskin/non-logo.jpg') }}" alt="{{ $announcement->title }}">
                        <h5>{{ $announcement->title }}</h5>
                        {{ $announcement->content }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        @forelse ($announcements as $announcement)
            <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{ URL::asset('assets/images/nonskin/non-logo.jpg') }}" style="width: 50% !important;" alt="{{ $announcement->title }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $announcement->title }}</h4>
                        <p class="card-text">{{ Str::limit($announcement->content,70,'...') }}</p>
                        <p class="card-text">
                            <small class="text-muted">Updated on <span class="fw-bold">{{ $announcement->created_at->format('d/M/Y, h:m:s') }}</span></small>
                        </p>
                        <div>
                            <button class="btn btn-primary col-md-3" data-bs-toggle="modal" data-bs-target="#announcementModal">View</button>
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
