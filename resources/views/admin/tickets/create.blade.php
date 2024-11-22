@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-danger shadow">
        <div class="container">
            <h1>
                <strong>
                    Create a new Ticket.
                </strong>
            </h1>
        </div>
    </header>
    <div class="container py-5">
        @include('partials.validation-message')
        <form action="{{ route('admin.tickets.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="titleHelpId" placeholder="New Ticket" value="{{ old('title') }}" />
                <small id="titleHelpId" class="form-text text-muted">Insert a title</small>
                @error('title')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="mb-3 py-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                    <option selected disabled>Select one</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div> --}}
            {{-- <div class="d-flex flex-wrap py-3">
                @foreach ($technologies as $technology)
                    <div class="form-check col-2">
                        <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox"
                            value="{{ $technology->id }}" id="tech-{{ $technology->id }}" name="technologies[]"
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                        <label class="form-check-label px-3" for="tech-{{ $technology->id }}"> {{ $technology->name }}
                        </label>
                    </div>
                    <div class="px-3">
                        |
                    </div>
                @endforeach
                @error('technologies')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div> --}}
            {{-- <div class="mb-3">
                <label for="url1" class="form-label">GitHub link</label>
                <input type="text" class="form-control @error('url1') is-invalid @enderror" name="url1" id="url1"
                    aria-describedby="url1HelpId" placeholder="New Project" value="{{ old('url1') }}" />
                <small id="url1HelpId" class="form-text text-muted">Insert a link</small>
                @error('url1')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div> --}}
            {{-- <div class="mb-3">
                <label for="url2" class="form-label">Preview link</label>
                <input type="text" class="form-control @error('url2') is-invalid @enderror" name="url2" id="url2"
                    aria-describedby="url2HelpId" placeholder="New Project" value="{{ old('url2') }}" />
                <small id="url2HelpId" class="form-text text-muted">Insert a link</small>
                @error('url2')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div> --}}
            {{-- <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control @error('img') is-invalid @enderror" name="img" id="img"
                    aria-describedby="imgHelpId" placeholder="New image for project" value="" />
                <small id="imgHelpId" class="form-text text-muted">Insert an image</small>
                @error('img')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="6" placeholder="Insert your description here..">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-dark text-success">
                    <i class="fa-solid fa-plus fa-lg fa-fw"></i>
                    <span class="fw-bold px-1">
                        CREATE
                    </span>
                </button>
                <div class="px-3">
                    <a class="btn btn-dark text-danger" href="{{ route('admin.tickets.index') }}">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span class="px-2 fw-bold">
                            CANCEL AND BACK TO TICKETS
                        </span>
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
