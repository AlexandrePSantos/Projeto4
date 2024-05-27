@extends('admin.admin_dashboard')
@section('admin')
    <h2>Editar Despesa</h2>

    <form action="{{ route('despesa.update', $despesa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="id_imovel">ID Imóvel:</label>
            <input type="number" id="id_imovel" name="id_imovel" value="{{ $despesa->id_imovel }}" required>
        </div>

        <div>
            <label for="id_user">ID User:</label>
            <input type="number" id="id_user" name="id_user" value="{{ $despesa->id_user }}" required>
        </div>

        <div>
            <label for="id_tipo_despesa">ID Tipo Despesa:</label>
            <input type="number" id="id_tipo_despesa" name="id_tipo_despesa" value="{{ $despesa->id_tipo_despesa }}" required>
        </div>

        <div>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" value="{{ $despesa->data }}" required>
        </div>

        <div>
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" value="{{ $despesa->valor }}" required>
        </div>

        <button type="submit">Atualizar Despesa</button>
    </form>
@endsection
