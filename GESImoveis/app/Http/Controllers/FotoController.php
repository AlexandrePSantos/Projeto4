<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     * This method is not needed as photos are displayed on the property page.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * This method is not needed as photos are added one by one on the property page.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $foto = Foto::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     * This method is not needed as photos are displayed on the property page.
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * This method is not needed as photos are edited one by one on the property page.
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * This method is not needed as photos are updated one by one on the property page.
     */
    public function update(Request $request, Foto $foto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto)
    {
        $foto->delete();
        return back();
    }
}
