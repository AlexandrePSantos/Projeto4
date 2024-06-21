@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<div class="form-container">
    <h2>Editar Imóvel</h2>
    <form action="{{ route('imoveis.update', ['imovel' => $imovel->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="id_tipo_imovel">Tipo de Imóvel</label>
            <select id="id_tipo_imovel" name="id_tipo_imovel" required>
                <option value="" disabled selected>Escolha um tipo de imóvel</option>
                @foreach ($tiposImovel as $tipo)
                    <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <input type="hidden" id="id_user" name="id_user" value="{{ $imovel->id_user }}" readonly>
        </div>

        <div>
            <label for="area">Área</label>
            <input type="number" step="0.01" id="area" name="area" value="{{ $imovel->area }}" required>
        </div>

        <div>
            <label for="morada">Morada</label>
            <input type="text" id="morada" name="morada" value="{{ $imovel->morada }}" required>
        </div>

        <div>
            <label for="andar">Andar</label>
            <input type="text" id="andar" name="andar" value="{{ $imovel->andar }}" required>
        </div>

        <div>
            <label for="num_divisoes">Número de Divisões</label>
            <input type="number" id="num_divisoes" name="num_divisoes" value="{{ $imovel->num_divisoes }}" required>
        </div>

        <div>
            <label for="ano_construcao">Ano de Construção</label>
            <input type="number" id="ano_construcao" name="ano_construcao" value="{{ $imovel->ano_construcao }}" required>
        </div>

        <div>
            <label for="val_seguro">Valor do Seguro</label>
            <input type="number" step="0.01" id="val_seguro" name="val_seguro" value="{{ $imovel->val_seguro }}" required>
        </div>

        <div>
            <label for="val_imi">Valor do IMI</label>
            <input type="number" step="0.01" id="val_imi" name="val_imi" value="{{ $imovel->val_imi }}" required>
        </div>

        <div>
            <label for="val_condominio">Valor do Condomínio</label>
            <input type="number" step="0.01" id="val_condominio" name="val_condominio" value="{{ $imovel->val_condominio }}" required>
        </div>

        <div>
            <label for="data_aquisicao">Data de Aquisição</label>
            <input type="date" id="data_aquisicao" name="data_aquisicao" value="{{ $imovel->data_aquisicao }}" required>
        </div>

        <div>
            <label for="preco_compra">Preço de Compra</label>
            <input type="number" step="0.01" id="preco_compra" name="preco_compra" value="{{ $imovel->preco_compra }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Imóvel</button>
    </form>
</div>
@endsection
