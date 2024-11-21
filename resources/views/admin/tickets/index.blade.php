@extends('layouts.admin')

@section('content')
    <header>
        <div class="container-fluid bg-dark py-3 text-danger shadow">
            <div class="container d-flex align-items-center justify-content-between">
                <h1>
                    <strong>
                        Projects
                    </strong>
                </h1>
                <a class="btn btn-danger text-dark" href="{{ route('admin.projects.create') }}">
                    <i class="fa-solid fa-plus fa-lg fa-fw"></i>
                    <span class="fw-bold px-1">
                        ADD PROJECT
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
                List of projects:
            </h4>
            <div class="table-responsive rounded-top-3">
                <table class="table table-secondary align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-danger" scope="col">ID</th>
                            <th class="text-danger" scope="col">VIDEO</th>
                            <th class="text-danger" scope="col">TITLE</th>
                            <th class="text-danger" scope="col">GITHUB</th>
                            <th class="text-danger" scope="col">PREVIEW</th>
                            <th class="text-danger" scope="col">IMAGE</th>
                            <th class="text-danger" scope="col">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse ($projects as $project)
                            <tr class="">
                                <td scope="row">{{ $project->id }}</td>
                                <td scope="row"></td>
                                <td scope="row">{{ $project->title }}</td>
                                <td scope="row">{{ $project->url1 }}</td>
                                <td scope="row">{{ $project->url2 }}</td>
                                <td scope="row">
                                    @if (Str::startsWith($project->img, 'https://'))
                                        <img width="250" src="{{ $project->img }}" alt="">
                                    @else
                                        <img width="250" src="{{ asset('storage/' . $project->img) }}" alt="">
                                    @endif
                                </td>
                                <td scope="row" class="text-center">
                                    <div class="py-1">
                                        <a class="btn btn-dark" href="{{ route('admin.projects.show', $project) }}">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                    <div class="py-1">
                                        <a class="btn btn-dark" href="{{ route('admin.projects.edit', $project) }}">
                                            <i class="fas fa-pencil fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                    <div class="py-1">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $project->id }}">
                                            <i class="fas fa-trash-can fa-sm fa-fw"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Are you sure to delete {{ $project->title }} project ?
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">❌care❌care❌</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('admin.projects.destroy', $project) }}"
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
            {{ $projects->links('pagination::bootstrap-5') }}

            {{-- php artisan vendor:publish --}}
        </div>
    </section>
@endsection
