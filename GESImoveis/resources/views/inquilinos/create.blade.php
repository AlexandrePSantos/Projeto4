@extends('admin.admin_dashboard')

@section('admin')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<div class="form-container">
    <h2>Adicionar Inquilino</h2>

    <form action="{{ route('inquilinos.store') }}" method="POST">
        @csrf

        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
        </div>

        <div>
            <label for="apelido">Apelido:</label>
            <input type="text" id="apelido" name="apelido">
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label for="telemovel">Telemovél:</label>
            <input type="text" id="telemovel" name="telemovel">
        </div>

        <div>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone">
        </div>

        <div>
            <label for="morada">Morada:</label>
            <input type="text" id="morada" name="morada">
        </div>

        <div>
            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal">
        </div>

        <div>
            <label for="nif">NIF:</label>
            <input type="text" id="nif" name="nif">
        </div>

        <input type="submit" class="btn btn-primary" value="Adicionar Inquilino">
    </form>
</div>
@endsection
