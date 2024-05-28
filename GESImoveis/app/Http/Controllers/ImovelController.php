<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use App\Models\TipoImovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->role == 'proprietario' && $imovel->id_user != Auth::id()) {
            return redirect()->route('imoveis.index');
        }

        return view('imoveis.edit', compact('imovel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imovel $imovel)
    {
        if (Auth::user()->role == 'proprietario' && $imovel->id_user != Auth::id()) {
            return redirect()->route('imoveis.index');
        }

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
