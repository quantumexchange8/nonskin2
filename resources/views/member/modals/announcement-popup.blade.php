<div class="modal show" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">@lang('translation.Announcement')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($announcements as $row)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="btn mb-0 text-white"> <a href="" data-bs-toggle="modal"
                                        data-bs-target="#announcementModal{{ $row['id'] }}">{{ $row['title'] }}</a>
                                </h5>
                            </div>
                            <hr />
                            <div>
                                <img class="card-img-top img-fluid mb-3 p-1"
                                    src="{{ asset('images/announcements/' . $row['image']) }}"
                                    alt="{{ $row['title'] }}">
                                <p class="card-text">{!! $row['content'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{ route('member.announcement') }}">@lang('translation.View All Announcement')</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('translation.close')</button>
            </div>
        </div>
    </div>
</div>
