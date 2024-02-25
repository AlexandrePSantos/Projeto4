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
            $table->id();
            $table->bigInteger('id_imovel')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_tipo_despesa')->unsigned();
            $table->date('data');
            $table->decimal('valor', 10, 2);
            $table->timestamps();

            $table->foreign('id_imovel')->references('id')->on('imovel');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_tipo_despesa')->references('id')->on('tipo_despesa');
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
