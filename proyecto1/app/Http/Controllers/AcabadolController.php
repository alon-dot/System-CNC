<?php

namespace App\Http\Controllers;

use App\Models\Acabadol;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AcabadolRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AcabadolController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index(Request $request)
    {
        $query = Acabadol::query();
    
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('material_herramienta', 'like', "%{$search}%")
                  ->orWhere('materia_prima', 'like', "%{$search}%")
                  ->orWhere('diametro_herramienta', 'like', "%{$search}%");
        }
    
        $acabadols = $query->paginate(10);
    
        // Retorna una vista parcial si la solicitud es AJAX
        if ($request->ajax()) {
            return view('acabadol.partials.table', compact('acabadols'))->render();
        }
    
        return view('acabadol.index', compact('acabadols'));
    }
     
    


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $acabadol = new Acabadol();

        return view('acabadol.create', compact('acabadol'));
    }

    public function store(Request $request)
{
    // Validate the input data
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


    // Create the acabado object and assign values
    $acabadol = new Acabadol();
    $acabadol->material_herramienta = $request->material_herramienta;
    $acabadol->materia_prima = $request->materia_prima;
    $acabadol->diametro_herramienta = $request->diametro_herramienta;
    $acabadol->numero_dientes = $request->numero_dientes; // Number of flutes
    $acabadol->velocidad_corte = $velocidad_corte;

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
            return redirect()->route('acabadols.create')->withErrors([
                'materia_prima' => 'El material seleccionado no tiene un factor de avance definido.'
            ]);
    }

    // Check if feed_rate_factor was set correctly
    if ($feed_rate_factor === null) {
        return redirect()->route('acabadols.create')->withErrors([
            'materia_prima' => 'El material seleccionado no tiene un factor de avance definido.'
        ]);
    }

    // Calculate RPM and feed rate using the selected factor
    $rpm = floor(($velocidad_corte * 1000) / (3.14159265358979 * $request->diametro_herramienta));
    $avance_corte = floor($rpm * $request->numero_dientes * $feed_rate_factor);

    // Guardar los valores en el objeto acabado
    $acabadol->rpm = $rpm;
    $acabadol->avance_corte = $avance_corte;
    $acabadol->save();

    // Redirigir con los valores calculados
    return redirect()->route('acabadols.create')->with([
        'rpm' => $rpm,
        'avance_corte' => $avance_corte,
        'status' => 'Operación de acabado creada exitosamente!',
    ]);
}


    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $acabadol = Acabadol::find($id);

        return view('acabadol.show', compact('acabadol'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $acabadol = Acabadol::find($id);

        return view('acabadol.edit', compact('acabadol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcabadolRequest $request, Acabadol $acabadol): RedirectResponse
    {
        $acabadol->update($request->validated());

        return Redirect::route('acabadols.index')
            ->with('success', 'Acabadol updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Acabadol::find($id)->delete();

        return Redirect::route('acabadols.index')
            ->with('success', 'Acabadol deleted successfully');
    }
}
