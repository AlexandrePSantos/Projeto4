@extends('admin.admin_dashboard')

@section('admin')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">

<div class="card">
    <div class="card-title">Detalhes do Inquilino</div>

    <div class="table-container">
        <table>
            <tr>
                <th>Nome</th>
                <td>{{ $inquilino->nome }}</td>
            </tr>
            <tr>
                <th>Apelido</th>
                <td>{{ $inquilino->apelido }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $inquilino->email }}</td>
            </tr>
            <tr>
                <th>Telemóvel</th>
                <td>{{ $inquilino->telemovel }}</td>
            </tr>
            <tr>
                <th>Telefone</th>
                <td>{{ $inquilino->telefone }}</td>
            </tr>
            <tr>
                <th>Morada</th>
                <td>{{ $inquilino->morada }}</td>
            </tr>
            <tr>
                <th>Código Postal</th>
                <td>{{ $inquilino->codigo_postal }}</td>
            </tr>
            <tr>
                <th>NIF</th>
                <td>{{ $inquilino->nif }}</td>
            </tr>
        </table>

        <div class="action-buttons">
            <a href="{{ route('inquilinos.edit', $inquilino->id) }}" class="btn btn-primary btn-outside-table">Editar</a>

            <form action="{{ route('inquilinos.destroy', $inquilino->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-outside-table">Remover</button>
            </form>
        </div>
    </div>
</div>
@endsection
