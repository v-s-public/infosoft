<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\Deposit;
use App\Models\Transactions\TransactionCreateDeposit;
use App\Models\Transactions\TransactionEnter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DepositController extends Controller
{
    /**
     * Show list of deposits
     *
     * @return View
     */
    public function index() : View
    {
        $deposits = Deposit::where('user_id', auth()->id())->get()->toArray();
        return view('deposit.index', compact('deposits'));
    }

    /**
     * Show deposit form
     *
     * @return View
     */
    public function create() : View
    {
        return view('deposit.form');
    }

    /**
     * Store deposit
     *
     * @param DepositRequest $request
     * @return RedirectResponse
     */
    public function store(DepositRequest $request) : RedirectResponse
    {
        $invested = $request->get('invested');
        $wallet = $this->getWalletByUserId();
        $userId = auth()->id();
        $walletId = $wallet->wallet_id;

        $deposit = Deposit::create([
            'user_id' => $userId,
            'wallet_id' => $walletId,
            'invested' => $invested,
            'percent' =>  Deposit::PERCENT,
            'active' => 1,
            'duration' => Deposit::DURATION,
            'accrue_times' => 0
        ]);

        TransactionCreateDeposit::create([
            'user_id' => $userId,
            'wallet_id' => $walletId,
            'amount' => $invested,
            'deposit_id' => $deposit->deposit_id
        ]);

        $wallet->balance -= $invested;
        $wallet->save();

        return redirect(route('deposit.index'));
    }
}
