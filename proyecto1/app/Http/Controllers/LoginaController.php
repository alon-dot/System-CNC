<?php

namespace App\Http\Controllers;

use App\Models\Logina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; // Esta línea debe estar aquí, fuera de la clase

class LoginaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $loginas = Logina::paginate();

        return view('logina.index', compact('loginas'))
            ->with('i', ($request->input('page', 1) - 1) * $loginas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $logina = new Logina();

        return view('logina.create', compact('logina'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginaRequest $request): RedirectResponse
    {
        Logina::create($request->validated());

        return Redirect::route('loginas.index')
            ->with('success', 'Logina created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $logina = Logina::find($id);

        return view('logina.show', compact('logina'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $logina = Logina::find($id);

        return view('logina.edit', compact('logina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoginaRequest $request, Logina $logina): RedirectResponse
    {
        $logina->update($request->validated());

        return Redirect::route('loginas.index')
            ->with('success', 'Logina updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

     // Destruir sesión
    public function destroy($id): RedirectResponse
    {
        Logina::find($id)->delete();

        return Redirect::route('loginas.index')
            ->with('success', 'Logina deleted successfully');
    }

    /**
     * Display the login form.
     */
    public function form()
    {
        return view('logina.form');
    }

    /**
     * Log the user out and redirect.
     */
    public function logout()
{
    Auth::logout();
    return redirect()->route('welcome'); 
}

}