@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <div class="body-content">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Lista de Pagamentos</h2>
                <a href="{{ route('pagamento.create') }}" class="add-button">Criar Pagamento</a>

                <div class="table-container">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Contrato</th>
                                <th>Data Pagamento</th>
                                <th>Método de Pagamento</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagamentos as $pagamento)
                                <tr>
                                    <td>{{ $pagamento->id }}</td>
                                    <td>{{ $pagamento->id_contrato }}</td>
                                    <td>{{ $pagamento->data_pag }}</td>
                                    <td>{{ $pagamento->metodo_pag }}</td>
                                    <td>{{ $pagamento->valor }}</td>
                                    <td class="action-buttons">
                                        <a href="{{ route('pagamento.edit', $pagamento->id) }}" class="action-button">Editar</a>
                                        <a href="{{ route('pagamento.show', $pagamento->id) }}" class="action-button">Detalhes</a>
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
