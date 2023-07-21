<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []); // $_SESSION['cart']
        // [2, 4, 6]
        // [['id' => 2], ['id' => 4], ['id' => 6]]
        foreach ($cart as $index => $item) {
            $cart[$index]['movie'] = Movie::find($item['id']);
        }

        return view('cart', ['cart' => $cart]);
    }

    public function store(Movie $movie)
    {
        // cart est un tableau dans lequel on ajoute un truc
        session()->push('cart', [
            'id' => $movie->id,
            'quantity' => 1,
            'movie' => null,
        ]);

        return back();
    }
}
