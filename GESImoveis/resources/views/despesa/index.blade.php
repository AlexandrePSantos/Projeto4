@extends('admin.admin_dashboard')
@section('admin')

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
            <th>ID Imóvel</th>
            <th>ID User</th>
            <th>ID Tipo Despesa</th>
            <th>Data</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($despesas as $despesa)
            <tr>
                <td>{{ $despesa->id }}</td>
                <td>{{ $despesa->id_imovel }}</td>
                <td>{{ $despesa->id_user }}</td>
                <td>{{ $despesa->id_tipo_despesa }}</td>
                <td>{{ $despesa->data }}</td>
                <td>{{ $despesa->valor }}</td>
                <td>
                    <a href="{{ route('despesa.edit', $despesa->id) }}">Editar</a><br>
                    <a href="{{ route('despesa.destroy', $despesa->id) }}">Inativar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
