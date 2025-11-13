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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('id_horario');
            $table->unsignedBigInteger('id_doctor');

            // 1 = lunes ... 7 = domingo (elige tu convención)
            $table->unsignedTinyInteger('dia_semana');
            $table->boolean('activo')->default(true);

            $table->timestamps();
            $table->foreign('id_doctor')->references('id_usuario')->on('usuarios')->onDelete('cascade');

            $table->unique(['id_doctor', 'dia_semana']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
