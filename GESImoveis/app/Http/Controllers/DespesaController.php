<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Despesa;
use App\Models\Imovel;
use App\Models\Inquilino;
use App\Models\Pagamento;
use App\Models\TipoContrato;
use App\Models\TipoDespesa;
use App\Models\TipoImovel;
use App\Models\User;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $despesas = Despesa::all();
        return view('despesa.index', compact('despesas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('despesa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $despesa = Despesa::create($request->all());
        return redirect()->route('despesa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Despesa $despesa)
    {
        return view('despesa.show', compact('despesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Despesa $despesa)
    {
        return view('despesa.edit', compact('despesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Despesa $despesa)
    {
        $despesa->update($request->all());
        return redirect()->route('despesa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Despesa $despesa)
    {
        $despesa->delete();
        return redirect()->route('despesa.index');
    }
}
