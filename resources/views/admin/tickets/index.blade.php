@extends('layouts.admin')

@section('content')
    <header>
        <div class="container-fluid bg-dark py-3 text-danger shadow">
            <div class="container d-flex align-items-center justify-content-between">
                <h1>
                    <strong>
                        Tickets
                    </strong>
                </h1>
                <a class="btn btn-danger text-dark" href="{{ route('admin.tickets.create') }}">
                    <i class="fa-solid fa-plus fa-lg fa-fw"></i>
                    <span class="fw-bold px-1">
                        ADD TICKET
                    </span>
                </a>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container">
            @include('partials.session-message')
            {{-- @dd(session('status')) --}}
            <h4 class="py-3">
                List of tickets:
            </h4>
            <form action="{{ route('admin.tickets.index') }}" method="GET">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select name="status" class="form-select" aria-label="Filter by status">
                            <option value="">All Statuses</option>
                            <option value="ASSIGNED" {{ request('status') == 'ASSIGNED' ? 'selected' : '' }}>Assigned
                            </option>
                            <option value="IN_PROGRESS" {{ request('status') == 'IN_PROGRESS' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="CLOSED" {{ request('status') == 'CLOSED' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="category_id" class="form-select" aria-label="Filter by category">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-dark text-success">
                            <i class="fa-solid fa-filter"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </form>
            <div class="table-responsive rounded-top-3">
                <table class="table table-secondary align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-danger" scope="col">ID</th>
                            <th class="text-danger" scope="col">TITLE</th>
                            <th class="text-danger" scope="col">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse ($tickets as $ticket)
                            <tr class="">
                                <td scope="row">{{ $ticket->id }}</td>
                                <td scope="row">{{ $ticket->title }}</td>
                                <td scope="row" class="text-center">
                                    <div class="py-1">
                                        <a class="btn btn-dark" href="{{ route('admin.tickets.show', $ticket) }}">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                    <div class="py-1">
                                        <a class="btn btn-dark" href="{{ route('admin.tickets.edit', $ticket) }}">
                                            <i class="fas fa-pencil fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                    <div class="py-1">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $ticket->id }}">
                                            <i class="fas fa-trash-can fa-sm fa-fw"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalId-{{ $ticket->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Are you sure to delete {{ $ticket->title }} ticket ?
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">❌care❌care❌</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('admin.tickets.destroy', $ticket) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                Delete this project
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="">
                                <td scope="row" colspan="7">No projects to show</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $tickets->links('pagination::bootstrap-5') }}

            {{-- php artisan vendor:publish --}}
        </div>
    </section>
@endsection
