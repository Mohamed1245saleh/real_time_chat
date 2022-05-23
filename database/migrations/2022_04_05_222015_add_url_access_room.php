<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlAccessRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('private_chat_room', function (Blueprint $table) {
            $table->string('urlAccessRoom' , 50)->after("receiver_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('private_chat_room', function (Blueprint $table) {
//            $table->string('urlAccessRoom' , 50);
        });
    }
}
