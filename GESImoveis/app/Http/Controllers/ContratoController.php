<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contrato = Contrato::all();
        return view('contrato.index', compact('contrato'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contrato.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contrato = Contrato::create($request->all());
        return redirect()->route('contrato.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contrato = Contrato::find($id);

        if (!$contrato) {
            // Handle the case where no contrato with the given ID was found
            return redirect()->route('contrato.index');
        }

        return view('contrato.show', compact('contrato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        return view('contrato.edit', compact('contrato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        $contrato->update($request->all());
        return redirect()->route('contrato.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        $contrato->delete();
        return redirect()->route('contrato.index');
    }
}
