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
        Schema::create('infantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_infante');
            $table->string('apellido_infante');
            $table->integer('CI_infante')->unique();
            $table->date('fecha_nacimiento_infante');
            $table->integer('edad_infante')->nullable();
            $table->string('genero_infante');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infantes');
    }
};
