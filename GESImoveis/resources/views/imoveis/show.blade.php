@extends('admin.admin_dashboard')

@section('admin')
    <h2>Detalhes do Imóvel</h2>

    <p><strong>Tipo de Imóvel:</strong> {{ $imovel->id_tipo_imovel }}</p>
    <p><strong>Área:</strong> {{ $imovel->area }}</p>
    <p><strong>Morada:</strong> {{ $imovel->morada }}</p>
    <p><strong>Andar:</strong> {{ $imovel->andar }}</p>
    <p><strong>Número de Divisões:</strong> {{ $imovel->num_divisoes }}</p>
    <p><strong>Ano de Construção:</strong> {{ $imovel->ano_construcao }}</p>
    <p><strong>Valor do Seguro:</strong> {{ $imovel->val_seguro }}</p>
    <p><strong>Valor do IMI:</strong> {{ $imovel->val_imi }}</p>
    <p><strong>Valor do Condomínio:</strong> {{ $imovel->val_condominio }}</p>
    <p><strong>Data de Aquisição:</strong> {{ $imovel->data_aquisicao }}</p>
    <p><strong>Preço de Compra:</strong> {{ $imovel->preco_compra }}</p>

    <a href="{{ route('imoveis.edit', $imovel->id) }}" class="btn btn-primary">Editar Imóvel</a>

    <form action="{{ route('imoveis.destroy', $imovel->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Remover Imóvel" class="btn btn-danger">
    </form>
@endsection
