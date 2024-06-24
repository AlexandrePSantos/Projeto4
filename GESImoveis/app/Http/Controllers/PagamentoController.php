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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('contrato')) {
            $pagamentos = Pagamento::where('id_contrato', $request->contrato)->get();
        } else {
            $pagamentos = Pagamento::all();
        }

        return view('pagamento.index', compact('pagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contratos = Contrato::all();
        return view('pagamento.create', compact('contratos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_contrato' => 'required|exists:contrato,id',
            'valor' => [
                'required',
                'gt:0',
                function ($attribute, $value, $fail) use ($request) {
                    $contrato = Contrato::find($request->id_contrato);
                    $totalPago = Pagamento::where('id_contrato', $request->id_contrato)->sum('valor');
                    if ($value > ($contrato->valor - $totalPago)) {
                        $fail($attribute.' exceeds the remaining contract value.');
                    }
                },
            ],
            'data_pag' => 'required|date|before_or_equal:today',
            'metodo_pag' => 'required|in:MBWay,Transferência',
        ]);

        if ($validator->fails()) {
            return redirect('pagamento/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // The Pagamento is valid, store it in the database...
        $pagamento = Pagamento::create($request->all());
        return redirect()->route('pagamento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagamento $pagamento)
    {
        return view('pagamento.show', compact('pagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamento $pagamento)
    {
        $contratos = Contrato::all();
        return view('pagamento.edit', compact('pagamento', 'contratos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagamento $pagamento)
    {
        $validator = Validator::make($request->all(), [
            'id_contrato' => 'required|exists:contrato,id',
            'valor' => [
                'required',
                'gt:0',
                function ($attribute, $value, $fail) use ($request, $pagamento) {
                    $contrato = Contrato::find($request->id_contrato);
                    $totalPago = Pagamento::where('id_contrato', $request->id_contrato)->where('id', '!=', $pagamento->id)->sum('valor');
                    if ($value > ($contrato->valor - $totalPago)) {
                        $fail($attribute.' exceeds the remaining contract value.');
                    }
                },
            ],
            'data_pag' => 'required|date|before_or_equal:today',
            'metodo_pag' => 'required|in:MBWay,Transferência',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pagamento.edit', $pagamento->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $pagamento->update($request->all());
        return redirect()->route('pagamento.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamento $pagamento)
    {
        $pagamento->delete();
        return redirect()->route('pagamento.index');
    }

    /**
     * Método auxiliar para calcular o valor em falta para um contrato específico.
     */
    public function getValorEmFalta($id)
    {
        $contrato = Contrato::find($id);
        if (!$contrato) {
            return response()->json(['error' => 'Contrato não encontrado'], 404);
        }
        $totalPago = Pagamento::where('id_contrato', $id)->sum('valor');
        $valorEmFalta = $contrato->valor - $totalPago;
        return response()->json(['valor_em_falta' => $valorEmFalta]);
    }

    /**
     * Método que realiza uma chamada para a emissão de uma fatura através da API GESFaturacao.
     */
    public function emitirFatura(Request $request, $id)
    {
        $email = $request->input('email');
        $baseURL = 'https://devipvc.gesfaturacao.pt/gesfaturacao/server/webservices/api/mobile/v1.0.2/';
        $authURL = $baseURL . 'authentication';
        $validateTokenURL = $baseURL . 'validate-token';
        $sendEmailURL = $baseURL . 'send-email';

        // Login
        $response = Http::asForm()->post($authURL, [
            'username' => 'ipvc',
            'password' => 'ipvc',
        ]);

        $token = $response->json()['_token'];

        // Validate token
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post($validateTokenURL);

        // Validate version
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Basic UjBWVFJrRlVWVkpCUTBGUDpNWFk0T0dKaWQyZHJaWEkzYmpreWFXUTNNVGs9',
        ])->post('https://licencas.gesfaturacao.pt/server/auto/validate-version', [
            'version' => '6',
            'os' => 'android',
        ]);

        // Send email
        $responseEmail = Http::asForm()->withHeaders([
            'Authorization' => $token,
            'Cookie' => 'PHPSESSID=ce208a4d6568f8a85bbb09329fa0a248',
        ])->post($sendEmailURL, [
            'email' => $email,
            'type' => 'OR',
            'document' => '14',
        ]);

        $jsonResponse = $responseEmail->json();

        if (!$response->failed() && !$responseEmail->failed()) {
            session()->flash('message', 'Fatura was sent successfully!');

            return redirect()->back();
        }

    }
}
