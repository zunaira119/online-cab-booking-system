<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
           $table->string('phone')->nullable()->unique();
           $table->string('image')->nullable();
           $table->string('address')->nullable();
           $table->string('uni_card_number')->nullable();
           $table->string('firebase_id')->nullable();
           $table->string('device_token')->nullable();
           $table->enum('type',['user','admin'])->default('user');
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
        Schema::dropIfExists('users');
    }
}
