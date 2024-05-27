@extends('admin.admin_dashboard')
{{-- @extends('proprietario.proprietario_dashboard') --> por criar --}}

@section('admin')
    <h2>Editar Inquilino Admin</h2>

    <form action="{{ route('inquilinos.update', $inquilino->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ $inquilino->nome }}">

        <label for="apelido">Apelido:</label>
        <input type="text" id="apelido" name="apelido" value="{{ $inquilino->apelido }}">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $inquilino->email }}">

        <label for="telemovel">Telemovél:</label>
        <input type="text" id="telemovel" name="telemovel" value="{{ $inquilino->telemovel }}">

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="{{ $inquilino->telefone }}">

        <label for="morada">Morada:</label>
        <input type="text" id="morada" name="morada" value="{{ $inquilino->morada }}">

        <label for="codigo_postal">Código Postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal" value="{{ $inquilino->codigo_postal }}">

        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" value="{{ $inquilino->nif }}">

        <input type="submit" value="Atualizar Inquilino">
    </form>
@endsection
