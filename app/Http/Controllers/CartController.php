<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []); // $_SESSION['cart']

        return view('cart', ['cart' => $cart]);
    }

    public function store(Movie $movie)
    {
        // cart est un tableau dans lequel on ajoute un truc
        session()->push('cart', $movie->id);

        return back();
    }
}
