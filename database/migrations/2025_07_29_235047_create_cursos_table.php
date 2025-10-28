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
    Schema::create('cursos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_curso');

        
        $table->unsignedBigInteger('nivel_id');
        $table->unsignedBigInteger('sala_id');
        $table->unsignedBigInteger('docente_id');

       
        $table->foreign('nivel_id')->references('id')->on('niveles')->onDelete('cascade');
        $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
        $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');

        $table->enum('estado', ['activo', 'inactivo'])->default('activo');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
