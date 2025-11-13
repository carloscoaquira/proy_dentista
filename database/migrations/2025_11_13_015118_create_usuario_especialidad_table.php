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
        Schema::create('usuario_especialidad', function (Blueprint $table) {
            $table->id('id_usuario_especialidad');
            $table->unique(['id_usuario', 'id_especialidad']);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_especialidad');

            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_especialidad')->references('id_especialidad')->on('especialidades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_especialidad');
    }
};
