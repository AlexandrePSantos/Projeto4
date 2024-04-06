<form action="{{ route('imoveis.store') }}" method="POST">
    @csrf

    <label for="id_tipo_imovel">Tipo de Imóvel</label><br>
    <select name="id_tipo_imovel" id="id_tipo_imovel">
        @foreach($tiposImovel as $tipoImovel)
            <option value="{{ $tipoImovel->id }}">{{ $tipoImovel->nome }}</option>
        @endforeach
    </select><br>

    <label for="id_user">Usuário</label><br>
    <select name="id_user" id="id_user">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select><br>

    <label for="area">Área</label><br>
    <input type="text" id="area" name="area"><br>

    <label for="morada">Morada</label><br>
    <input type="text" id="morada" name="morada"><br>

    <label for="andar">Andar</label><br>
    <input type="text" id="andar" name="andar"><br>

    <label for="num_divisoes">Número de Divisões</label><br>
    <input type="text" id="num_divisoes" name="num_divisoes"><br>

    <label for="ano_construcao">Ano de Construção</label><br>
    <input type="text" id="ano_construcao" name="ano_construcao"><br>

    <label for="val_seguro">Valor do Seguro</label><br>
    <input type="text" id="val_seguro" name="val_seguro"><br>

    <label for="val_imi">Valor do IMI</label><br>
    <input type="text" id="val_imi" name="val_imi"><br>

    <label for="val_condominio">Valor do Condomínio</label><br>
    <input type="text" id="val_condominio" name="val_condominio"><br>

    <label for="data_aquisicao">Data de Aquisição</label><br>
    <input type="date" id="data_aquisicao" name="data_aquisicao"><br>

    <label for="preco_compra">Preço de Compra</label><br>
    <input type="text" id="preco_compra" name="preco_compra"><br>

    <input type="submit" value="Criar Imóvel">
</form>
