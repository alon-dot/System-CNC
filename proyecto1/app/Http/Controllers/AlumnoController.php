<?php


namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AlumnoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search'); // Obtener el término de búsqueda

        // Obtener los alumnos con paginación de 10 registros por página
        $alumnos = Alumno::when($search, function ($query, $search) {
            return $query->where('matricula', 'LIKE', "%{$search}%"); // Búsqueda por matrícula
        })->paginate(10);

        return view('alumno.index', compact('alumnos'))
            ->with('i', ($request->input('page', 1) - 1) * $alumnos->perPage()); // Calcular el índice para la paginación
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $alumno = new Alumno();

        return view('alumno.create', compact('alumno'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlumnoRequest $request): RedirectResponse
    {
        // Validación de los datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'usuario' => 'required|string|max:255',
        'matricula' => 'required|string|max:255',
        'cuatrimestre' => 'required|string|max:255',
    ]);

    // Creación del alumno
    Alumno::create($request->all());

    // Redirigir con mensaje de éxito
    return redirect()->route('alumnos.index')
        ->with('success', 'Alumno creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $alumno = Alumno::find($id);

        return view('alumno.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $alumno = Alumno::find($id);

        return view('alumno.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlumnoRequest $request, Alumno $alumno): RedirectResponse
    {
        $alumno->update($request->validated());

        return Redirect::route('alumnos.index')
            ->with('success', 'Alumno actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Alumno::find($id)->delete();

        return Redirect::route('alumnos.index')
            ->with('success', 'Alumno eliminado exitosamente');
    }

    /**
     * Verificar si el alumno existe según el usuario y la matrícula.
     */
    public function verificar(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'usuario' => 'required|string',
            'matricula' => 'required|string',
        ]);

        // Buscar al alumno basado en el usuario y matrícula
        $alumno = Alumno::where('usuario', $request->usuario)
                        ->where('matricula', $request->matricula)
                        ->first();

        // Devolver respuesta JSON
        return response()->json(['exists' => $alumno ? true : false]);
    }
}
