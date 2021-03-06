<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_jawabans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('poin');
            $table->timestamps();

            //FK
            $table->unsignedBigInteger('jawaban_id')->nullable();
            $table->foreign('jawaban_id')->references('id')->on('jawabans')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_jawabans');
    }
}
