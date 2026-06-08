<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = auth()->user()->carts()->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }
        $total = $carts->sum(function($cart) { return $cart->product->price; });
        return view('checkout.index', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $carts = auth()->user()->carts()->with('product')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Cart is empty.');
        }

        $path = $request->file('proof_of_payment')->store('proofs', 'public');

        foreach ($carts as $cart) {
            Transaction::create([
                'user_id' => auth()->id(),
                'product_id' => $cart->product_id,
                'price' => $cart->product->price,
                'proof_of_payment' => $path,
                'status' => 'pending',
            ]);
        }

        // Clear cart
        auth()->user()->carts()->delete();

        return redirect()->route('rentals.index')->with('success', 'Checkout successful! Waiting for admin confirmation.');
    }
}
