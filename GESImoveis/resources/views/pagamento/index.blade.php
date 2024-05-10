@extends('admin.admin_dashboard')
@section('admin')

<a href="{{ route('pagamentos.create') }}">Criar Pagamento</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Contrato</th>
            <th>Data Pagamento</th>
            <th>Método de Pagamento</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pagamentos as $pagamento)
            <tr>
                <td>{{ $pagamento->id }}</td>
                <td>{{ $pagamento->id_contrato }}</td>
                <td>{{ $pagamento->data_pag }}</td>
                <td>{{ $pagamento->metodo_pag }}</td>
                <td>{{ $pagamento->valor }}</td>
                <td>
                    <a href="{{ route('pagamentos.edit', $pagamento->id) }}">Editar</a><br>
                    <a href="{{ route('pagamentos.destroy', $pagamento->id) }}">Excluir</a><br>
                    <a href="{{ route('pagamentos.show', $pagamento->id) }}">Detalhes</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
