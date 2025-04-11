<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desbaste extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_herramienta',
        'materia_prima',
        'diametro_herramienta',
        'numero_dientes',
        'velocidad_corte',
        'avance_por_diente',
        'rpm', // Si deseas que se guarde también en la base de datos
        'avance_corte' // Si deseas que se guarde también en la base de datos
    ];
}
