<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('tipo_id')->unsigned();

            $table->string('title');
            $table->longText('description');

            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipo_posts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
