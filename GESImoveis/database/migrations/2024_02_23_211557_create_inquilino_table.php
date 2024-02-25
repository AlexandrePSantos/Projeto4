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
        Schema::create('inquilino', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('apelido', 255);
            $table->string('email', 255);
            $table->string('telemovel', 20);
            $table->string('telefone', 20);
            $table->string('morada', 255);
            $table->string('codigo_postal', 20);
            $table->string('nif', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquilino');
    }
};
