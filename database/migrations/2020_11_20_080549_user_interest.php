<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserInterest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_interest', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->index('user_love_id');
            $table->foreign('user_love_id')->references('id')->on('user_love')->onDelete('cascade');
            $table->index('interest_id');
            $table->foreign('interest_id')->references('id')->on('interest')->onDelete('cascade');
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
        Schema::dropIfExists('user_interest');
    }
}
