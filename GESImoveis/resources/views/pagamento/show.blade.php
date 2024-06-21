@extends('admin.admin_dashboard')

@section('admin')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">

<div class="body-content">
<div class="card">
    <div class="card-title">Detalhes do Pagamento</div>

    <div class="table-container">
        <table>
            <tr>
                <th>ID Contrato</th>
                <td>{{ $pagamento->id_contrato }}</td>
            </tr>
            <tr>
                <th>Data Pagamento</th>
                <td>{{ $pagamento->data_pag }}</td>
            </tr>
            <tr>
                <th>Método de Pagamento</th>
                <td>{{ $pagamento->metodo_pag }}</td>
            </tr>
            <tr>
                <th>Valor</th>
                <td>{{ $pagamento->valor }}</td>
            </tr>
        </table>

        <div class="action-buttons">
            <a href="{{ route('pagamento.edit', $pagamento->id) }}" class="btn btn-primary btn-outside-table">Editar</a>

            <form action="{{ route('pagamento.destroy', $pagamento->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-outside-table">Remover</button>
            </form>

            <form action="{{ route('pagamento.emitirFatura', $pagamento->id) }}" method="POST">
                @csrf
                <input type="email" name="email" required placeholder="Email para enviar a fatura">
                <button type="submit" class="btn btn-primary btn-outside-table">Emitir Fatura</button>
            </form>
        </div>
    </div>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
</div>
</div>
@endsection
