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
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tipos as $tipo)
            <tr>
                <td>{{ $tipo->id }}</td>
                <td>{{ $tipo->nome }}</td>
                <td>
                    <a href="{{ route('tipo_contrato.edit', $tipo->id) }}">Editar</a><br>
                    <a href="{{ route('tipo_contrato.destroy', $tipo->id) }}">Inativar</a>
                </td>
            </tr>
        @endforeach
        @can('create', App\Models\TipoContrato::class)
            <tr>
                <form action="{{ route('tipo_contrato.store') }}" method="POST">
                    @csrf
                    <td></td>
                    <td><input type="text" name="nome" required></td>
                    <td><button type="submit">Criar</button></td>
                </form>
            </tr>
        @endcan
    </tbody>
</table>

@endsection
