<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Show a list of transactions for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::where('buyer_id', $user->id)
            ->orWhere('seller_id', $user->id)
            ->with(['buyer', 'seller', 'seat'])
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }
}
