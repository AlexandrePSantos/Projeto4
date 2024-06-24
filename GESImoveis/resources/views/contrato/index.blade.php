@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <div class="body-content">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Lista de Contratos</h2>
                <a href="{{ route('contrato.create') }}" class="add-button">Novo Contrato</a>

                <div class="table-container">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Inquilino</th>
                                <th>Imóvel</th>
                                <th>Tipo</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Valor total</th>
                                <th>Valor pago</th>
                                <th>Valor em falta</th>
                                <th>Pagamentos</th>
                                <th>Estado</th>
                                <th>Término</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contratos as $contrato)
                                <tr>
                                    <td>{{ $contrato->id }}</td>
                                    <td>{{ $contrato->inquilino->nome }} {{ $contrato->inquilino->apelido }}</td>
                                    <td class="action-buttons"><a href="{{ route('imoveis.show', $contrato->imovel->id) }}">Ver</a></td>
                                    <td>{{ $contrato->tipoContrato->tipo }}</td>
                                    <td>{{ $contrato->data_ini }}</td>
                                    <td>{{ $contrato->data_fim }}</td>
                                    <td>{{ $contrato->valor }}</td>
                                    <td>{{ $contrato->valor_pago }}</td>
                                    <td>{{ $contrato->valor_em_falta }}</td>
                                    <td class="action-buttons"><a href="{{ route('pagamento.index', ['contrato' => $contrato->id]) }}">Ver</a></td>
                                    <td>{{ $contrato->estado }}</td>
                                    <td>{{ $contrato->data_termino }}</td>
                                    <td class="action-buttons">
                                        @if($contrato->estado == 'ativo')
                                            <a href="{{ route('contrato.edit', $contrato->id) }}">Editar</a>
                                        @endif
                                        <a href="{{ route('contrato.show', $contrato->id) }}">Detalhes</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
