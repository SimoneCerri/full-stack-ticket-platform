@extends('layouts.admin')

@section('content')
    <header>
        <div class="container-fluid bg-dark py-3 text-danger shadow">
            <div class="container d-flex align-items-center justify-content-center">
                <h1 class="text-center">
                    <strong>
                        {{ $ticket->title }}
                    </strong>
                </h1>
            </div>
        </div>
    </header>
    <div class="container py-5"></div>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card p-3">
                <h5 class="card-title text-center">
                    ID: {{ $ticket->id }}
                </h5>
                <p class="card-text">
                    <span class="fw-bold">
                        Description:
                    </span>
                    <br>
                    {{ $ticket->description }}
                </p>
                <hr>
                <button class="btn btn-dark text-danger">
                    {{ $ticket->status }}
                </button>
                <form action="{{ route('admin.tickets.update', $ticket) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3 py-3">
                        <label for="status" class="form-label">Change ticket status</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                            <option selected disabled>Select one</option>
                            @foreach ($states as $state)
                                <option value="{{ $state }}" {{ $state == old('status') ? 'selected' : '' }}>
                                    {{ $state }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="text-danger py-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-dark text-success">
                            <i class="fa-solid fa-plus fa-lg fa-fw"></i>
                            <span class="fw-bold px-1">
                                EDIT
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
        </div>
    </div>
    </div>
@endsection
