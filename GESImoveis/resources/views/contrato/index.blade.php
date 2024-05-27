@extends('admin.admin_dashboard')
{{-- @extends('proprietario.proprietario_dashboard') --> por criar --}}

@section('admin')

<a href="{{ route('contrato.create') }}">Novo contrato</a>
{{-- <a href="{{ route('pagamento.index', ['contrato' => $contrato->id]) }}">Pagamentos</a> --}}
{{-- <a href="{{ route('despesa.index', ['despesa' => $despesa->id]) }}">Despesas</a> --}}

<table>
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
                <td>{{ $contrato->id_imovel }}</td>
                <td>{{ $contrato->id_tipo_contrato }}</td>
                <td>{{ $contrato->data_ini }}</td>
                <td>{{ $contrato->data_fim }}</td>
                <td>{{ $contrato->valor }}</td>
                <td>{{ $contrato->valor_pago }}</td>
                <td>{{ $contrato->valor - $contrato->valor_pago }}</td>
                <td>{{ $contrato->perocidade_pag }}</td>
                <td>{{ $contrato->estado }}</td>
                <td>{{ $contrato->data_termino }}</td>
                <td>
                    <a href="{{ route('contratos.edit', $contrato->id) }}">Editar</a><br>
                    <a href="{{ route('contratos.destroy', $contrato->id) }}">Terminar</a><br>
                    <a href="{{ route('contratos.show', $contrato->id) }}">Detalhes</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
