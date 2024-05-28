@extends('admin.admin_dashboard')
@section('admin')
    <h2>Detalhes do Pagamento</h2>

    <p><strong>ID Contrato:</strong> {{ $pagamento->id_contrato }}</p>
    <p><strong>Data Pagamento:</strong> {{ $pagamento->data_pag }}</p>
    <p><strong>Método de Pagamento:</strong> {{ $pagamento->metodo_pag }}</p>
    <p><strong>Valor:</strong> {{ $pagamento->valor }}</p>

    <a href="{{ route('pagamento.edit', $pagamento->id) }}">Editar</a>
    <form action="{{ route('pagamento.destroy', $pagamento->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Remover">
    </form>

    <form action="{{ route('pagamento.emitirFatura', $pagamento->id) }}" method="POST">
        @csrf
        <input type="email" name="email" required>
        <input type="submit" value="Emitir Fatura" class="btn btn-primary">
    </form>

    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@endsection
