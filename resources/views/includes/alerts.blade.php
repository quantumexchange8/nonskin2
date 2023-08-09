@if(session('created'))
    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Create successful</strong> - {{ session('created') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('updated'))
    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Update Successful</strong> - {{ session('updated') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('message'))
    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Update Successful</strong> - {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('deleted'))
    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Delete Successful</strong> - {{ session('deleted') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> - {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@error('username')
    <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Error</strong> - {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror
