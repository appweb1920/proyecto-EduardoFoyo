<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MatchUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->index('user_love_first');
            $table->foreign('user_love_first')->references('id')->on('user_love')->onDelete('cascade');
            $table->index('user_love_second');
            $table->foreign('user_love_second')->references('id')->on('user_love')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('match_users');
    }
}
