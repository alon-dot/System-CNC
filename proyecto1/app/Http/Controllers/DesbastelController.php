<?php

namespace App\Http\Controllers;

use App\Models\Desbastel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DesbastelRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DesbastelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Desbastel::query();
    
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('material_herramienta', 'like', "%{$search}%")
                  ->orWhere('materia_prima', 'like', "%{$search}%")
                  ->orWhere('diametro_herramienta', 'like', "%{$search}%");
        }
    
        $desbastels = $query->paginate(10);
    
        // Retorna una vista parcial si la solicitud es AJAX
        if ($request->ajax()) {
            return view('desbastel.partials.table', compact('desbastels'))->render();
        }
    
        return view('desbastel.index', compact('desbastels'));
    }

    

    

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $desbastel = new Desbastel();

        return view('desbastel.create', compact('desbastel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos sin 'avance_por_diente'
        $request->validate([
            'material_herramienta' => 'required|string',
            'materia_prima' => 'required|string',
            'diametro_herramienta' => 'required|numeric',
            'numero_dientes' => 'required|integer',
        ]);

        // Asignar velocidad de corte automáticamente según la materia prima seleccionada
    $velocidad_corte = null;

    switch ($request->materia_prima) {
        case 'Aluminio aleado al magnesio-silicio 6061 T6':
            $velocidad_corte = 100;
            break;
        case 'Aluminio aleado al cobre 2024 T3':
            $velocidad_corte = 70;
            break;
        case 'Aluminio aleado al magnesio 5052 T4':
            $velocidad_corte = 65;
            break;
        case 'Aluminio aleado al zinc 7075 T651':
        case 'Acero de bajo contenido de carbono 1018':
            $velocidad_corte = 60;
            break;
        case 'Acero de medio contenido de carbono 1045':
        case 'Acero aleado al cromo-molibdeno  4140':
        case 'Acero estructural A36':
            $velocidad_corte = 45;
            break;  
        case 'Acero grado herramienta O1': 
            $velocidad_corte = 42;
            break;
        case 'Acero de alto contenido de carbono 1060':
        case 'Acero Inoxidable Ferrítico 409':
        case 'Acero grado herramienta A2':
        case 'Acero grado herramienta D2':
        case 'Acero grado herramienta P20':
            $velocidad_corte = 40;
            break;
        case'Acero Inoxidable Austenítico 304':
            $velocidad_corte = 35;
            break;
        case 'Acero grado herramienta H13':
            $velocidad_corte = 43;
            break;  
        case 'Acero aleado al cromo 5120':
        case 'Acero grado herramienta W1':
            $velocidad_corte = 50;
            break;
        case 'Acero aleado al níquel-cromo-molibdeno 8620':
            $velocidad_corte = 48;
            break;
        case'Acero Inoxidable Martensítico AISI 416':
            $avance_corte = 30;
            break;
        default:
            $velocidad_corte = null;
            break;
    }

    // Validar si la velocidad de corte fue asignada
    if ($velocidad_corte === null) {
        return redirect()->route('acabados.create')->withErrors([
            'materia_prima' => 'El material seleccionado no tiene una velocidad de corte definida.',
        ]);
    }



        // Crear el desbastel
        $desbastel = new Desbastel();
        $desbastel->material_herramienta = $request->material_herramienta;
        $desbastel->materia_prima = $request->materia_prima;
        $desbastel->diametro_herramienta = $request->diametro_herramienta;
        $desbastel->numero_dientes = $request->numero_dientes;
        $desbastel->velocidad_corte = $velocidad_corte;
    
        // Calcular RPM
        $rpm = floor(($velocidad_corte * 1000) / (3.14159265358979 * $request->diametro_herramienta));
    
        // Determinar avance por diente según materia prima y diámetro
        $avance_por_diente = 0.05; // Valor por defecto
    
        if ($request->materia_prima == 'Acero estructural A36') {
            $avance_por_diente = 0.075;

        } elseif ($request->materia_prima == 'Acero grado herramienta A2') {
            $avance_por_diente = 0.075;

        } elseif ($request->materia_prima == 'Acero grado herramienta W1') {
            $avance_por_diente = 0.075;

        }elseif ($request->materia_prima == 'Acero grado herramienta D2') {
            $avance_por_diente = 0.075;

    }elseif ($request->materia_prima == 'Acero grado herramienta H13') {
        $avance_por_diente = 0.075;

} elseif ($request->materia_prima == 'Acero grado herramienta P20') {
    $avance_por_diente = 0.08;

}elseif ($request->materia_prima == 'Acero grado herramienta O1') {
        $avance_por_diente = 0.07;

    }
        
        
        // Calcular Avance de Corte usando el avance por diente determinado
        $avance_corte = floor($rpm * $request->numero_dientes * $avance_por_diente);

    


        // Calcular Profundidad máxima de corte
        $profundidad_maxima = null;
if ($request->materia_prima == 'Aluminio aleado al magnesio-silicio 6061 T6') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = 3; // Decimal value
            break;
        case 4.7625:
            $profundidad_maxima = 6; // Decimal value
            break;
        case 6.35:
            $profundidad_maxima = 10; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 15; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 18; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 20; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 23; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 25; // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
} elseif ($request->materia_prima == 'Aluminio aleado al cobre 2024 T3') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = 1.5; // Decimal value
            break;
        case 4.7625:
            $profundidad_maxima = 3; // Decimal value
            break;
        case 6.35:
            $profundidad_maxima = 6; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 9; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 10; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 12; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 15; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 17; // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
} elseif ($request->materia_prima == 'Aluminio aleado al magnesio 5052 T4') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = 1.2; // Decimal value
            break;
        case 4.7625:
            $profundidad_maxima = number_format(2.20, 2);
            break;
        case 6.35:
            $profundidad_maxima = 4; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 7; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 8; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 10; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 12; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 13; // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
} elseif ($request->materia_prima == 'Aluminio aleado al zinc 7075 T651') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = 0.9; // Decimal value
            break;
        case 4.7625:
            $profundidad_maxima = 1.5; // Decimal value
            break;
        case 6.35:
            $profundidad_maxima = 3.7; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 5; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 6.2; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 7.8; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 9.5; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 10.5; // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }

}elseif ($request->materia_prima == 'Acero de bajo contenido de carbono 1018') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = 0.5; // Decimal value
            break;
        case 4.7625:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 6.35:
            $profundidad_maxima = 1.3; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1.8; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 2.2; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 2.5; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(2.75, 2);
            break;
        case 25.4000:
            $profundidad_maxima = number_format(2.35, 2); // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero de medio contenido de carbono 1045') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.25, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.52, 2);
            break;
        case 6.35:
            $profundidad_maxima = 0.8; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 1.3; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 1.5; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 1.7; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 1.9; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero de alto contenido de carbono 1060') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.13, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.26, 2);
            break;
        case 6.35:
            $profundidad_maxima = number_format(0.45, 2); // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = number_format(0.65, 2); // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = number_format(0.78, 2); // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = number_format(0.91, 2); // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = number_format(1.17, 2); // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero aleado al cromo-molibdeno  4140') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.25, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.58, 2);
            break;
        case 6.35:
            $profundidad_maxima = 0.9; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1.2; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 1.5; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 1.8; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 1.9; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 2.2; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero aleado al cromo-molibdeno  4140') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.25, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.58, 2);
            break;
        case 6.35:
            $profundidad_maxima = 0.9; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1.2; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 1.5; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 1.8; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 1.9; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 2.2; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero aleado al cromo 5120') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.28, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.65, 2);
            break;
        case 6.35:
            $profundidad_maxima = number_format(0.95, 2); // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1.3; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 1.6; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 1.9; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 2.1; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 2.3; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero aleado al níquel-cromo-molibdeno 8620') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.23, 2);
            break;
        case 4.7625:
            $profundidad_maxima = 0.5;
            break;
        case 6.35:
            $profundidad_maxima = number_format(0.75, 2); // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 1.3; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 1.5; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(1.75, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 1.9; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero Inoxidable Ferrítico 409') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.21, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.45, 2);
            break;
        case 6.35:
            $profundidad_maxima = number_format(0.65, 2); // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = number_format(1.25, 2); // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 1.5; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(1.65, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = number_format(1.75, 2); // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero Inoxidable Martensítico AISI 416') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.15, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.32, 2);
            break;
        case 6.35:
            $profundidad_maxima = 0.5; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 0.7; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 0.9; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(1.12, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = number_format(1.225, 2); // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero Inoxidable Austenítico 304') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.18, 2);
            break;
        case 4.7625:
            $profundidad_maxima = 0.4;
            break;
        case 6.35:
            $profundidad_maxima = 0.6; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = number_format(0.85, 2); // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 1.1; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = number_format(1.25, 2); // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(1.35, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 1.5; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero estructural A36') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.31, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.65, 2);
            break;
        case 6.35:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 1.3; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 1.6; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 2; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 2.2; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 2.5; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero grado herramienta A2') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.075, 3);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.17, 2);
            break;
        case 6.35:
            $profundidad_maxima = number_format(0.25, 2); // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = number_format(0.35, 2); // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = number_format(0.43, 2); // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 0.5; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(0.56, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = number_format(0.62, 2); // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero grado herramienta W1') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = 0.1;
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.25, 2);
            break;
        case 6.35:
            $profundidad_maxima = 0.4; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = number_format(0.55, 2); // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = number_format(0.65, 2); // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = 0.8; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(0.85, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = number_format(0.98, 2); // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero grado herramienta D2') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.06, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.16, 2);
            break;
        case 6.35:
            $profundidad_maxima = number_format(0.25, 2); // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = number_format(0.33, 2); // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 0.4; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = number_format(0.45, 2); // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = 0.5; // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 0.6; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero grado herramienta H13') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.08, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.21, 2);
            break;
        case 6.35:
            $profundidad_maxima = 0.3; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = number_format(0.42, 2); // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 0.5; // Decimal value
            break;
        case 15.8750:
            $profundidad_maxima = number_format(0.62, 2); // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(0.68, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = number_format(0.75, 2); // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero grado herramienta P20') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.15, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.35, 2);
            break;
        case 6.35:
            $profundidad_maxima = 0.5; // Decimal value
            break;
        case 9.525:
            $profundidad_maxima = 0.7; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = number_format(0.85, 2);
            break;
        case 15.8750:
            $profundidad_maxima = 1; // Decimal value
            break;
        case 19.05:
            $profundidad_maxima = number_format(1.12, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 1.2; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}elseif ($request->materia_prima == 'Acero grado herramienta O1') {
    switch ($request->diametro_herramienta) {
        case 3.175:
            $profundidad_maxima = number_format(0.07, 2);
            break;
        case 4.7625:
            $profundidad_maxima = number_format(0.18, 2);
            break;
        case 6.35:
            $profundidad_maxima = number_format(0.24, 2);
            break;
        case 9.525:
            $profundidad_maxima = 0.3; // Decimal value
            break;
        case 12.7:
            $profundidad_maxima = 0.4;
            break;
        case 15.8750:
            $profundidad_maxima = number_format(0.47, 2);
            break;
        case 19.05:
            $profundidad_maxima = number_format(0.55, 2); // Decimal value
            break;
        case 25.4000:
            $profundidad_maxima = 0.6; // Decimal value // Decimal value
            break;        
        default:
            $profundidad_maxima = 'N/A';
            break;
    }
    
}

//Fin de profundidad de corte 
    
        // Guardar el objeto de desbaste
        $desbastel->rpm = $rpm;
        $desbastel->avance_corte = $avance_corte;
        $desbastel->profundidad_maxima = $profundidad_maxima; // Nuevo campo
        $desbastel->save();
    
        return redirect()->route('desbastels.create')->with([
            'rpm' => $rpm,
            'avance_corte' => $avance_corte,
            'profundidad_maxima' => $profundidad_maxima, // Enviar el valor a la vista
            'status' => 'Operación de desbaste creada exitosamente!'
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $desbastel = Desbastel::find($id);

        return view('desbastel.show', compact('desbastel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $desbastel = Desbastel::find($id);

        return view('desbastel.edit', compact('desbastel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesbastelRequest $request, Desbastel $desbastel): RedirectResponse
    {
        $desbastel->update($request->validated());

        return Redirect::route('desbastels.index')
            ->with('success', 'Desbastel updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Desbastel::find($id)->delete();

        return Redirect::route('desbastels.index')
            ->with('success', 'Desbastel deleted successfully');
    }
}
