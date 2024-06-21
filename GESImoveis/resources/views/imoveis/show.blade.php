@extends('admin.admin_dashboard')

@section('admin')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">

<div class="body-content">
    <div class="card">
        <div class="card-title">Detalhes do Imóvel</div>

        <div class="table-container">
            <table>
                <tr>
                    <th>Tipo de Imóvel</th>
                    <td>{{ $imovel->id_tipo_imovel }}</td>
                </tr>
                <tr>
                    <th>Área</th>
                    <td>{{ $imovel->area }}</td>
                </tr>
                <tr>
                    <th>Morada</th>
                    <td>{{ $imovel->morada }}</td>
                </tr>
                <tr>
                    <th>Andar</th>
                    <td>{{ $imovel->andar }}</td>
                </tr>
                <tr>
                    <th>Número de Divisões</th>
                    <td>{{ $imovel->num_divisoes }}</td>
                </tr>
                <tr>
                    <th>Ano de Construção</th>
                    <td>{{ $imovel->ano_construcao }}</td>
                </tr>
                <tr>
                    <th>Valor do Seguro</th>
                    <td>{{ $imovel->val_seguro }}</td>
                </tr>
                <tr>
                    <th>Valor do IMI</th>
                    <td>{{ $imovel->val_imi }}</td>
                </tr>
                <tr>
                    <th>Valor do Condomínio</th>
                    <td>{{ $imovel->val_condominio }}</td>
                </tr>
                <tr>
                    <th>Data de Aquisição</th>
                    <td>{{ $imovel->data_aquisicao }}</td>
                </tr>
                <tr>
                    <th>Preço de Compra</th>
                    <td>{{ $imovel->preco_compra }}</td>
                </tr>
            </table>

            <div class="action-buttons">
                @if ($imovel->estado == 'ativo')
                    <a href="{{ route('imoveis.edit', $imovel->id) }}" class="btn btn-primary ">Editar</a>
                    <form action="{{ route('imoveis.destroy', $imovel->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-outside-table">Inativar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
