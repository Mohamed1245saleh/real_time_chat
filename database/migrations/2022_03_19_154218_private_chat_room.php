<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrivateChatRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up( )
    {
        //
        Schema::create("private_chat_room" ,function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger("sender_id")->unsigned();
          $table->foreign('sender_id')->references('id')->on('users');
          $table->unsignedBigInteger("receiver_id")->unsigned();
          $table->foreign('receiver_id')->references('id')->on('users');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('private_chat_room');
    }
}
