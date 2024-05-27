@extends('admin.admin_dashboard')
@section('admin')
    <h2>Criar Despesa</h2>

    <form action="{{ route('despesa.store') }}" method="POST">
        @csrf

        <div>
            <label for="id_imovel">ID Imóvel:</label>
            <input type="number" id="id_imovel" name="id_imovel" required>
        </div>

        <div>
            <label for="id_user">ID User:</label>
            <input type="number" id="id_user" name="id_user" required>
        </div>

        <div>
            <label for="id_tipo_despesa">ID Tipo Despesa:</label>
            <input type="number" id="id_tipo_despesa" name="id_tipo_despesa" required>
        </div>

        <div>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>
        </div>

        <div>
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" required>
        </div>

        <button type="submit">Criar Despesa</button>
    </form>
@endsection
