<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ $url }}">{{ $li_1 }}</a></li>
                    @if(isset($li_2) && isset($url2))
                        <li class="breadcrumb-item"><a href="{{ $url2 }}">{{ $li_2 }}</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    @else
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
