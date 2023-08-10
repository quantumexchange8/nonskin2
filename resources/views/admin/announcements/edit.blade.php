@extends('layouts.master')
@section('title') Edit Announcement @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('url') {{ url('/') }} @endslot
    @slot('li_1') Home @endslot
    @slot('title') Edit Announcement @endslot
    @endcomponent

    <form action="{{ route('announcements.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="card">
                        <a class="text-dark">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Announcement Info</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="addproduct-productinfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="id" value="{{ $announcement->id }}">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label required" for="title">Title</label>
                                                <input class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="e.g. 50% OFF For The Whole Week" type="text" value="{{ $announcement->title }}">
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label required" for="content">Content</label>
                                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="Enter the content for the announcement" rows="6">{{ $announcement->content }}</textarea>
                                                @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <div class="mt-4">
                                                    <label for="image" class="form-label">Upload Announcement Image</label>
                                                    <input class="form-control" type="file" name="image" id="image">
                                                    @if ($announcement->image)
                                                        <div class="mt-1">{{ $announcement->image }}</div>
                                                    @endif
                                                </div>
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <div class="mt-4">
                                                    <label class="form-label row mx-auto">Image Preview</label>
                                                    @if ($announcement?->image)
                                                        <img class="img-fluid" src="{{ asset('images/announcements/' . $announcement->image) }}" style="height: 600px" alt="{{ $announcement->title }}">
                                                    @else
                                                    <div class="mt-1">No image available</div>
                                                    @endif
                                                </div>
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label class="form-label required" for="status">Status</label>
                                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                                    <option value="1" {{ $announcement->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $announcement->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="start_date" class="form-label required">Start Date</label>
                                                <div class="md-10">
                                                    <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $announcement->start_date }}">
                                                </div>
                                                @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="end_date" class="form-label required">End Date</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $announcement->end_date }}">
                                                </div>
                                                @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="status">Popup</label>
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" name="popup" id="popup" {{ $announcement->popup == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="popup" id="popupDisplay">{{ $announcement->popup == 1 ? 'Enabled' : 'Disabled' }}</label>
                                                </div>
                                                @error('popup')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="status">Popup Once</label>
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" name="popup_once" id="popupOnce" {{ $announcement->popup_once == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="popup_once" id="popupOnceDisplay">{{ $announcement->popup_once == 1 ? 'Enabled' : 'Disabled' }}</label>
                                                </div>
                                                @error('popup_once')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-end">

                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i class=" bx bx-file me-1"></i> Save </button>
            </div> <!-- end col -->
        </div>
    </form>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        const checkboxPopup = document.getElementById('popup');
        const popupStatus = document.getElementById('popupDisplay');
        const checkboxPopupOnce = document.getElementById('popupOnce');
        const popupOnceStatus = document.getElementById('popupOnceDisplay');

        checkboxPopup.addEventListener('change', function() {
            popupStatus.textContent = this.checked ? 'Enabled' : 'Disabled';
        });
        checkboxPopupOnce.addEventListener('change', function() {
            popupOnceStatus.textContent = this.checked ? 'Enabled' : 'Disabled';
        });
    </script>
@endsection
