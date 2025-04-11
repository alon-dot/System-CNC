<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Acabadol
 *
 * @property $id
 * @property $material_herramienta
 * @property $materia_prima
 * @property $diametro_herramienta
 * @property $numero_dientes
 * @property $velocidad_corte
 * @property $rpm
 * @property $avance_corte
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Acabadol extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['material_herramienta', 'materia_prima', 'diametro_herramienta', 'numero_dientes', 'velocidad_corte', 'rpm', 'avance_corte'];


}
