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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id('docente_id');
            $table->string('nombre_docente');
            $table->string('apellido_docente');
            $table->string('telefono_docente');
            $table->integer('CI_docente')->unique();
            $table->string('correo_electronico_docente')->unique();
            $table->date('fecha_contratacion')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');

            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('curso_id')->on('cursos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
