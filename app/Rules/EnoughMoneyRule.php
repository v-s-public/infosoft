<?php

namespace App\Rules;

use App\Models\Wallet;
use Illuminate\Contracts\Validation\Rule;

class EnoughMoneyRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $wallet = Wallet::where('user_id', auth()->id())->get()->first();
        return $value < $wallet->balance;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is not enough money in the balance.';
    }
}
