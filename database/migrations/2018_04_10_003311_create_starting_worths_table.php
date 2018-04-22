<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStartingWorthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starting_worths', function (Blueprint $table) {
            $table->string('nickname');
            $table->decimal('worth',12,2);
            $table->timestamps();

            $table->foreign('nickname')->references('nickname')->on('trading_accounts');
            
            $table->primary('nickname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('starting_worths');
    }
}
