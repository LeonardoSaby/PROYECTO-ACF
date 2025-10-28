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
        // La tabla detalle_asistencias relaciona la Asistencia (el día) con la Inscripción (el infante en un curso/turno)
        Schema::create('detalle_asistencias', function (Blueprint $table) {
            $table->id('id_detalle_asistencia');

            // 1. Relación con la Cabecera (Asistencia)
            $table->unsignedBigInteger('id_asistencia');
            
            // 2. Relación con el Infante/Curso/Turno (a través de Inscripcione)
            $table->unsignedBigInteger('id_inscripcion'); 
            
            // -----------------------------------------------------
            // CAMBIO: Este campo ahora registra el estado de la asistencia
            $table->enum('observaciones', ['presente', 'ausente', 'justificado'])->default('presente'); 
            
            // Eliminado Lógico del REGISTRO de Detalle ('activo' / 'inactivo')
            $table->enum('status', ['activo', 'inactivo'])->default('activo'); 

            // -----------------------------------------------------

            $table->timestamps();

            // Definición de Claves Foráneas
            $table->foreign('id_asistencia')->references('id_asistencia')->on('asistencias')->onDelete('cascade');
            $table->foreign('id_inscripcion')->references('id')->on('inscripciones')->onDelete('cascade');
            
            // Índice único: Un infante (inscripcion) solo puede tener un registro por día (asistencia)
            $table->unique(['id_asistencia', 'id_inscripcion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_asistencias');
    }
};
