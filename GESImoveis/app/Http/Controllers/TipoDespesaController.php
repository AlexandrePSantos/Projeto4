<?php

namespace App\Http\Controllers;

use App\Models\TipoDespesa;
use Illuminate\Http\Request;

class TipoDespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposDespesa = TipoDespesa::all();
        return view('tipo_despesa.index', compact('tiposDespesa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_despesa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipoDespesa = TipoDespesa::create($request->all());
        return redirect()->route('tipo_despesa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoDespesa $tipoDespesa)
    {
        return view('tipo_despesa.show', compact('tipoDespesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoDespesa $tipoDespesa)
    {
        return view('tipo_despesa.edit', compact('tipoDespesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoDespesa $tipoDespesa)
    {
        $tipoDespesa->update($request->all());
        return redirect()->route('tipo_despesa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoDespesa $tipoDespesa)
    {
        if ($tipoDespesa->despesas()->exists()) {
            return back()->withErrors(['TipoDespesa' => 'Não é possível apagar o tipo de despesa quando está a ser usado por uma ou mais despesas.']);
        }

        $tipoDespesa->delete();
        return redirect()->route('tipo_despesa.index');
    }
}
