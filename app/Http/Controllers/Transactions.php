<?php

namespace App\Http\Controllers;

use App\Models\Transactions\Transaction;
use Illuminate\Contracts\View\View;

class Transactions extends Controller
{
    /**
     * Show transactions list
     *
     * @return View
     */
    public function index() : View
    {
        $transactions = Transaction::where('user_id', auth()->id())->paginate(10);
        return view('transactions.index', compact('transactions'));
    }
}
