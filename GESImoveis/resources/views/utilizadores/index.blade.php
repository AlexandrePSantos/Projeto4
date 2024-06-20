@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <div class="body-content">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Utilizadores</h2>

                <a href="{{ route('utilizadores.create') }}" class="add-button">Criar Utilizador</a>

                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telemóvel</th>
                                <th>Título</th>
                                <th>Localidade</th>
                                <th>Código Postal</th>
                                <th>Cidade</th>
                                <th>País</th>
                                <th>NIF</th>
                                <th>Estado</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utilizadores as $user)
                                @if($user->id != Auth::id())
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->telemovel }}</td>
                                        <td>{{ $user->titulo }}</td>
                                        <td>{{ $user->morada }}</td>
                                        <td>{{ $user->codigo_postal }}</td>
                                        <td>{{ $user->cidade }}</td>
                                        <td>{{ $user->pais }}</td>
                                        <td>{{ $user->nif }}</td>
                                        <td>{{ $user->estado }}</td>
                                        <td class="action-buttons">
                                            @if($user->estado == 'ativo')
                                                <form action="{{ route('utilizadores.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger mb-1">Inativar</button>
                                                </form>
                                            @endif
                                            <a href="{{ route('utilizadores.edit', $user->id) }}" class="action-button">Editar</a>
                                            <a href="{{ route('utilizadores.show', $user->id) }}" class="action-button">Detalhes</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
