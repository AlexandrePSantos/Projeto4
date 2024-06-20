@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <div class="body-content">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Lista de Tipos de Contrato</h2>

                <div class="table-container">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos as $tipo)
                                <tr>
                                    <td>{{ $tipo->id }}</td>
                                    <td>{{ $tipo->nome }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('tipo_contrato.edit', $tipo->id) }}" class="action-button">Editar</a>
                                        <a href="{{ route('tipo_contrato.destroy', $tipo->id) }}" class="action-button">Inativar</a>
                                    </td>
                                </tr>
                            @endforeach

                            @can('create', App\Models\TipoContrato::class)
                                <tr>
                                    <form action="{{ route('tipo_contrato.store') }}" method="POST">
                                        @csrf
                                        <td></td>
                                        <td><input type="text" name="nome" required></td>
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
