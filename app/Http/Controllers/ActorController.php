<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        return view('actors.index', [
            'actors' => Actor::paginate(8),
        ]);
    }

    public function show(Actor $actor)
    {
        return view('actors.show', compact('actor'));
    }

    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:actors|min:2',
            'avatar' => 'nullable|image|max:2048',
            'birthday' => 'nullable|date|before:'.(date('Y') - 10).'-01-01',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = '/storage/'.$request->file('avatar')->store('actors');
        }

        Actor::create([
            'name' => $request->name,
            'avatar' => $avatar ?? null,
            'birthday' => $request->birthday,
        ]);

        return redirect('/acteurs');
    }
}
