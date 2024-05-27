@extends('admin.admin_dashboard')
@section('admin')

<a href="{{ route('imoveis.create') }}">Criar Imóvel</a>
<a href="{{ route('tipo_imovel.index') }}">Tipos de Imóvel</a>

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
            <th>Tipo de Imóvel</th>
            <th>Área</th>
            <th>Morada</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($imoveis as $imovel)
            <tr>
                <td>{{ $imovel->id }}</td>
                <td>{{ $imovel->id_tipo_imovel }}</td>
                <td>{{ $imovel->area }}</td>
                <td>{{ $imovel->morada }}</td>
                <td>
                    <a href="{{ route('imoveis.edit', $imovel->id) }}">Editar</a><br>
                    <a href="{{ route('imoveis.destroy', $imovel->id) }}">Inativar</a><br>
                    <a href="{{ route('imoveis.show', $imovel->id) }}">Detalhes</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
