<form action="{{ route('imoveis.update', $imovel->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="id_tipo_imovel">Tipo de Imóvel</label><br>
    <select name="id_tipo_imovel" id="id_tipo_imovel">
        @foreach($tiposImovel as $tipoImovel)
            <option value="{{ $tipoImovel->id }}" {{ $imovel->id_tipo_imovel == $tipoImovel->id ? 'selected' : '' }}>{{ $tipoImovel->nome }}</option>
        @endforeach
    </select><br>

    <label for="id_user">Usuário</label><br>
    <select name="id_user" id="id_user">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $imovel->id_user == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select><br>

    <label for="area">Área</label><br>
    <input type="text" id="area" name="area" value="{{ $imovel->area }}"><br>

    <label for="morada">Morada</label><br>
    <input type="text" id="morada" name="morada" value="{{ $imovel->morada }}"><br>

    <label for="andar">Andar</label><br>
    <input type="text" id="andar" name="andar" value="{{ $imovel->andar }}"><br>

    <label for="num_divisoes">Número de Divisões</label><br>
    <input type="text" id="num_divisoes" name="num_divisoes" value="{{ $imovel->num_divisoes }}"><br>

    <label for="ano_construcao">Ano de Construção</label><br>
    <input type="text" id="ano_construcao" name="ano_construcao" value="{{ $imovel->ano_construcao }}"><br>

    <label for="val_seguro">Valor do Seguro</label><br>
    <input type="text" id="val_seguro" name="val_seguro" value="{{ $imovel->val_seguro }}"><br>

    <label for="val_imi">Valor do IMI</label><br>
    <input type="text" id="val_imi" name="val_imi" value="{{ $imovel->val_imi }}"><br>

    <label for="val_condominio">Valor do Condomínio</label><br>
    <input type="text" id="val_condominio" name="val_condominio" value="{{ $imovel->val_condominio }}"><br>

    <label for="data_aquisicao">Data de Aquisição</label><br>
    <input type="date" id="data_aquisicao" name="data_aquisicao" value="{{ $imovel->data_aquisicao }}"><br>

    <label for="preco_compra">Preço de Compra</label><br>
    <input type="text" id="preco_compra" name="preco_compra" value="{{ $imovel->preco_compra }}"><br>

    <input type="submit" value="Atualizar Imóvel">
</form>
