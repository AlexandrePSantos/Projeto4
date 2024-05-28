<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquilinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'proprietario') {
            $inquilinos = Inquilino::where('id_user', Auth::id())->get();
        } else {
            $inquilinos = Inquilino::all();
        }

        return view('inquilinos.index', compact('inquilinos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inquilinos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inquilino = Inquilino::create($request->all());
        return redirect()->route('inquilinos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inquilino $inquilino)
    {
        if (Auth::user()->role == 'proprietario' && $inquilino->id_user != Auth::id()) {
            return redirect()->route('inquilinos.index');
        }

        return view('inquilinos.show', compact('inquilino'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inquilino $inquilino)
    {
        if (Auth::user()->role == 'proprietario' && $inquilino->id_user != Auth::id()) {
            return redirect()->route('inquilinos.index');
        }

        return view('inquilinos.edit', compact('inquilino'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquilino $inquilino)
    {
        if (Auth::user()->role == 'proprietario' && $inquilino->id_user != Auth::id()) {
            return redirect()->route('inquilinos.index');
        }

        $inquilino->update($request->all());
        return redirect()->route('inquilinos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquilino $inquilino)
    {
        if (Auth::user()->role == 'proprietario' && $inquilino->id_user != Auth::id()) {
            return redirect()->route('inquilinos.index');
        }

        $inquilino->delete();
        return redirect()->route('inquilinos.index');
    }

    public function contratos($inquilinoId)
    {
        // Get the contracts for this inquilino
        $contratos = Contrato::where('id_inquilino', $inquilinoId)->get();

        // If the user is a 'proprietario' and does not own this inquilino, redirect them
        if (Auth::user()->role == 'proprietario' && $contratos->first()->inquilino->id_user != Auth::id()) {
            return redirect()->route('inquilinos.index');
        }

        // Return the contracts to a view
        return view('contrato.index', ['contrato' => $contratos]);
    }

}
