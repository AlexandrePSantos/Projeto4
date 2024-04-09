<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UtilizadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilizadores = User::all();
        return view('utilizadores.index', compact('utilizadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('utilizadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $utilizador = User::create($request->all());
        return redirect()->route('utilizadores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $utilizador)
    {
        return view('utilizadores.show', compact('utilizador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $utilizador)
    {
        return view('utilizadores.edit', compact('utilizador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $utilizador)
    {
        $utilizador->update($request->all());
        return redirect()->route('utilizadores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $utilizador)
    {
        $utilizador->estado = 'inativo';
        $utilizador->save();

        return redirect()->route('utilizadores.index');
    }
}
