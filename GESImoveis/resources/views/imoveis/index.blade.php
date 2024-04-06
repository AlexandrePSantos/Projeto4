<a href="{{ route('imoveis.create') }}" class="btn btn-primary">Criar Imóvel</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo de Imóvel</th>
            <th>Área</th>
            <th>Morada</th>
            <th>Andar</th>
            <th>Número de Divisões</th>
            <th>Ano de Construção</th>
            <th>Valor do Seguro</th>
            <th>Valor do IMI</th>
            <th>Valor do Condomínio</th>
            <th>Data de Aquisição</th>
            <th>Preço de Compra</th>
            <th>Criado em</th>
            <th>Atualizado em</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($imoveis as $imovel)
            <tr>
                <td>{{ $imovel->id }}</td>
                <td>{{ $imovel->tipoImovel->nome }}</td>
                <td>{{ $imovel->area }}</td>
                <td>{{ $imovel->morada }}</td>
                <td>{{ $imovel->andar }}</td>
                <td>{{ $imovel->num_divisoes }}</td>
                <td>{{ $imovel->ano_construcao }}</td>
                <td>{{ $imovel->val_seguro }}</td>
                <td>{{ $imovel->val_imi }}</td>
                <td>{{ $imovel->val_condominio }}</td>
                <td>{{ $imovel->data_aquisicao }}</td>
                <td>{{ $imovel->preco_compra }}</td>
                <td>{{ $imovel->created_at }}</td>
                <td>{{ $imovel->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
