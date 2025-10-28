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
        Schema::create('infantes_tutores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('infante_id');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('infante_id')->references('id')->on('infantes')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('tutores')->onDelete('cascade');
            $table->String('parentesco');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infantes_tutores');
    }
};
