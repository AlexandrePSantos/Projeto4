@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <div class="body-content">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Lista de Inquilinos</h2>
                <a href="{{ route('inquilinos.create') }}" class="add-button">Adicionar Inquilino</a>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Apelido</th>
                                <th>Email</th>
                                <th>Telemóvel</th>
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
                                    <td class="action-buttons">
                                        <a href="{{ route('inquilinos.edit', $inquilino->id) }}">Editar</a>
                                        <a href="{{ route('inquilinos.contratos', $inquilino->id) }}">Ver Contratos</a>
                                        <form action="{{ route('inquilinos.destroy', $inquilino->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Remover</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
