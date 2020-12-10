<?php

namespace App\Models\Transactions;

class TransactionCreateDeposit extends Transaction
{
    protected $attributes = [
        'type' => 'create_deposit'
    ];
}
