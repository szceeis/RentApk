<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->with('product')->get();
        return view('cart.index', compact('carts'));
    }

    public function store(Request $request, Product $product)
    {
        if (auth()->user()->carts()->where('product_id', $product->id)->exists()) {
            return back()->with('error', 'Product already in cart.');
        }

        auth()->user()->carts()->create([
            'product_id' => $product->id
        ]);

        return back()->with('success', 'Added to cart!');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id == auth()->id()) {
            $cart->delete();
        }
        return back()->with('success', 'Removed from cart.');
    }
}
