<div id="announcementModal{{ $v->id }}" class="modal fade" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="card-img-top img-fluid mb-3 p-1" src="{{ asset('images/announcements/' . $v->image) }}" alt="{{ $v->title }}">
                <h5>{{ $v->title }}</h5>
                {{ $v->content }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
