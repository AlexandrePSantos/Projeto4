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

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'proprietario') {
            $contrato = Contrato::where('id_user', Auth::id())->get();
        } else {
            $contrato = Contrato::all();
        }

        return view('contrato.index', compact('contrato'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contrato.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contrato = Contrato::create($request->all());
        return redirect()->route('contrato.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contrato = Contrato::find($id);

        if (!$contrato || (Auth::user()->role == 'proprietario' && $contrato->id_user != Auth::id())) {
            // Handle the case where no contrato with the given ID was found
            // or the user is a 'proprietario' and does not own this contrato
            return redirect()->route('contrato.index');
        }

        return view('contrato.show', compact('contrato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        if (Auth::user()->role == 'proprietario' && $contrato->id_user != Auth::id()) {
            return redirect()->route('contrato.index');
        }

        return view('contrato.edit', compact('contrato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        if (Auth::user()->role == 'proprietario' && $contrato->id_user != Auth::id()) {
            return redirect()->route('contrato.index');
        }

        $contrato->update($request->all());
        return redirect()->route('contrato.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        if (Auth::user()->role == 'proprietario' && $contrato->id_user != Auth::id()) {
            return redirect()->route('contrato.index');
        }

        $contrato->delete();
        return redirect()->route('contrato.index');
    }
}
