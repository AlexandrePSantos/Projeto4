@extends('admin.admin_dashboard')
{{-- @extends('proprietario.proprietario_dashboard') --> por criar --}}

@section('admin')
    <h2>Detalhes do Inquilino</h2>

    <p><strong>Nome:</strong> {{ $inquilino->nome }}</p>
    <p><strong>Apelido:</strong> {{ $inquilino->apelido }}</p>
    <p><strong>Email:</strong> {{ $inquilino->email }}</p>
    <p><strong>Telemovél:</strong> {{ $inquilino->telemovel }}</p>
    <p><strong>Telefone:</strong> {{ $inquilino->telefone }}</p>
    <p><strong>Morada:</strong> {{ $inquilino->morada }}</p>
    <p><strong>Código Postal:</strong> {{ $inquilino->codigo_postal }}</p>
    <p><strong>NIF:</strong> {{ $inquilino->nif }}</p>

    <a href="{{ route('inquilinos.edit', $inquilino->id) }}">Editar</a>
    <form action="{{ route('inquilinos.destroy', $inquilino->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Remover">
    </form>
@endsection
