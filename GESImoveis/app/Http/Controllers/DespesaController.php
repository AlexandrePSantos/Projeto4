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
use Illuminate\Validation\Rule;

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
        $validator = Validator::make($request->all(), [
            'imovel_id' => 'required|exists:imovel,id',
            'user_id' => 'required|exists:users,id',
            'tipo_despesa_id' => 'required|exists:tipo_despesa,id',
            'valor' => 'required|gt:0',
            'data' => 'required|date|before_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect('despesa/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Despesa is valid, store it in the database...
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
        $validator = Validator::make($request->all(), [
            'imovel_id' => 'required|exists:imovel,id',
            'user_id' => 'required|exists:users,id',
            'tipo_despesa_id' => 'required|exists:tipo_despesa,id',
            'valor' => 'required|gt:0',
            'data' => 'required|date|before_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect('despesa/' . $despesa->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Despesa is valid, update it in the database...
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
