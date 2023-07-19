@extends('layouts.app')

@section('content')
    <div class="actor-list row row-cols-2 row-cols-lg-4 gy-4 mb-5">
        @foreach ($actors as $actor)
            <div class="col">
                <div class="card">
                    <a href="{{ route('actors.show', $actor) }}" class="text-decoration-none text-dark">
                        <img class="card-img-top" src="{{ $actor->avatar }}" alt="{{ $actor->name }}">
                        <div class="card-body">
                            <h3>{{ $actor->name }}</h3>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $actors->links() }}
@endsection
