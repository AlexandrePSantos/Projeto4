@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    <div class="form-container">
        <h1>Edit Utilizador</h1>

        <form method="POST" action="{{ route('utilizadores.update', ['utilizador' => $utilizador->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="role">Tipo</label><br>
                <select name="role" id="role" class="form-control">
                    <option value="admin" {{ $utilizador->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="proprietario" {{ $utilizador->role == 'proprietario' ? 'selected' : '' }}>Proprietario</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nome</label><br>
                <input type="text" id="name" name="name" value="{{ $utilizador->name }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="{{ $utilizador->email }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="telemovel">Telemóvel</label><br>
                <input type="text" id="telemovel" name="telemovel" value="{{ $utilizador->telemovel }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="titulo">Título</label><br>
                <select name="titulo" id="titulo" class="form-control">
                    <option value="Sr." {{ $utilizador->titulo == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                    <option value="Sra." {{ $utilizador->titulo == 'Sra.' ? 'selected' : '' }}>Sra.</option>
                </select>
            </div>

            <div class="form-group">
                <label for="morada">Localidade</label><br>
                <input type="text" id="morada" name="morada" value="{{ $utilizador->morada }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="codigo_postal">Código Postal</label><br>
                <input type="text" id="codigo_postal" name="codigo_postal" value="{{ $utilizador->codigo_postal }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label><br>
                <input type="text" id="cidade" name="cidade" value="{{ $utilizador->cidade }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="pais">País</label><br>
                <input type="text" id="pais" name="pais" value="{{ $utilizador->pais }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="nif">NIF</label><br>
                <input type="text" id="nif" name="nif" value="{{ $utilizador->nif }}" class="form-control">
            </div>

            <input type="hidden" id="estado" name="estado" value="{{ $utilizador->estado }}">

            <div class="form-group">
                <input type="submit" value="Update Utilizador" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
