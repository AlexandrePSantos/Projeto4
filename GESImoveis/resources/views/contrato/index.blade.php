@extends('admin.admin_dashboard')
{{-- @extends('proprietario.proprietario_dashboard') --> por criar --}}

@section('admin')

<a href="{{ route('contrato.create') }}">Novo contrato</a>

<style>
    .table-bordered {
    border-collapse: collapse;
    width: 100%;
}

.table-bordered th, .table-bordered td {
    border: 1px solid black;
}
</style>

<table class="table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Inquilino</th>
            <th>Imovel</th>
            <th>Tipo</th>
            <th>Inicio</th>
            <th>Fim</th>
            <th>Valor total</th>
            <th>Valor pago</th>
            <th>Valor em falta</th>
            <th>Perocidade pagamentos</th>
            <th>Estado</th>
            <th>Termino</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contrato as $contrato)
            <tr>
                <td>{{ $contrato->id }}</td>
                <td>{{ $contrato->id_inquilino }}</td>
                <td><a href="{{ route('imoveis.show', $contrato->id_imovel) }}">{{ $contrato->id_imovel }}</a></td>
                <td>{{ $contrato->id_tipo_contrato }}</td>
                <td>{{ $contrato->data_ini }}</td>
                <td>{{ $contrato->data_fim }}</td>
                <td>{{ $contrato->valor }}</td>
                <td>{{ $contrato->valor_pago }}</td>
                <td>{{ $contrato->valor - $contrato->valor_pago }}</td>
                <td><a href="{{ route('pagamento.index', ['contrato' => $contrato->id]) }}">{{ $contrato->perocidade_pag }}</a></td>
                <td>{{ $contrato->estado }}</td>
                <td>{{ $contrato->data_termino }}</td>
                <td>
                    <a href="{{ route('contrato.edit', $contrato->id) }}">Editar</a><br>
                    <a href="{{ route('contrato.destroy', $contrato->id) }}">Terminar</a><br>
                    <a href="{{ route('contrato.show', $contrato->id) }}">Detalhes</a><br>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
