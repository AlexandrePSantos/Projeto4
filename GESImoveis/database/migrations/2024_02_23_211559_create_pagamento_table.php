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
        Schema::create('pagamento', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contrato')->unsigned();
            $table->date('data_pag');
            $table->string('metodo_pag');
            $table->decimal('valor', 10, 2);
            $table->timestamps();

            $table->foreign('id_contrato')->references('id')->on('contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamento');
    }
};
