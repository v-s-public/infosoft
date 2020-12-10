<?php

namespace App\Models\Transactions;

class TransactionAccrue extends Transaction
{
    protected $attributes = [
        'type' => 'accrue'
    ];
}
