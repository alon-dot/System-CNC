<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculoController extends Controller
{
    public function calcular(Request $request)
    {
        // Obtenemos los datos del formulario
        $materialHerramienta = $request->input('materialHerramienta');
        $materiaPrima = $request->input('materiaPrima');
        $diametroHerramienta = $request->input('diametroHerramienta');
        $numeroFilos = $request->input('numeroFilos');
        $velocidadCorte = $request->input('velocidadCorte');
        $avancePorDiente = $request->input('avancePorDiente');

        // Cálculo del RPM
        $rpm = ($velocidadCorte * 1000) / (pi() * $diametroHerramienta);

        // Cálculo del avance de corte
        $avanceCorte = $avancePorDiente * $numeroFilos * $rpm;

        // Devolvemos los resultados
        return view('calculo.resultado', [
            'rpm' => round($rpm, 2),
            'avanceCorte' => round($avanceCorte, 2)
        ]);
    }
}
