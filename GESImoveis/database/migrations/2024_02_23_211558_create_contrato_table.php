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
        Schema::create('contrato', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_inquilino')->unsigned();
            $table->bigInteger('id_imovel')->unsigned();
            $table->bigInteger('id_tipo_contrato')->unsigned();
            $table->date('data_ini');
            $table->date('data_fim');
            $table->decimal('valor', 10, 2);
            $table->string('perocidade_pag', 50);
            $table->string('estado', 50);
            $table->date('data_termino')->nullable();
            $table->decimal('valor_pago', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_inquilino')->references('id')->on('inquilino');
            $table->foreign('id_imovel')->references('id')->on('imovel');
            $table->foreign('id_tipo_contrato')->references('id')->on('tipo_contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato');
    }
};
