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
        Schema::create('tutores', function (Blueprint $table) {
            $table->id('tutor_id');
            $table->string('nombre_tutor');
            $table->string('apellido_tutor');
            $table->string('CI_tutor')->unique()->nullable();
            $table->string('telefono_tutor')->unique();
            $table->string('correo_electronico_tutor')->unique()->nullable();
            $table->string('direccion_tutor')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
