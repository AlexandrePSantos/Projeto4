<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_condominio');
            $table->unsignedBigInteger('id_tipo');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_condominio')->references('id')->on('condominios');
            $table->string('morada');
            $table->string('portaria');
            $table->foreign('id_tipo')->references('id')->on('tipo_habitacao');
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
        Schema::dropIfExists('habitacoes');
    }
}
