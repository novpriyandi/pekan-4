<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarPertanyaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar_pertanyaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('isi');
            $table->timestamps();

            //FK
            $table->unsignedBigInteger('pertanyaan_id')->nullable();
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaans')->onDelete('cascade');

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
        Schema::dropIfExists('komentar_pertanyaans');
    }
}
