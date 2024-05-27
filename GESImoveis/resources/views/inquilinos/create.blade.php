@extends('admin.admin_dashboard')
{{-- @extends('proprietario.proprietario_dashboard') --> por criar --}}

@section('admin')
    <h2>Adicionar Inquilino</h2>

    <form action="{{ route('inquilinos.store') }}" method="POST">
        @csrf

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome">

        <label for="apelido">Apelido:</label>
        <input type="text" id="apelido" name="apelido">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="telemovel">Telemovél:</label>
        <input type="text" id="telemovel" name="telemovel">

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">

        <label for="morada">Morada:</label>
        <input type="text" id="morada" name="morada">

        <label for="codigo_postal">Código Postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal">

        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif">

        <input type="submit" value="Adicionar Inquilino">
    </form>
@endsection
