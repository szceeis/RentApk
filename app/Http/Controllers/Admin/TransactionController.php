<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'product'])->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function confirm(Request $request, Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction is already confirmed or expired.');
        }

        $transaction->update([
            'status' => 'active',
            'rent_start' => now(),
            'rent_end' => now()->addDays(7), // Set expired to 7 days
        ]);

        return back()->with('success', 'Transaction confirmed! Access granted for 1 week.');
    }
}
