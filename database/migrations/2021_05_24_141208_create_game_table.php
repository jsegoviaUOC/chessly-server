<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('pieces');
            $table->integer('x_axis');
            $table->integer('y_axis');
            $table->string('type');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->string('color_creator');

            $table->foreign('creator_id')->references('id')->on('chess_users');
            $table->foreign('visitor_id')->references('id')->on('chess_users');
            $table->foreign('winner_id')->references('id')->on('chess_users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game');
    }
}
