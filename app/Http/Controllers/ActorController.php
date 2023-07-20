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
}