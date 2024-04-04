<form action="{{ route('utilizadores.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="role">Tipo</label><br>
    <select name="role" id="role">
        <option value="admin">Admin</option>
        <option value="proprietario">Proprietario</option>
    </select><br>

    <label for="name">Nome</label><br>
    <input type="text" id="name" name="name"><br>

    <label for="email">Email</label><br>
    <input type="email" id="email" name="email"><br>

    <label for="telemovel">Telemovél</label><br>
    <input type="text" id="telemovel" name="telemovel"><br>

    <label for="titulo">Titulo</label><br>
    <select name="titulo" id="titulo">
        <option value="Sr.">Sr.</option>
        <option value="Sra.">Sra.</option>
    </select><br>

    <label for="morada">Localidade</label><br>
    <input type="text" id="morada" name="morada"><br>

    <label for="codigo_postal">Código Postal</label><br>
    <input type="text" id="codigo_postal" name="codigo_postal"><br>

    <label for="cidade">Cidade</label><br>
    <input type="text" id="cidade" name="cidade"><br>

    <label for="pais">Pais</label><br>
    <input type="text" id="pais" name="pais"><br>

    <label for="nif">NIF</label><br>
    <input type="text" id="nif" name="nif"><br>

    {{--<label for="foto">Foto</label><br>
    <input type="file" id="foto" name="foto"> --}}

    <input type="hidden" id="estado" name="estado" value="ativo"><br>
    <input type="hidden" id="password" name="password" value="123456"><br>

    <input type="submit" value="Criar Utilizador">
</form>
