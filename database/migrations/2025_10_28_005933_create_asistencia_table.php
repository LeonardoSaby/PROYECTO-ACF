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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('id_asistencia'); // Clave primaria
            $table->date('fecha')->unique(); // La fecha debe ser única para evitar doble registro
            // Campo para eliminado lógico / estado de actividad: 'Activo' o 'Inactivo'
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
