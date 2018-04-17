<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoldingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holdings', function (Blueprint $table) {
            $table->string('trading_nickname',32);
            $table->string('asx_code',3);
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('trading_nickname')->references('nickname')->on('trading_accounts');
            $table->foreign('asx_code')->references('code')->on('shares');

            $table->primary(['trading_nickname','asx_code']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holdings');
    }
}
