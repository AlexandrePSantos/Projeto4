@extends('admin.admin_dashboard')

@section('admin')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
<div class="body-content">
<div class="card">
    <div class="card-title">Detalhes do Contrato</div>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $contrato->id }}</td>
            </tr>
            <tr>
                <th>Inquilino</th>
                <td>{{ $contrato->id_inquilino }}</td>
            </tr>
            <tr>
                <th>Imovel</th>
                <td><a href="{{ route('imoveis.show', $contrato->id_imovel) }}">{{ $contrato->id_imovel }}</a></td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td>{{ $contrato->id_tipo_contrato }}</td>
            </tr>
            <tr>
                <th>Inicio</th>
                <td>{{ $contrato->data_ini }}</td>
            </tr>
            <tr>
                <th>Fim</th>
                <td>{{ $contrato->data_fim }}</td>
            </tr>
            <tr>
                <th>Valor total</th>
                <td>{{ $contrato->valor }}</td>
            </tr>
            <tr>
                <th>Valor pago</th>
                <td>{{ $contrato->valor_pago }}</td>
            </tr>
            <tr>
                <th>Valor em falta</th>
                <td>{{ $contrato->valor - $contrato->valor_pago }}</td>
            </tr>
            <tr>
                <th>Pagamentos</th>
                <td><a href="{{ route('pagamento.index', ['contrato' => $contrato->id]) }}">Ver</a></td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ $contrato->estado }}</td>
            </tr>
            <tr>
                <th>Término</th>
                <td>{{ $contrato->data_termino }}</td>
            </tr>
        </table>

        <div class="action-buttons">
            @if($contrato->estado == 'active')
            <a href="{{ route('contrato.edit', $contrato->id) }}" class="btn btn-primary btn-outside-table">Editar Contrato</a>

            <form action="{{ route('contrato.destroy', $contrato->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-outside-table">Terminar Contrato</button>
            </form>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
