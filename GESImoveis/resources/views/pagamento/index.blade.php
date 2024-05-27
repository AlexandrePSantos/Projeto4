@extends('admin.admin_dashboard')
@section('admin')

<a href="{{ route('pagamento.create') }}">Criar Pagamento</a>

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
                    <a href="{{ route('pagamento.edit', $pagamento->id) }}">Editar</a><br>
                    <a href="{{ route('pagamento.destroy', $pagamento->id) }}">Excluir</a><br>
                    <a href="{{ route('pagamento.show', $pagamento->id) }}">Detalhes</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
