<div id="announcementModal{{ $v->id }}" class="modal fade" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (isset($v->image))
                    <img class="card-img-top img-fluid mb-3 p-1" src="{{ asset('images/announcements/' . $v->image) }}" alt="{{ $v->title }}">
                @endif
                <h5>{{ $v->title }}</h5>
                {{ $v->content }}
            </div>
            <div class="modal-footer">
                @if(request()->route()->getName() == 'member.announcement')
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                @else
                <button type="button" class="btn btn-secondary waves-effect" data-bs-toggle="modal" data-bs-target="#announcementModal">Close</button>
                @endif
            </div>
        </div>
    </div>
</div>
