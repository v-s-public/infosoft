<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->string('type', 30);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('wallet_id');
            $table->unsignedInteger('deposit_id')->nullable();
            $table->unsignedDouble('amount', 50, 2);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')
                ->on('users')
                ->references('user_id')
                ->onDelete('CASCADE');

            $table->foreign('wallet_id')
                ->on('wallets')
                ->references('wallet_id')
                ->onDelete('CASCADE');

            $table->foreign('deposit_id')
                ->on('deposits')
                ->references('deposit_id')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
