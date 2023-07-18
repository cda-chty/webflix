@extends('layouts.app')

@section('content')
    @if (Auth::user())
        <div class="text-center mb-4">
            <a class="btn btn-primary" href="/films/creer">Créer un film</a>
        </div>
    @endif

    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5">
        @foreach ($movies as $movie)
            <div class="col d-flex flex-column">
                <img class="img-fluid list-movie-image" src="{{ $movie->cover }}" alt="{{ $movie->title }}">
                <div class="d-flex flex-column justify-content-between flex-grow-1">
                    <h3 class="list-movie-title">
                        <a href="/film/{{ $movie->id }}">
                            {{ $movie->title }}
                        </a>
                    </h3>
                    <p class="list-movie-synopsis">{{ Str::words($movie->synopsis, 5) }}</p>
                    <p class="list-movie-meta">
                        {{ $movie->duration }} |
                        @if ($movie->released_at)
                        {{ $movie->released_at->translatedFormat('d F Y') }} |
                        @endif
                        {{ $movie->category->name }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    {{ $movies->links() }}
@endsection
