<?php

namespace App\Http\Controllers;

use App\Models\Sobre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SobreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SobreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sobres = Sobre::paginate();

        return view('sobre.index', compact('sobres'))
            ->with('i', ($request->input('page', 1) - 1) * $sobres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sobre = new Sobre();

        return view('sobre.create', compact('sobre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SobreRequest $request): RedirectResponse
    {
        Sobre::create($request->validated());

        return Redirect::route('sobres.index')
            ->with('success', 'Sobre created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sobre = Sobre::find($id);

        return view('sobre.show', compact('sobre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $sobre = Sobre::find($id);

        return view('sobre.edit', compact('sobre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SobreRequest $request, Sobre $sobre): RedirectResponse
    {
        $sobre->update($request->validated());

        return Redirect::route('sobres.index')
            ->with('success', 'Sobre updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Sobre::find($id)->delete();

        return Redirect::route('sobres.index')
            ->with('success', 'Sobre deleted successfully');
    }
}
