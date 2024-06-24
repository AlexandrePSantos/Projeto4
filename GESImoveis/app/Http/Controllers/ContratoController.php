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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Certifique-se de importar a classe Log
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'proprietario') {
            $contratos = Contrato::with('tipoContrato')
                                ->where('id_user', Auth::id())
                                ->get();
        } else {
            $contratos = Contrato::with('tipoContrato')
                                ->get();
        }

        // Calculate the paid amount and remaining amount for each contract
        foreach ($contratos as $contrato) {
            $contrato->valor_pago = $this->calculateValorPago($contrato->id);
            $contrato->valor_em_falta = $contrato->valor - $contrato->valor_pago;
        }

        return view('contrato.index', compact('contratos'));
    }

    /**
     * Calculate the total amount paid for a contract.
     */
    private function calculateValorPago($contratoId)
    {
        return Pagamento::where('id_contrato', $contratoId)->sum('valor');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $inquilinos = Inquilino::all();
            $imoveis = Imovel::where('estado', 'ativo')->get();
            $tiposContrato = TipoContrato::all();
            $users = User::all(); // Adiciona os usuários para seleção

            return view('contrato.create', compact('inquilinos', 'imoveis', 'tiposContrato', 'users'));
        } catch (\Exception $e) {
            Log::error('Erro ao carregar formulário de criação de contrato: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Erro ao carregar formulário de criação de contrato.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        Log::info('Iniciando a criação de um novo contrato', ['request' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'id_inquilino' => [
                'required',
                'exists:inquilino,id',
                function ($attribute, $value, $fail) {
                    $activeContrato = Contrato::where('id_inquilino', $value)->first();
                    if ($activeContrato) {
                        $fail($attribute.' já tem um contrato ativo.');
                    }
                },
            ],
            'id_imovel' => [
                'required',
                'exists:imovel,id',
                function ($attribute, $value, $fail) {
                    $activeContrato = Contrato::where('id_imovel', $value)
                        ->where(function ($query) {
                            $query->where('data_fim', '>=', now())
                                  ->orWhereNull('data_fim');
                        })
                        ->first();
                    if ($activeContrato) {
                        $fail($attribute.' já tem um contrato ativo.');
                    }
                },
            ],
            'id_tipo_contrato' => 'required|exists:tipo_contrato,id',
            'id_user' => 'required|exists:users,id',
            'valor' => 'required|gt:0',
            'perocidade_pag' => 'required|in:mensal',
            'data_ini' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_ini',
            'estado' => 'required|in:ativo,inativo,cancelado',
            'valor_pago' => 'required|lte:valor',
        ]);

        if ($validator->fails()) {
            Log::warning('Falha na validação ao criar contrato', ['errors' => $validator->errors()]);
            return redirect('contrato/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $contrato = Contrato::create($request->all());

        Log::info('Contrato criado com sucesso: ' . $contrato->id);

        return redirect()->route('contrato.index');
    } catch (\Exception $e) {
        Log::error('Erro ao criar contrato: ' . $e->getMessage());
        return redirect('contrato/create')
                    ->withErrors(['error' => 'Erro ao criar contrato. Tente novamente mais tarde.'])
                    ->withInput();
    }
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
        $inquilinos = Inquilino::all();
            $imoveis = Imovel::where('estado', 'ativo')->get();
            $tiposContrato = TipoContrato::all();
            $users = User::all();

        if (Auth::user()->role == 'proprietario' && $contrato->id_user != Auth::id()) {
            return redirect()->route('contrato.index');
        }

        return view('contrato.edit', compact('contrato', 'inquilinos', 'imoveis', 'tiposContrato', 'users'));
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, Contrato $contrato)
    {
        try {
            Log::info('Iniciando a atualização do contrato', ['contrato_id' => $contrato->id, 'request' => $request->all()]);

            $validator = Validator::make($request->all(), [
                'id_inquilino' => [
                    'required',
                    'exists:inquilino,id',
                ],
                'id_imovel' => [
                    'required',
                    'exists:imovel,id',
                ],
                'id_tipo_contrato' => 'required|exists:tipo_contrato,id',
                'valor' => 'required|gt:0',
                'data_ini' => 'required|date',
                'data_fim' => 'required|date|after_or_equal:data_ini',
                'estado' => ['required', Rule::in(['ativo', 'inativo', 'cancelado'])],
                'valor_pago' => [
                    'required',
                    'lte:valor',
                ],
            ]);

            if ($validator->fails()) {
                Log::warning('Falha na validação ao atualizar contrato', ['errors' => $validator->errors()]);
                return redirect('contrato/' . $contrato->id . '/edit')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Set the id_user field to the current authenticated user's ID
            $request->merge(['id_user' => Auth::id()]);

            $contrato->update($request->all());
            Log::info('Contrato atualizado com sucesso: ' . $contrato->id);

            return redirect()->route('contrato.index');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar contrato: ' . $e->getMessage());
            return redirect('contrato/' . $contrato->id . '/edit')
                        ->withErrors(['error' => 'Erro ao atualizar contrato. Tente novamente mais tarde.'])
                        ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        try {
            Log::info('Iniciando a remoção do contrato', ['contrato_id' => $contrato->id]);

            if (Auth::user()->role == 'proprietario' && $contrato->id_user != Auth::id()) {
                Log::warning('Tentativa de remoção de contrato por usuário não autorizado', ['user_id' => Auth::id(), 'contrato_id' => $contrato->id]);
                return redirect()->route('contrato.index');
            }

            $contrato->data_termino = Carbon::now();
            $contrato->estado = 'inativo';
            $contrato->save();

            Log::info('Contrato removido (inativado) com sucesso: ' . $contrato->id);

            return redirect()->route('contrato.index');
        } catch (\Exception $e) {
            Log::error('Erro ao remover contrato: ' . $e->getMessage());
            return redirect()->route('contrato.index')->withErrors(['error' => 'Erro ao remover contrato. Tente novamente mais tarde.']);
        }
    }
}
