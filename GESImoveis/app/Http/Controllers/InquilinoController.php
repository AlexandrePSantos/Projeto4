<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use Illuminate\Http\Request;

class InquilinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inquilinos = Inquilino::all();
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
        return view('inquilinos.show', compact('inquilino'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inquilino $inquilino)
    {
        return view('inquilinos.edit', compact('inquilino'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquilino $inquilino)
    {
        $inquilino->update($request->all());
        return redirect()->route('inquilinos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquilino $inquilino)
    {
        $inquilino->delete();
        return redirect()->route('inquilinos.index');
    }
}
