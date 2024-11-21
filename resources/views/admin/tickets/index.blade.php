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
            {{-- @include('partials.session-message') --}}
            {{-- @dd(session('status')) --}}
            <h4 class="py-3">
                List of projects:
            </h4>
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
