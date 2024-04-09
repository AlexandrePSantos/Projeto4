@section('utilizadores')
    <h1>Edit Utilizador</h1>

    <form action="{{ route('utilizadores.update', ['utilizadore' => $utilizador->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="role">Tipo</label><br>
        <select name="role" id="role">
            <option value="admin" {{ $utilizador->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="proprietario" {{ $utilizador->role == 'proprietario' ? 'selected' : '' }}>Proprietario</option>
        </select><br>

        <label for="name">Nome</label><br>
        <input type="text" id="name" name="name" value="{{ $utilizador->name }}"><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="{{ $utilizador->email }}"><br>

        <label for="telemovel">Telemovél</label><br>
        <input type="text" id="telemovel" name="telemovel" value="{{ $utilizador->telemovel }}"><br>

        <label for="titulo">Titulo</label><br>
        <select name="titulo" id="titulo">
            <option value="Sr." {{ $utilizador->titulo == 'Sr.' ? 'selected' : '' }}>Sr.</option>
            <option value="Sra." {{ $utilizador->titulo == 'Sra.' ? 'selected' : '' }}>Sra.</option>
        </select><br>

        <label for="morada">Localidade</label><br>
        <input type="text" id="morada" name="morada" value="{{ $utilizador->morada }}"><br>

        <label for="codigo_postal">Código Postal</label><br>
        <input type="text" id="codigo_postal" name="codigo_postal" value="{{ $utilizador->codigo_postal }}"><br>

        <label for="cidade">Cidade</label><br>
        <input type="text" id="cidade" name="cidade" value="{{ $utilizador->cidade }}"><br>

        <label for="pais">Pais</label><br>
        <input type="text" id="pais" name="pais" value="{{ $utilizador->pais }}"><br>

        <label for="nif">NIF</label><br>
        <input type="text" id="nif" name="nif" value="{{ $utilizador->nif }}"><br>

        <label for="foto">Foto</label><br>
        <input type="file" id="foto" name="foto"><br>

        <input type="hidden" id="estado" name="estado" value="{{ $utilizador->estado }}"><br>

        <input type="submit" value="Update Utilizador">
    </form>
@endsection

