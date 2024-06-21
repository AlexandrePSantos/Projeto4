@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<div class="form-container">
    <form action="{{ route('pagamento.store') }}" method="POST">
        @csrf

        <div>
            <label for="id_contrato">ID Contrato</label>
            <input type="number" id="id_contrato" name="id_contrato" required>
        </div>

        <div>
            <label for="data_pag">Data Pagamento</label>
            <input type="date" id="data_pag" name="data_pag" required>
        </div>

        <div>
            <label for="metodo_pag">Método de Pagamento</label>
            <input type="text" id="metodo_pag" name="metodo_pag" required>
        </div>

        <div>
            <label for="valor">Valor</label>
            <input type="number" step="0.01" id="valor" name="valor" required>
        </div>

        <button type="submit" class="btn btn-primary">Criar Pagamento</button>
    </form>
</div>
@endsection
