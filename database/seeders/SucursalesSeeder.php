<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sucursales')->insert([
            [
                'nombre'     => 'Sucursal Central',
                'direccion'  => 'Av. Principal 123',
                'ciudad'     => 'La paz',
                'telefono'   => '70000001',
                'estado'     => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre'     => 'Sucursal el alto',
                'direccion'  => 'Calle Secundaria 456',
                'ciudad'     => 'El Alto',
                'telefono'   => '70000002',
                'estado'     => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
