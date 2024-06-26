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
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:tipo_despesa',
        ]);

        if ($validator->fails()) {
            return redirect('tipo_despesa/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The TipoDespesa is valid, store it in the database...
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
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:tipo_despesa,tipo,' . $tipoDespesa->id,
        ]);

        if ($validator->fails()) {
            return redirect('tipo_despesa/' . $tipoDespesa->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The TipoDespesa is valid, update it in the database...
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
