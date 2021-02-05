<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersToSendTable extends Migration {

    public function up() {
        Schema::create('users_to_send', function (Blueprint $table) {
           $table->id();
           $table->string("name");
           $table->string("surname");
           $table->string("email");
           $table->boolean("subscribed")->default(0);
           $table->dateTime("sync_at")->nullable();
           $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users_to_send');
    }
}
