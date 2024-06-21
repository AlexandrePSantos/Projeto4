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
            $contrato = Contrato::with('tipoContrato')
                                ->where('id_user', Auth::id())
                                ->get();
        } else {
            $contrato = Contrato::with('tipoContrato')
                                ->get();
        }

        return view('contrato.index', compact('contrato'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $inquilinos = Inquilino::all(); // Obtém todos os inquilinos
            $imoveis = Imovel::where('estado', 'ativo')->get(); // Obter imóveis ativos
            $tiposContrato = TipoContrato::all(); // Obtém todos os tipos de contrato

            return view('contrato.create', compact('inquilinos', 'imoveis', 'tiposContrato'));
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
            $validator = Validator::make($request->all(), [
                'inquilino_id' => [
                    'required',
                    'exists:inquilino,id',
                    function ($attribute, $value, $fail) {
                        $activeContrato = Contrato::where('inquilino_id', $value)->first();
                        if ($activeContrato) {
                            $fail($attribute.' already has a contract.');
                        }
                    },
                ],
                'imovel_id' => [
                    'required',
                    'exists:imovel,id',
                    function ($attribute, $value, $fail) {
                        $activeContrato = Contrato::where('imovel_id', $value)
                            ->where(function ($query) {
                                $query->where('data_fim', '>=', now())
                                      ->orWhereNull('data_fim');
                            })
                            ->first();
                        if ($activeContrato) {
                            $fail($attribute.' already has an active contract.');
                        }
                    },
                ],
                'tipo_contrato_id' => 'required|exists:tipo_contrato,id',
                'user_id' => 'required|exists:user,id',
                'valor' => 'required|gt:0',
                'data_ini' => 'required|date',
                'data_fim' => 'required|date|after_or_equal:data_ini',
                'estado' => 'ativo',
                'valor_pago' => [
                    'required',
                    'lte:valor',
                ],
            ]);

            if ($validator->fails()) {
                return redirect('contrato/create')
                            ->withErrors($validator)
                            ->withInput();
            }

            // The Contrato is valid, store it in the database...
            $contrato = Contrato::create($request->all());

            // Log de sucesso na criação do contrato
            Log::info('Contrato criado com sucesso: ' . $contrato->id);

            return redirect()->route('contrato.index');
        } catch (\Exception $e) {
            // Log de erro na criação do contrato
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
        $validator = Validator::make($request->all(), [
            'inquilino_id' => [
                'required',
                'exists:inquilino,id',
                function ($attribute, $value, $fail) use ($contrato) {
                    $activeContrato = Contrato::where('inquilino_id', $value)->where('id', '!=', $contrato->id)->first();
                    if ($activeContrato) {
                        $fail($attribute.' already has a contract.');
                    }
                },
            ],
            'imovel_id' => [
                'required',
                'exists:imovel,id',
                function ($attribute, $value, $fail) use ($contrato) {
                    $activeContrato = Contrato::where('imovel_id', $value)->where('id', '!=', $contrato->id)->where('data_fim', '>=', now())->orWhereNull('data_fim')->first();
                    if ($activeContrato) {
                        $fail($attribute.' already has an active contract.');
                    }
                },
            ],
            'tipo_contrato_id' => 'required|exists:tipo_contrato,id',
            'user_id' => 'required|exists:user,id',
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
            return redirect('contrato/' . $contrato->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Contrato is valid, update it in the database...
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

        $contrato->data_termino = Carbon::now();
        $contrato->estado = 'inativo';
        $contrato->save();

        return redirect()->route('contrato.index');
    }
}
