<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRentalController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->with('product')->latest()->get();
        
        foreach ($transactions as $trx) {
            if ($trx->status === 'active' && $trx->rent_end && $trx->rent_end->isPast()) {
                $trx->update(['status' => 'expired']);
            }
        }

        return view('rentals.index', compact('transactions'));
    }
}
