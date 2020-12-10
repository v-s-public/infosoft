<?php

namespace App\Models\Transactions;

class TransactionCloseDeposit extends Transaction
{
    protected $attributes = [
        'type' => 'close_deposit'
    ];
}
