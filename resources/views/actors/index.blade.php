@extends('layouts.app')

@section('content')
    <div class="actor-list row row-cols-2 row-cols-lg-4 gy-4 mb-5">
        @forelse ($actors as $actor)
            <div class="col">
                <div class="card">
                    <a href="{{ route('actors.show', $actor) }}" class="text-decoration-none text-dark">
                        <img class="card-img-top" src="{{ $actor->avatar }}" alt="{{ $actor->name }}">
                        <div class="card-body">
                            <h3>{{ $actor->name }}</h3>
                            @if ($actor->birthday)
                            <small>{{ $actor->birthday->age }} ans</small>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col flex-grow-1">
                <h1 class="text-center">Il n'y a pas d'acteurs</h1>
            </div>
        @endforelse
    </div>

    {{ $actors->links() }}
@endsection
