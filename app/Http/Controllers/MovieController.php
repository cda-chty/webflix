<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        return view('movies.index', [
            'movies' => Movie::paginate(10),
        ]);
    }

    public function show(string $id)
    {
        $movie = Movie::findOrFail($id); // Select * from movie where id = :id

        return view('movies.show', ['movie' => $movie]);
    }

    public function create()
    {
        return view('movies.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:movies|min:2',
            'synopsis' => 'required|min:10',
            'duration' => 'required|integer|min:1',
            'youtube' => 'nullable|string',
            'cover' => 'required|image|max:2048',
            'released_at' => 'nullable|date',
            'category' => 'required|exists:categories,id',
        ]);

        Movie::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'duration' => $request->duration,
            'youtube' => $request->youtube,
            'cover' => '/storage/'.$request->file('cover')->store('movies'),
            'released_at' => $request->released_at,
            'category_id' => $request->category,
            'user_id' => $request->user()->id,
        ]);

        return redirect('/films');
    }

    public function edit(Movie $movie)
    {
        Gate::allowIf($movie->user_id === Auth::user()->id);

        return view('movies.edit', [
            'categories' => Category::all(),
            'movie' => $movie,
        ]);
    }

    public function update(Request $request, Movie $movie)
    {
        Gate::allowIf($movie->user_id === $request->user()->id);

        $validated = $request->validate([
            // Pour le unique, on vérifie dans la table movies sauf pour le film modifié
            'title' => 'required|unique:movies,title,'.$movie->id.'|min:2',
            'synopsis' => 'required|min:10',
            // ^[0-9]+h?[0-5]?[0-9]?$ => Version améliorée
            'duration' => ['required', 'regex:/^([0-9]+h[0-5]?[0-9]?|[0-5]?[0-9]?)$/'],
            'youtube' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'released_at' => 'nullable|date',
            'category' => 'required|exists:categories,id',
        ]);

        // Remplacer l'image s'il y en a une
        if ($request->hasFile('cover')) {
            Storage::delete(str($movie->cover)->remove('/storage/'));
            $validated['cover'] = '/storage/'.$request->file('cover')->store('movies');
        }

        $validated['category_id'] = $validated['category']; // Fix column name
        unset($validated['category']);
        $movie->update($validated);

        return redirect('/films');
    }

    public function destroy(Request $request, string $id)
    {
        // On s'assure que l'utilisateur connecté est bien le propriétaire du film
        $movie = Movie::findOrFail($id);
        Gate::allowIf($movie->user_id === $request->user()->id);

        Storage::delete(str($movie->cover)->remove('/storage/')); // Supprimer l'image
        Movie::destroy($id);

        return redirect('/films')->with('message', 'Le film a été supprimé.');
    }

    public function react()
    {
        return view('movies.react');
    }
}
