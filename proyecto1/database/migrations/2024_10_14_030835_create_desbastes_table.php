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
        Schema::create('desbastes', function (Blueprint $table) {
            $table->id();
            $table->string('material_herramienta');
            $table->string('materia_prima');
            $table->decimal('diametro_herramienta', 8, 2);
            $table->integer('numero_dientes');
            $table->decimal('velocidad_corte', 8, 2);
            $table->decimal('rpm', 8, 2)->nullable();
            $table->decimal('avance_corte', 8, 2)->nullable();
            $table->decimal('profundidad_maxima', 8, 2); // Adjust precision and scale as needed
 // Campo para la profundidad máxima
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desbastes');
    }
};
