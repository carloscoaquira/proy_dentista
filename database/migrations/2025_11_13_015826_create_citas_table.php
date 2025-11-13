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
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_usuario');

            $table->unsignedBigInteger('id_sucursal');
            $table->dateTime('fecha_hora_inicio');
            $table->dateTime('fecha_hora_fin');
            $table->string('estado', 30)->default('pendiente');
            $table->text('notas')->nullable();

            $table->timestamps();

            // CLAVES FORÁNEAS
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            $table->foreign('id_sucursal')->references('id_sucursal')->on('sucursales');
            $table->unique(['id_usuario', 'fecha_hora_inicio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
