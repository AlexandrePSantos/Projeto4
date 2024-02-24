<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('despesa', function (Blueprint $table) {
            $table->increments('id_desp');
            $table->integer('id_imovel')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->integer('id_tipo_despesa')->unsigned();
            $table->date('data');
            $table->decimal('valor', 10, 2);
            $table->timestamps();

            $table->foreign('id_imovel')->references('id_imovel')->on('imovel');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_tipo_despesa')->references('id_tipo_despesa')->on('tipo_despesa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despesa');
    }
};
