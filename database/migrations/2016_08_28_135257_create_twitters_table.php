<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('twitter_id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('token');
            $table->string('tokenSecret');
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
        Schema::drop('twitters');
    }
}
