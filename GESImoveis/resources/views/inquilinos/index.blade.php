@extends('admin.admin_dashboard')
{{-- @extends('proprietario.proprietario_dashboard') --> por criar --}}

@section('admin')
    <h2>Lista de Inquilinos</h2>

    <a href="{{ route('inquilinos.create') }}">Adicionar Inquilino</a>

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
                <th>Nome</th>
                <th>Apelido</th>
                <th>Email</th>
                <th>Telemovél</th>
                <th>Telefone</th>
                <th>Morada</th>
                <th>Código Postal</th>
                <th>NIF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquilinos as $inquilino)
                <tr>
                    <td>{{ $inquilino->nome }}</td>
                    <td>{{ $inquilino->apelido }}</td>
                    <td>{{ $inquilino->email }}</td>
                    <td>{{ $inquilino->telemovel }}</td>
                    <td>{{ $inquilino->telefone }}</td>
                    <td>{{ $inquilino->morada }}</td>
                    <td>{{ $inquilino->codigo_postal }}</td>
                    <td>{{ $inquilino->nif }}</td>
                    <td>
                        <a href="{{ route('inquilinos.edit', $inquilino->id) }}">Editar</a>
                        <a href="{{ route('inquilinos.contratos', $inquilino->id) }}">Ver Contratos</a>
                        <form action="{{ route('inquilinos.destroy', $inquilino->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Remover">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
