<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration {
    public function up(): void {
        Schema::create('detalle_asistencias', function (Blueprint $table) {
            $table->id('detalle_asistecia_id');
            $table->foreignId('asistencia_id');
            $table->foreign('asistencia_id')
                ->references('asistencia_id')
                ->on('asistencias')
                ->onDelete('cascade');

            $table->foreignId('inscripcion_id');
            $table->foreign('inscripcion_id')
                ->references('inscripcion_id')
                ->on('inscripciones')
                ->onDelete('cascade');

            $table->enum('observacion', ['presente', 'ausente', 'licencia'])->default('presente');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('detalle_asistencias');
    }
};
