<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecoTipoCond extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preco_tipo_cond', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_condominio');
            $table->unsignedBigInteger('id_tipo');
            $table->foreign('id_condominio')->references('id')->on('condominios');
            $table->foreign('id_tipo')->references('id')->on('tipo_habitacao');
            $table->double('valor');
            $table->date('data');
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
        Schema::dropIfExists('preco_tipo_cond');
    }
}
