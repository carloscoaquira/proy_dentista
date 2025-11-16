<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'nombre'        => 'Juan',
                'apellido'      => 'Pérez',
                'nro_documento' => '1234567',
                'email'        => 'juan@example.com',
                'telefono'      => '70020001',
                'password'      => 'pass1',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nombre'        => 'Lucía',
                'apellido'      => 'Martínez',
                'nro_documento' => '7654321',
                'email'        => 'lucia@example.com',
                'telefono'      => '70020002',
                'password'      => 'pass2',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
