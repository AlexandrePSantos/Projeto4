@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <div class="body-content">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tipos de Imóvel</h2>

                <form action="{{ route('tipo_imovel.store') }}" method="POST" class="form-inline mb-3">
                    @csrf
                    <div class="input-icon">
                        <input type="text" id="tipo" name="tipo" placeholder="Descrição" class="form-control mr-2" required>
                        <button type="submit" class="add-button">Criar</button>
                    </div>
                </form>

                <div class="table-container">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiposImovel as $tipo)
                                <tr>
                                    <td>{{ $tipo->id }}</td>
                                    <td>{{ $tipo->tipo }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('tipo_imovel.edit', $tipo->id) }}" class="action-button">Editar</a>
                                        <a href="{{ route('tipo_imovel.destroy', $tipo->id) }}" class="action-button">Inativar</a>
                                    </td>
                                </tr>
                            @endforeach
                            @can('create', App\Models\TipoImovel::class)
                                <tr>
                                    <form action="{{ route('tipo_imovel.store') }}" method="POST">
                                        @csrf
                                        <td></td>
                                        <td><input type="text" name="tipo" placeholder="Descrição" class="form-control" required></td>
                                        <td><button type="submit" class="action-button">Criar</button></td>
                                    </form>
                                </tr>
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
