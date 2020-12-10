<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('deposit_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('wallet_id');
            $table->unsignedDouble('invested', 50, 2);
            $table->unsignedDouble('percent', 50, 2);
            $table->unsignedTinyInteger('active');
            $table->unsignedTinyInteger('duration');
            $table->unsignedTinyInteger('accrue_times');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')
                ->on('users')
                ->references('user_id')
                ->onDelete('CASCADE');

            $table->foreign('wallet_id')
                ->on('wallets')
                ->references('wallet_id')
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
        Schema::dropIfExists('deposits');
    }
}
