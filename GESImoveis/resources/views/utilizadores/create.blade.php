@extends('admin.admin_dashboard')
@section('admin')

<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<div class="form-container">
    <h1>Criar Utilizador</h1>

    <form action="{{ route('utilizadores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="role">Tipo</label><br>
            <select name="role" id="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="proprietario">Proprietário</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Nome</label><br>
            <input type="text" id="name" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="telemovel">Telemóvel</label><br>
            <input type="text" id="telemovel" name="telemovel" class="form-control">
        </div>

        <div class="form-group">
            <label for="titulo">Título</label><br>
            <select name="titulo" id="titulo" class="form-control">
                <option value="Sr.">Sr.</option>
                <option value="Sra.">Sra.</option>
            </select>
        </div>

        <div class="form-group">
            <label for="morada">Localidade</label><br>
            <input type="text" id="morada" name="morada" class="form-control">
        </div>

        <div class="form-group">
            <label for="codigo_postal">Código Postal</label><br>
            <input type="text" id="codigo_postal" name="codigo_postal" class="form-control">
        </div>

        <div class="form-group">
            <label for="cidade">Cidade</label><br>
            <input type="text" id="cidade" name="cidade" class="form-control">
        </div>

        <div class="form-group">
            <label for="pais">País</label><br>
            <input type="text" id="pais" name="pais" class="form-control">
        </div>

        <div class="form-group">
            <label for="nif">NIF</label><br>
            <input type="text" id="nif" name="nif" class="form-control">
        </div>

        <input type="hidden" id="estado" name="estado" value="ativo">
        <input type="hidden" id="password" name="password" value="123456">

        <div class="form-group">
            <input type="submit" value="Criar Utilizador" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection
