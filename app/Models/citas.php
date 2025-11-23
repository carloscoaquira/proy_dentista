<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citas extends Model
{
    use HasFactory;

    // Nombre de la tabla (por si acaso, aunque coincide)
    protected $table = 'citas';

    // Clave primaria
    protected $primaryKey = 'id_cita';

    // Si tu clave primaria es autoincremental y entero (lo es por defecto), no hace falta tocar $incrementing ni $keyType

    // Campos que se pueden asignar de forma masiva (create, fill, update)
    protected $fillable = [
        'id_cliente',
        'id_usuario',        // doctor
        'id_sucursal',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'estado',
        'notas',
    ];

    // Si usas timestamps (created_at, updated_at) en la tabla, esto ya viene true por defecto.
    // public $timestamps = true;

    // Opcional: castear las fechas si quieres que Eloquent las trate como Carbon
    protected $casts = [
        'fecha_hora_inicio' => 'datetime',
        'fecha_hora_fin'    => 'datetime',
    ];
}
