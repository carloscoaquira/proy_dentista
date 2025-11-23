<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horarios extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    protected $primaryKey = 'id_horario';

    protected $fillable = [
        'id_doctor',
        'dia_semana',
        'activo',
    ];

    /**
     * Rangos horarios asociados a este horario
     */
    public function rangos()
    {
        // foreignKey = columna en rango_horarios
        // localKey   = columna en horarios
        return $this->hasMany(rangoHorarios::class, 'id_horario', 'id_horario');
    }

    /**
     * Doctor al que pertenece este horario
     */
    public function doctor()
    {
        return $this->belongsTo(usuarios::class, 'id_doctor', 'id_usuario');
    }
}
