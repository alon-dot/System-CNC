<?php
namespace App\Http\Controllers;

use App\Models\Acabado;
use Illuminate\Http\Request;

class AcabadoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Filtrar y paginar los resultados
        $acabados = Acabado::when($search, function ($query, $search) {
            return $query->where('material_herramienta', 'like', "%{$search}%")
                         ->orWhere('materia_prima', 'like', "%{$search}%")
                         ->orWhere('diametro_herramienta', 'like', "%{$search}%")
                         ->orWhere('numero_dientes', 'like', "%{$search}%");
        })->paginate(10);

        if ($request->ajax()) {
            return view('acabados.partials.table', compact('acabados'))->render();
        }

        return view('acabados.index', compact('acabados', 'search'));
    }

    public function create()
    {
        return view('acabados.create');
    }

    public function store(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'material_herramienta' => 'required|string',
        'materia_prima' => 'required|string',
        'diametro_herramienta' => 'required|numeric',
        'numero_dientes' => 'required|integer', // Número de dientes
    ]);

    // Asignar velocidad de corte automáticamente según la materia prima seleccionada
    $velocidad_corte = null;

    switch ($request->materia_prima) {
        case 'Aluminio aleado al magnesio-silicio 6061 T6':
            $velocidad_corte = 75;
            break;
        case 'Aluminio aleado al cobre 2024 T3':
            $velocidad_corte = 50;
            break;
        case 'Aluminio aleado al magnesio 5052 T4':
            $velocidad_corte = 48;
            break;
        case 'Aluminio aleado al zinc 7075 T651':
        case 'Acero de bajo contenido de carbono 1018':
            $velocidad_corte = 45;
            break;
        case 'Acero de medio contenido de carbono 1045':
        case 'Acero aleado al níquel-cromo-molibdeno 8620':
            $velocidad_corte = 30;
            break;  
        case 'Acero de alto contenido de carbono 1060':
        case 'Acero aleado al cromo-molibdeno  4140':
        case 'Acero grado herramienta A2':
        case 'Acero grado herramienta D2':
        case 'Acero grado herramienta H13':
        case 'Acero grado herramienta P20':
        case 'Acero grado herramienta O1': 
            $velocidad_corte = 20;
            break;
        case 'Acero aleado al cromo 5120':
            $velocidad_corte = 40;
            break;
        case 'Acero Inoxidable Ferrítico 409':
        case'Acero Inoxidable Martensítico AISI 416':
        case'Acero Inoxidable Austenítico 304':
            $velocidad_corte = 25;
            break;
        case 'Acero estructural A36':
            $velocidad_corte = 37;
            break;
        case 'Acero grado herramienta W1':
            $velocidad_corte = 22;
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

    // Crear el objeto Acabado y asignar valores
    $acabado = new Acabado();
    $acabado->material_herramienta = $request->material_herramienta;
    $acabado->materia_prima = $request->materia_prima;
    $acabado->diametro_herramienta = $request->diametro_herramienta;
    $acabado->numero_dientes = $request->numero_dientes; // Número de dientes
    $acabado->velocidad_corte = $velocidad_corte;

    // Define the feed rate factor based on materia_prima selection
    $feed_rate_factor = null; // Start with a null value to ensure explicit setting
    
    switch ($request->materia_prima) {
        case 'Acero de bajo contenido de carbono 1018':
        case 'Acero de medio contenido de carbono 1045': 
        case 'Acero aleado al cromo 5120': 
        case 'Acero aleado al níquel-cromo-molibdeno 8620':
        case 'Acero estructural A36':    
            $feed_rate_factor = 0.03;
            break;
        case 'Acero de alto contenido de carbono 1060':
        case 'Acero Inoxidable Martensítico AISI 416':
        case 'Acero grado herramienta A2':
        case 'Acero grado herramienta W1':
        case 'Acero grado herramienta O1':
            $feed_rate_factor = 0.02;
            break;
        case 'Acero aleado al cromo-molibdeno  4140':
        case 'Acero Inoxidable Ferrítico 409':
        case 'Acero grado herramienta H13':
            $feed_rate_factor = 0.025;
            break;

        case 'Acero grado herramienta D2':
            $feed_rate_factor = 0.018;
            break;    
        case 'Acero Inoxidable Austenítico 304':
            $feed_rate_factor = 0.0225;
            break;
        case 'Aluminio aleado al magnesio-silicio 6061 T6':
        case 'Aluminio aleado al cobre 2024 T3':
        case 'Aluminio aleado al magnesio 5052 T4':
        case 'Aluminio aleado al zinc 7075 T651':
        case 'Acero grado herramienta P20':
            $feed_rate_factor = 0.015;
            break;
        // Optionally, add more cases for other materials if needed
        default:
            return redirect()->route('acabados.create')->withErrors([
                'materia_prima' => 'El material seleccionado no tiene un factor de avance definido.'
            ]);
    }

    // Check if feed_rate_factor was set correctly
    if ($feed_rate_factor === null) {
        return redirect()->route('acabados.create')->withErrors([
            'materia_prima' => 'El material seleccionado no tiene un factor de avance definido.'
        ]);
    }

    // Calcular RPM y avance de corte
    $rpm = floor(($velocidad_corte * 1000) / (3.14159265358979 * $request->diametro_herramienta));
    $avance_corte = floor($rpm * $request->numero_dientes * $feed_rate_factor);

    // Guardar los valores en el objeto acabado
    $acabado->rpm = $rpm;
    $acabado->avance_corte = $avance_corte;
    $acabado->save();

    
    // Redirigir con los valores calculados
    return redirect()->route('acabados.create')->with([
        'rpm' => $rpm,
        'avance_corte' => $avance_corte,
        'status' => 'Operación de acabado creada exitosamente!',
    ]);
}


public function update(Request $request, Acabado $acabado)
{
    $request->validate([
        'material_herramienta' => 'required|string',
        'materia_prima' => 'required|string',
        'diametro_herramienta' => 'required|numeric',
        'numero_dientes' => 'required|integer',
        'velocidad_corte' => 'required|numeric',
    ]);

    // Calcular RPM y Avance de Corte solo con la parte entera
    $rpm = floor(($request->velocidad_corte * 1000) / (3.14159265358979 * $request->diametro_herramienta));
    $avance_corte = floor($rpm * $request->numero_dientes * 0.015);

    $acabado->update(array_merge($request->except('avance_por_diente'), [
        'rpm' => $rpm,
        'avance_corte' => $avance_corte,
    ]));

    return redirect()->route('acabados.index')->with('status', 'Operación de acabado actualizada exitosamente!');
}


    public function destroy(Acabado $acabado)
    {
        $acabado->delete();
        return redirect()->route('acabados.index')->with('status', 'Operación de acabado eliminada exitosamente!');
    }

    public function show($id)
    {
        $acabado = Acabado::findOrFail($id);
        return response()->json($acabado);
    }
}
