<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use App\Models\TipoImovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposImovel = TipoImovel::all();
        if (Auth::user()->role == 'proprietario') {
            $imoveis = Imovel::where('id_user', Auth::id())->get();
        } else {
            $imoveis = Imovel::all();
        }

        return view('imoveis.index', compact('imoveis', 'tiposImovel'));
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
        // Adicionar um log para verificar os dados recebidos
        Log::info('Dados recebidos para criar imóvel: ' . json_encode($request->all()));

        $validator = Validator::make($request->all(), [
            'endereco' => 'unique:imovel',
            'id_tipo_imovel' => 'required',
            'preco_compra' => 'required|gt:0',
            'area' => 'required|gt:0',
            'val_seguro' => 'required|gte:0',
            'val_imi' => 'required|gte:0',
            'val_condominio' => 'required|gte:0',
        ]);

        // Verificar se a validação falhou
        if ($validator->fails()) {
            // Adicionar log de erro de validação
            Log::error('Erro de validação ao criar imóvel:');
            Log::error($validator->errors());

            return redirect('imoveis/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Se passou pela validação, criar o imóvel
        try {
            $imovel = Imovel::create($request->all());

            // Adicionar log de sucesso na criação do imóvel
            Log::info('Imóvel criado com sucesso. ID: ' . $imovel->id);

            return redirect()->route('imoveis.index');
        } catch (\Exception $e) {
            // Adicionar log de exceção se houver erro na criação do imóvel
            Log::error('Erro ao criar imóvel:');
            Log::error($e->getMessage());

            // Retornar um erro genérico para o usuário (opcional)
            return redirect('imoveis/create')->with('error', 'Ocorreu um erro ao criar o imóvel.');
        }
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
        $tiposImovel = TipoImovel::all();

        if (Auth::user()->role == 'proprietario' && $imovel->id_user != Auth::id()) {
            return redirect()->route('imoveis.index');
        }

        return view('imoveis.edit', compact('imovel', 'tiposImovel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imovel $imovel)
    {
        try {
            // Log antes da validação
            Log::info('Iniciando método update para Imovel ID: ' . $imovel->id);

            // Carregar tipos de imóvel para usar na validação
            $tiposImovel = TipoImovel::all();

            // Validar dados recebidos
            $validator = Validator::make($request->all(), [
                'endereco' => 'unique:imovel,endereco,' . $imovel->id,
                'id_tipo_imovel' => 'required',
                'preco_compra' => 'required|gt:0',
                'area' => 'required|gt:0',
                'val_seguro' => 'required|gte:0',
                'val_imi' => 'required|gte:0',
                'val_condominio' => 'required|gte:0',
            ]);
            Log::info('id_tipo_imovel: ' . $request->id_tipo_imovel);

            // Verificar se a validação falhou
            if ($validator->fails()) {
                // Log de validação falhada
                Log::error('Erro de validação ao atualizar Imovel ID: ' . $imovel->id);
                Log::error($validator->errors());

                return redirect('imoveis/' . $imovel->id . '/edit')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Atualizar o Imovel no banco de dados
            $imovel->update($request->all());

            // Log de sucesso na atualização
            Log::info('Imovel ID ' . $imovel->id . ' atualizado com sucesso.');

            // Redirecionar para a lista de imóveis após a atualização
            return redirect()->route('imoveis.index');
        } catch (\Exception $e) {
            // Log de exceção capturada
            Log::error('Exceção ao atualizar Imovel ID: ' . $imovel->id);
            Log::error($e->getMessage());

            // Retornar um erro genérico para o usuário (opcional)
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o imóvel.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imovel $imovel)
    {
        try {
            // Log antes de começar a exclusão
            Log::info('Iniciando método destroy para Imovel ID: ' . $imovel->id);

            // Verificar permissões de usuário
            if (Auth::user()->role == 'proprietario' && $imovel->id_user != Auth::id()) {
                Log::warning('Usuário não autorizado tentou excluir Imovel ID: ' . $imovel->id);
                return redirect()->route('imoveis.index')->with('warning', 'Você não tem permissão para excluir este imóvel.');
            }

            // Definir o estado do imóvel como inativo
            $imovel->estado = 'inativo';
            $imovel->save();

            // Log de sucesso na exclusão
            Log::info('Imovel ID ' . $imovel->id . ' marcado como inativo com sucesso.');

            // Redirecionar para a lista de imóveis após a exclusão
            return redirect()->route('imoveis.index')->with('success', 'Imóvel inativado com sucesso.');
        } catch (\Exception $e) {
            // Log de exceção capturada
            Log::error('Exceção ao tentar excluir Imovel ID: ' . $imovel->id);
            Log::error($e->getMessage());

            // Retornar um erro genérico para o usuário (opcional)
            return redirect()->back()->with('error', 'Ocorreu um erro ao tentar excluir o imóvel.');
        }
    }
}
