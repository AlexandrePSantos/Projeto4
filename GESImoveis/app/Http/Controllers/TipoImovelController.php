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

class TipoImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposImovel = TipoImovel::all();
        return view('tipo_imovel.index', compact('tiposImovel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_imovel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:tipo_imovel',
        ]);

        if ($validator->fails()) {
            return redirect('tipo_imovel/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The TipoImovel is valid, store it in the database...
        $tipoImovel = TipoImovel::create($request->all());
        return redirect()->route('tipo_imovel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoImovel $tipoImovel)
    {
        return view('tipo_imovel.show', compact('tipoImovel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoImovel $tipoImovel)
    {
        return view('tipo_imovel.edit', compact('tipoImovel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoImovel $tipoImovel)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:tipo_imovel,tipo,' . $tipoImovel->id,
        ]);

        if ($validator->fails()) {
            return redirect('tipo_imovel/' . $tipoImovel->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The TipoImovel is valid, update it in the database...
        $tipoImovel->update($request->all());
        return redirect()->route('tipo_imovel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoImovel $tipoImovel)
    {
        if ($tipoImovel->imoveis()->exists()) {
            return back()->withErrors(['TipoImovel' => 'Não é possível apagar o tipo de imóvel quando está a ser usado por um ou mais imóveis.']);
        }

        $tipoImovel->delete();
        return redirect()->route('tipo_imovel.index');
    }
}
