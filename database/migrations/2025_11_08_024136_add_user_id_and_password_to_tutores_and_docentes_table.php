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
        Schema::table('tutores', function (Blueprint $table) {
            $table->string('password')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });

        Schema::table('docentes', function (Blueprint $table) {
            $table->string('password')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutores', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['password', 'user_id']);
        });

        Schema::table('docentes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['password', 'user_id']);
        });
    }
};
