@extends('admin.admin_dashboard')
@section('admin')
    <h2>Editar Pagamento</h2>

    <form action="{{ route('pagamento.update', $pagamento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="id_contrato">ID Contrato:</label>
            <input type="number" id="id_contrato" name="id_contrato" value="{{ $pagamento->id_contrato }}" required>
        </div>

        <div>
            <label for="data_pag">Data Pagamento:</label>
            <input type="date" id="data_pag" name="data_pag" value="{{ $pagamento->data_pag }}" required>
        </div>

        <div>
            <label for="metodo_pag">Método de Pagamento:</label>
            <input type="text" id="metodo_pag" name="metodo_pag" value="{{ $pagamento->metodo_pag }}" required>
        </div>

        <div>
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" value="{{ $pagamento->valor }}" required>
        </div>

        <button type="submit">Atualizar Pagamento</button>
    </form>
@endsection
