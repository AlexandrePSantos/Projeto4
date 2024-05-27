@extends('admin.admin_dashboard')
@section('admin')
<form action="{{ route('tipo_imovel.store') }}" method="POST">
    @csrf
    <label for="descricao">Descrição:</label>
    <input type="text" id="tipo" name="tipo" required>
    <button type="submit">Criar</button>
</form>

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
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tiposImovel as $tipo)
            <tr>
                <td>{{ $tipo->id }}</td>
                <td>{{ $tipo->tipo }}</td>
                <td>
                    <a href="{{ route('tipo_imovel.edit', $tipo->id) }}">Editar</a><br>
                    <a href="{{ route('tipo_imovel.destroy', $tipo->id) }}">Inativar</a>
                </td>
            </tr>
        @endforeach
        @can('create', App\Models\TipoImovel::class)
            <tr>
                <form action="{{ route('tipo_imovel.store') }}" method="POST">
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
