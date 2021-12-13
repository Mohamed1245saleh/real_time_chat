<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineUsersTable extends Migration
{
  
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger("room_id")->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->timestamp("userLogin")->nullable();
            $table->timestamp("userLogout")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_users');
    }
}
