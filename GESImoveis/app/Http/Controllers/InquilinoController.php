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

use Illuminate\Support\Facades\Validator;

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
        // Validação dos dados recebidos do formulário
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:inquilino',
            'NIF' => 'nullable|unique:inquilino',
        ]);

        // Se houver erros de validação, retorna para a página de criação com os erros
        if ($validator->fails()) {
            return redirect('inquilinos/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            // Adiciona o id_user atual ao request
            $data = $request->all();
            $data['id_user'] = auth()->id(); // Obtém o id do utilizador autenticado

            // Cria o inquilino no banco de dados
            $inquilino = Inquilino::create($data);

            return redirect()->route('inquilinos.index')
                             ->with('success', 'Inquilino adicionado com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, retorna para a página de criação com mensagem de erro
            return redirect('inquilinos/create')
                        ->with('error', 'Ocorreu um erro ao adicionar o inquilino: ' . $e->getMessage())
                        ->withInput();
        }
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:inquilino,email,' . $inquilino->id,
            'NIF' => 'nullable|unique:inquilino,NIF,' . $inquilino->id,
        ]);

        if ($validator->fails()) {
            return redirect('inquilinos/' . $inquilino->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Inquilino is valid, update it in the database...
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
