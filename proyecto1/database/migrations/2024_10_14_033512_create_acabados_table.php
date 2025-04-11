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
        Schema::create('acabados', function (Blueprint $table) {
        $table->id();
        $table->string('material_herramienta');
        $table->string('materia_prima');
        $table->float('diametro_herramienta');
        $table->integer('numero_dientes');
        $table->float('velocidad_corte');
        $table->float('rpm')->nullable(); // Resultado
        $table->float('avance_corte')->nullable(); // Resultado
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acabados');
    }
};
