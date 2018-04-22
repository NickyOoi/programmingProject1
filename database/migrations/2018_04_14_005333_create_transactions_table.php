<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('nickname');
            $table->string('code');
            $table->integer('amount');
            $table->decimal('value',12,2);
            $table->dateTime('dateTime');
            $table->boolean('purchase');


            $table->foreign('nickname')->references('nickname')->on('trading_accounts');
            $table->foreign('code')->references('code')->on('shares');

            $table->primary('nickname','dateTime');
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
