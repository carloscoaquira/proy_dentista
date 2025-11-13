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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');

            $table->string('nombre', 120);
            $table->string('apellido', 120)->nullable();

            $table->string('email', 150)->unique();
            $table->string('telefono', 32)->nullable();
            $table->string('password');

            $table->unsignedBigInteger('id_rol');
            $table->unsignedBigInteger('id_sucursal')->nullable();

            $table->boolean('estado')->default(true);

            $table->rememberToken();
            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('id_rol')->references('id_rol')->on('roles');
            $table->foreign('id_sucursal')->references('id_sucursal')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
