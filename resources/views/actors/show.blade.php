@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/acteurs">Acteurs</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $actor->name }}</li>
        </ol>
    </nav>

    <div class="row">
        @if ($actor->avatar)
        <div class="col-lg-4">
            <img class="img-fluid rounded-5" src="{{ $actor->avatar }}" alt="{{ $actor->name }}">
        </div>
        @endif

        <div class="@if ($actor->avatar) col-lg-8 @else col-lg-12 @endif">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1>{{ $actor->name }}</h1>
                    @if ($actor->birthday)
                    <p>Âge: {{ $actor->birthday->age }} ans</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
