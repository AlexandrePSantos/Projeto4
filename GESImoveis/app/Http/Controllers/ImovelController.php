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
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'proprietario') {
            $imoveis = Imovel::where('id_user', Auth::id())->get();
        } else {
            $imoveis = Imovel::all();
        }

        return view('imoveis.index', compact('imoveis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposImovel = TipoImovel::all();
        return view('imoveis.create', compact('tiposImovel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'endereco' => 'required|unique:imovel',
            'tipo_imovel_id' => 'required|exists:tipo_imovel,id',
            'preco_compra' => 'required|gt:0',
            'area' => 'required|gt:0',
            'val_seguro' => 'required|gte:0',
            'val_imi' => 'required|gte:0',
            'val_condominio' => 'required|gte:0',
        ]);

        if ($validator->fails()) {
            return redirect('imoveis/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Imovel is valid, store it in the database...
        $imovel = Imovel::create($request->all());
        return redirect()->route('imoveis.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Imovel $imovel)
    {
        if (Auth::user()->role == 'proprietario' && $imovel->id_user != Auth::id()) {
            return redirect()->route('imoveis.index');
        }

        return view('imoveis.show', compact('imovel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imovel $imovel)
    {
        $tiposImovel = TipoImovel::all();

        if (Auth::user()->role == 'proprietario' && $imovel->id_user != Auth::id()) {
            return redirect()->route('imoveis.index');
        }

        return view('imoveis.edit', compact('imovel', 'tiposImovel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imovel $imovel)
    {
        $tiposImovel = TipoImovel::all();

        $validator = Validator::make($request->all(), [
            'endereco' => 'required|unique:imovel,endereco,' . $imovel->id,
            'tipo_imovel_id' => 'required|exists:tipo_imovel,id',
            'preco_compra' => 'required|gt:0',
            'area' => 'required|gt:0',
            'val_seguro' => 'required|gte:0',
            'val_imi' => 'required|gte:0',
            'val_condominio' => 'required|gte:0',
        ]);

        if ($validator->fails()) {
            return redirect('imoveis/' . $imovel->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Imovel is valid, update it in the database...
        $imovel->update($request->all());
        return redirect()->route('imoveis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imovel $imovel)
    {
        if (Auth::user()->role == 'proprietario' && $imovel->id_user != Auth::id()) {
            return redirect()->route('imoveis.index');
        }

        $imovel->estado = 'inativo';
        $imovel->save();

        return redirect()->route('imoveis.index');
    }
}
