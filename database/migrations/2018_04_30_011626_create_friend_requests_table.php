<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_requests', function (Blueprint $table) {
            $table->string('to');
            $table->string('from');
            //$table->string('message');
            $table->timestamps();


            $table->foreign('to')->references('nickname')->on('trading_accounts')->onDelete('cascade');
            $table->foreign('from')->references('nickname')->on('trading_accounts')->onDelete('cascade');

            $table->primary('to','from');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend_requests');
    }
}
