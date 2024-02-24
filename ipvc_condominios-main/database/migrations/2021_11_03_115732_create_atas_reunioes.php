<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtasReunioes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atas_reunioes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_condominio');
            $table->date('data');
            $table->string('ata');
            $table->string('descricao');
            $table->foreign('id_condominio')->references('id')->on('condominios');
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
        Schema::dropIfExists('atas_reunioes');
    }
}
