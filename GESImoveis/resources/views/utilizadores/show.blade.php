@extends('admin.admin_dashboard')

@section('admin')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">

<div class="body-content">
    <div class="card">
        <div class="card-title">Detalhes do Utilizador</div>

        <div class="table-container">
            <table>
                <tr>
                    <th>Tipo</th>
                    <td>{{ $utilizador->role }}</td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td>{{ $utilizador->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $utilizador->email }}</td>
                </tr>
                <tr>
                    <th>Telemóvel</th>
                    <td>{{ $utilizador->telemovel }}</td>
                </tr>
                <tr>
                    <th>Título</th>
                    <td>{{ $utilizador->titulo }}</td>
                </tr>
                <tr>
                    <th>Localidade</th>
                    <td>{{ $utilizador->morada }}</td>
                </tr>
                <tr>
                    <th>Código Postal</th>
                    <td>{{ $utilizador->codigo_postal }}</td>
                </tr>
                <tr>
                    <th>Cidade</th>
                    <td>{{ $utilizador->cidade }}</td>
                </tr>
                <tr>
                    <th>País</th>
                    <td>{{ $utilizador->pais }}</td>
                </tr>
                <tr>
                    <th>NIF</th>
                    <td>{{ $utilizador->nif }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $utilizador->estado }}</td>
                </tr>
            </table>

            <div class="action-buttons">
                @if($utilizador->estado == 'ativo')
                    <a href="{{ route('utilizadores.edit', $utilizador->id) }}" class="btn btn-primary btn-outside-table">Editar Utilizador</a>

                    <form action="{{ route('utilizadores.destroy', $utilizador->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-outside-table">Desativar Utilizador</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
