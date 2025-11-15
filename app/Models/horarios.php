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

    public function rangos()
    {
        return $this->hasMany(rangoHorarios::class, 'id_rango_horario', 'id_horario');
    }
}
