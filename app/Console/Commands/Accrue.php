<?php

namespace App\Console\Commands;

use App\Models\Deposit;
use App\Models\Transactions\TransactionAccrue;
use App\Models\Transactions\TransactionCloseDeposit;
use Illuminate\Console\Command;

class Accrue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accrue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Accruals on deposits';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deposits = Deposit::all();

        foreach ($deposits as $deposit) {
            if ($deposit->active) {
                $accrue = (Deposit::PERCENT * $deposit->invested) / 100;
                $wallet = $deposit->wallet;
                $wallet->balance += $accrue;
                $wallet->save();

                $userId = $wallet->user_id;
                $walletId = $wallet->wallet_id;

                TransactionAccrue::create([
                    'user_id' => $userId,
                    'wallet_id' => $walletId,
                    'amount' => $accrue,
                    'deposit_id' => $deposit->deposit_id
                ]);

                $deposit->accrue_times +=1;
                $deposit->amount_of_accrue += $accrue;
                $deposit->save();

                if ($deposit->accrue_times === Deposit::DURATION) {
                    $deposit->active = 0;
                    $deposit->save();
                    TransactionCloseDeposit::create([
                        'user_id' => $userId,
                        'wallet_id' => $walletId,
                        'amount' => null,
                        'deposit_id' => $deposit->deposit_id
                    ]);
                }
            }
        }
    }
}
