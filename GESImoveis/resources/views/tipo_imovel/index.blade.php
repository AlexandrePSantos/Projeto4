@extends('admin.admin_dashboard')
@section('admin')

<table>
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
