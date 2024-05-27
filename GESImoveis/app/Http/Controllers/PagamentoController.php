<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;

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
