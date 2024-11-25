@extends('layouts.admin')

@section('content')
    <header>
        <div class="container-fluid bg-dark py-3 text-danger shadow">
            <div class="container d-flex align-items-center justify-content-center">
                <h1 class="text-center">
                    <strong>
                        Edit Ticket - {{ $ticket->title }}
                    </strong>
                </h1>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card p-4">
                    <h5 class="card-title text-center">
                        ID: {{ $ticket->id }}
                    </h5>

                    <!-- Form for Editing Ticket -->
                    <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf

                        <!-- Display Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Title Field -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Ticket Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $ticket->title) }}">
                        </div>

                        <!-- Description Field -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Ticket Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $ticket->description) }}</textarea>
                        </div>

                        <!-- Status Field -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Ticket Status</label>
                            <select name="status" class="form-select">
                                <option value="ASSIGNED"
                                    {{ old('status', $ticket->status) == 'ASSIGNED' ? 'selected' : '' }}>ASSIGNED</option>
                                <option value="IN_PROGRESS"
                                    {{ old('status', $ticket->status) == 'IN_PROGRESS' ? 'selected' : '' }}>IN_PROGRESS
                                </option>
                                <option value="CLOSED" {{ old('status', $ticket->status) == 'CLOSED' ? 'selected' : '' }}>
                                    CLOSED</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-dark text-success">
                                <i class="fa-solid fa-save"></i> Save Changes
                            </button>
                            <a class="btn btn-dark text-danger mt-3" href="{{ route('admin.tickets.index') }}">
                                <i class="fa-solid fa-rotate-left"></i> Cancel and Go Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
