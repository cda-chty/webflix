<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Movie;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []); // $_SESSION['cart']
        $total = 0;
        // [2, 4, 6]
        // [['id' => 2], ['id' => 4], ['id' => 6]]
        $movies = Movie::findMany(array_column($cart, 'id'));
        foreach ($cart as $index => $item) {
            $movie = $movies[$index];
            $cart[$index]['movie'] = $movie;
            // @todo Prix total de chaque produit
            $cart[$index]['price'] = $movie->price * $item['quantity'];
            // @todo Prix total du panier
            $total += $cart[$index]['price'];
        }

        return view('cart', ['cart' => Cart::items(), 'total' => Cart::total()]);
    }

    public function store(Movie $movie)
    {
        $cart = session('cart', []);

        // Si le panier contient le produit, on incrémente la quantité
        if (collect($cart)->contains('id', $movie->id)) {
            $index = array_search($movie->id, array_column($cart, 'id'));
            $cart[$index]['quantity']++;
            session()->put('cart', $cart); // Mettre à jour la session

            return back();
        }

        // cart est un tableau dans lequel on ajoute un truc
        session()->push('cart', [
            'id' => $movie->id,
            'quantity' => 1,
            'movie' => null,
            'price' => null,
        ]);

        return back();
    }
}
