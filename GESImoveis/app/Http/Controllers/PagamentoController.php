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

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('contrato')) {
            $pagamentos = Pagamento::where('id_contrato', $request->contrato)->get();
        } else {
            $pagamentos = Pagamento::all();
        }

        return view('pagamento.index', compact('pagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pagamento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contrato_id' => 'required|exists:contrato,id',
            'valor' => [
                'required',
                'gt:0',
                function ($attribute, $value, $fail) use ($request) {
                    $contrato = Contrato::find($request->contrato_id);
                    $totalPago = Pagamento::where('contrato_id', $request->contrato_id)->sum('valor');
                    if ($value > ($contrato->valor_total - $totalPago)) {
                        $fail($attribute.' exceeds the remaining contract value.');
                    }
                },
            ],
            'data' => 'required|date|before_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect('pagamento/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Pagamento is valid, store it in the database...
        $pagamento = Pagamento::create($request->all());
        return redirect()->route('pagamento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagamento $pagamento)
    {
        return view('pagamento.show', compact('pagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamento $pagamento)
    {
        return view('pagamento.edit', compact('pagamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagamento $pagamento)
    {
        $validator = Validator::make($request->all(), [
            'contrato_id' => 'required|exists:contrato,id',
            'valor' => [
                'required',
                'gt:0',
                function ($attribute, $value, $fail) use ($request, $pagamento) {
                    $contrato = Contrato::find($request->contrato_id);
                    $totalPago = Pagamento::where('contrato_id', $request->contrato_id)->where('id', '!=', $pagamento->id)->sum('valor');
                    if ($value > ($contrato->valor_total - $totalPago)) {
                        $fail($attribute.' exceeds the remaining contract value.');
                    }
                },
            ],
            'data' => 'required|date|before_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect('pagamento/' . $pagamento->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Pagamento is valid, update it in the database...
        $pagamento->update($request->all());
        return redirect()->route('pagamento.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamento $pagamento)
    {
        $pagamento->delete();
        return redirect()->route('pagamento.index');
    }
}
