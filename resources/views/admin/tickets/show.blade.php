@extends('layouts.admin')

@section('content')
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
            </div>
        </div>
    </div>
    </div>
@endsection
