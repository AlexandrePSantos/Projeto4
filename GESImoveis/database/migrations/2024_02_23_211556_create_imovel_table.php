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
        Schema::create('imovel', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_tipo_imovel')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->decimal('area', 10, 2);
            $table->string('morada');
            $table->string('andar');
            $table->integer('num_divisoes');
            $table->integer('ano_construcao');
            $table->decimal('val_seguro', 10, 2);
            $table->decimal('val_imi', 10, 2);
            $table->decimal('val_condominio', 10, 2);
            $table->date('data_aquisicao');
            $table->decimal('preco_compra', 10, 2);
            $table->enum('estado', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();

            $table->foreign('id_tipo_imovel')->references('id')->on('tipo_imovel');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imovel');
    }
};
