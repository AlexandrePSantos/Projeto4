@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <div class="body-content">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Lista de Imóveis</h2>
                <a href="{{ route('imoveis.create') }}" class="add-button">Criar Imóvel</a>
                <a href="{{ route('tipo_imovel.index') }}" class="add-button">Tipos de Imóvel</a>

                <div class="table-container">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo de Imóvel</th>
                                <th>Área</th>
                                <th>Morada</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($imoveis as $imovel)
                                <tr>
                                    <td>{{ $imovel->id }}</td>
                                    <td>{{ $imovel->id_tipo_imovel }}</td>
                                    <td>{{ $imovel->area }}</td>
                                    <td>{{ $imovel->morada }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('imoveis.edit', $imovel->id) }}" class="action-button">Editar</a>
                                        <a href="{{ route('imoveis.destroy', $imovel->id) }}" class="action-button">Inativar</a>
                                        <a href="{{ route('imoveis.show', $imovel->id) }}" class="action-button">Detalhes</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
