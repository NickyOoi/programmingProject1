<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaders', function (Blueprint $table) {
            $table->string('nickname');
            $table->integer('place');
            $table->decimal('trading_value',12,2);
            $table->date('date');
            $table->timestamps();

            $table->foreign('nickname')->references('nickname')->on('trading_accounts');
            
            $table->primary('place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaders');
    }
}
