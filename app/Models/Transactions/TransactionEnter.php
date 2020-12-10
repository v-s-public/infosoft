<?php

namespace App\Models\Transactions;

class TransactionEnter extends Transaction
{
    protected $attributes = [
        'type' => 'enter'
    ];
}
