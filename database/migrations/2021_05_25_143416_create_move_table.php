<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('x_current');
            $table->integer('y_current');
            $table->integer('x_target');
            $table->integer('y_target');

            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('game_id');

            $table->foreign('player_id')->references('id')->on('chess_users');
            $table->foreign('game_id')->references('id')->on('game');

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
        Schema::dropIfExists('move');
    }
}
