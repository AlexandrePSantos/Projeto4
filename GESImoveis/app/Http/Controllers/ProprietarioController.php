<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProprietarioController extends Controller
{
    public function ProprietarioDashboard()
    {
        return view('proprietario.proprietario_dashboard');
    }
}
