<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get Wallet model by current user id
     *
     * @return Wallet
     */
    public function getWalletByUserId() : Wallet
    {
        return Wallet::where('user_id', auth()->id())->get()->first();
    }
}
