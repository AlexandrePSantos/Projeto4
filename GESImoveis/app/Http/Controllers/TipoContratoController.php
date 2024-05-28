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

use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:tipo_contrato',
        ]);

        if ($validator->fails()) {
            return redirect('tipo_contrato/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The TipoContrato is valid, store it in the database...
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
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:tipo_contrato,tipo,' . $tipoContrato->id,
        ]);

        if ($validator->fails()) {
            return redirect('tipo_contrato/' . $tipoContrato->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The TipoContrato is valid, update it in the database...
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
