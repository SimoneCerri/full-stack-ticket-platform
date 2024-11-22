@if (Str::contains(session('status'), 'Deleted'))
    <div class="alert alert-danger d-flex align-items-center justify-content-between">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (Str::contains(session('status'), 'updated'))
    <div class="alert alert-success d-flex align-items-center justify-content-between">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (Str::contains(session('status'), 'Add'))
    <div class="alert alert-success d-flex align-items-center justify-content-between">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
