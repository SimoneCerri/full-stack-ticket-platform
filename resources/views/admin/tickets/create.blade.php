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
            {{-- ADD CATEGORIES OPERATORS STATUS --}}
            <div class="mb-3 py-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    <option selected disabled>Select one</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('type_id') ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3 py-3">
                <label for="operator_id" class="form-label">Operator</label>
                <select class="form-select @error('operator_id') is-invalid @enderror" name="operator_id" id="operator_id">
                    <option selected disabled>Select one</option>
                    @foreach ($operators as $operator)
                        <option value="{{ $operator->id }}" {{ $operator->id == old('type_id') ? 'selected' : '' }}>
                            {{ $operator->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="text-danger py-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 py-3">
                <label for="status" class="form-label">Select a status</label>
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                    <option selected disabled>Select one</option>
                    @foreach ($states as $state)
                        <option value="{{ $state }}" {{ $state == old('type_id') ? 'selected' : '' }}>
                            {{ $state }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
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
