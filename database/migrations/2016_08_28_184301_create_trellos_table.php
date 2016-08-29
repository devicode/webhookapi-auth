<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrellosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trellos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('trello_id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
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
        Schema::drop('trellos');
    }
}
