<?php

namespace App\Http\Controllers;

use App\Models\Transactions\Transaction;

class Transactions extends Controller
{
    /**
     * Show transactions list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get()->toArray();
        return view('transactions.index', compact('transactions'));
    }
}
