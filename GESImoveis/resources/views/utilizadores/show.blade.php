{{-- Página para listar os detalhes de um utilizador.
Botão para editar o utilizador e botão para desativar. --}}
@extends('admin.admin_dashboard')
@section('admin')
    <h2>Detalhes do Utilizador</h2>

    <p><strong>Tipo:</strong> {{ $utilizador->role }}</p>
    <p><strong>Nome:</strong> {{ $utilizador->name }}</p>
    <p><strong>Email:</strong> {{ $utilizador->email }}</p>
    <p><strong>Telemovél:</strong> {{ $utilizador->telemovel }}</p>
    <p><strong>Titulo:</strong> {{ $utilizador->titulo }}</p>
    <p><strong>Localidade:</strong> {{ $utilizador->morada }}</p>
    <p><strong>Código Postal:</strong> {{ $utilizador->codigo_postal }}</p>
    <p><strong>Cidade:</strong> {{ $utilizador->cidade }}</p>
    <p><strong>Pais:</strong> {{ $utilizador->pais }}</p>
    <p><strong>NIF:</strong> {{ $utilizador->nif }}</p>
    <p><strong>Estado:</strong> {{ $utilizador->estado }}</p>

    <a href="{{ route('utilizadores.edit', $utilizador->id) }}" class="btn btn-primary">Editar Utilizador</a>

    <form action="{{ route('utilizadores.destroy', $utilizador->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Desativar Utilizador" class="btn btn-danger">
    </form>
@endsection
