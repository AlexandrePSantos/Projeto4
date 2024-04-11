<?php

namespace App\Http\Controllers;

use App\Models\TipoContrato;
use Illuminate\Http\Request;

class TipoContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposContrato = TipoContrato::all();
        return view('tipo_contrato.index', compact('tiposContrato'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_contrato.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipoContrato = TipoContrato::create($request->all());
        return redirect()->route('tipo_contrato.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoContrato $tipoContrato)
    {
        return view('tipo_contrato.show', compact('tipoContrato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoContrato $tipoContrato)
    {
        return view('tipo_contrato.edit', compact('tipoContrato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoContrato $tipoContrato)
    {
        $tipoContrato->update($request->all());
        return redirect()->route('tipo_contrato.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoContrato $tipoContrato)
    {
        if ($tipoContrato->imoveis()->exists()) {
            return back()->withErrors(['TipoContrato' => 'Não é possível apagar o tipo de contrato quando está a ser usado por um ou mais imóveis.']);
        }

        $tipoContrato->delete();
        return redirect()->route('tipo_contrato.index');
    }
}
