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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->enum('role', ['admin', 'proprietario'])->default('proprietario');
            $table->string('nome');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telemovel');
            $table->string('telefone');
            $table->string('titulo');
            $table->string('morada');
            $table->string('codigo_postal');
            $table->string('cidade');
            $table->string('pais');
            $table->string('nif');
            $table->string('foto')->nullable();
            $table->enum('estado', ['ativo', 'inativo'])->default('ativo');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
