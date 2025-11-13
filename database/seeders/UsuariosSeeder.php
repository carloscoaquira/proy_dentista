<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenemos IDs de roles
        $idRolAdmin        = DB::table('roles')->where('nombre', 'admin')->value('id_rol');
        $idRolDoctor       = DB::table('roles')->where('nombre', 'doctor')->value('id_rol');
        $idRolRecepcionista = DB::table('roles')->where('nombre', 'recepcionista')->value('id_rol');

        // Sucursales
        $idSucursalCentral = DB::table('sucursales')->where('nombre', 'Sucursal Central')->value('id_sucursal');
        $idSucursalNorte   = DB::table('sucursales')->where('nombre', 'Sucursal Norte')->value('id_sucursal');

        DB::table('usuarios')->insert([
            [
                'nombre'      => 'Carlos',
                'apellido'    => 'Admin',
                'email'       => 'admin@dental.com',
                'telefono'    => '70010001',
                'password'    => Hash::make('admin123'), // login
                'id_rol'      => $idRolAdmin,
                'id_sucursal' => $idSucursalCentral,
                'estado'      => true,
                'remember_token' => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nombre'      => 'Ana',
                'apellido'    => 'Pérez',
                'email'       => 'ana.doctor@dental.com',
                'telefono'    => '70010002',
                'password'    => Hash::make('doctor123'),
                'id_rol'      => $idRolDoctor,
                'id_sucursal' => $idSucursalCentral,
                'estado'      => true,
                'remember_token' => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nombre'      => 'Luis',
                'apellido'    => 'García',
                'email'       => 'luis.doctor@dental.com',
                'telefono'    => '70010003',
                'password'    => Hash::make('doctor123'),
                'id_rol'      => $idRolDoctor,
                'id_sucursal' => $idSucursalNorte,
                'estado'      => true,
                'remember_token' => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nombre'      => 'María',
                'apellido'    => 'López',
                'email'       => 'maria.recep@dental.com',
                'telefono'    => '70010004',
                'password'    => Hash::make('recep123'),
                'id_rol'      => $idRolRecepcionista,
                'id_sucursal' => $idSucursalCentral,
                'estado'      => true,
                'remember_token' => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
