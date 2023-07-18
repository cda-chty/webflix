<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

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
            'category' => 'nullable|exists:categories,id',
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
}
