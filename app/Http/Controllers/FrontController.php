<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Product::query();

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $products = $query->latest()->get();
        return view('welcome', compact('products', 'search'));
    }
}
