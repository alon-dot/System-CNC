<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acabado extends Model
{
    use HasFactory;

    // Permitir la asignación masiva de estos atributos
    protected $fillable = [
        'material_herramienta',
        'materia_prima',
        'diametro_herramienta',
        'numero_dientes',
        'velocidad_corte',
        'avance_por_diente',
        'rpm',           // Este campo se calcula en el controlador
        'avance_corte',  // Este campo se calcula en el controlador
    ];
}
