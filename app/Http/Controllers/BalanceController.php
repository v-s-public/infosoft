<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use App\Models\Transactions\TransactionEnter;
use App\Models\Wallet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BalanceController extends Controller
{
    /**
     * Show balance form
     *
     * @return View
     */
    public function topUpForm() : View
    {
        return view('balance.form');
    }

    /**
     * Store balance
     *
     * @param BalanceRequest $request
     * @return RedirectResponse
     */
    public function topUp(BalanceRequest $request) : RedirectResponse
    {
        $amount = $request->get('balance');

        $model = $this->getWalletByUserId();
        $model->balance += $amount;
        $model->save();

        TransactionEnter::create([
            'user_id' => auth()->id(),
            'wallet_id' => $model->wallet_id,
            'amount' => $amount
        ]);

        return redirect(route('balance'));
    }

    /**
     * Show balance
     *
     * @return View
     */
    public function show() : View
    {
        $balance = $this->getWalletByUserId()->balance;
        $balance = $balance ?? '0';
        return view('balance.show', compact('balance'));
    }
}
