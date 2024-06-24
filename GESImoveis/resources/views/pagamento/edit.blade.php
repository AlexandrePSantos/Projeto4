@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<div class="form-container">
    <h2>Editar Pagamento</h2>

    <form action="{{ route('pagamento.update', $pagamento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="id_contrato">ID Contrato</label>
            <select id="id_contrato" name="id_contrato" required>
                @foreach($contratos as $contrato)
                    <option value="{{ $contrato->id }}" {{ $contrato->id == $pagamento->id_contrato ? 'selected' : '' }}>
                        {{ $contrato->id }} - {{ $contrato->inquilino->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="data_pag">Data Pagamento:</label>
            <input type="date" id="data_pag" name="data_pag" value="{{ $pagamento->data_pag }}" required>
        </div>

        <div>
            <label for="metodo_pag">Método de Pagamento</label>
            <select id="metodo_pag" name="metodo_pag" required>
                <option value="MBWay" {{ $pagamento->metodo_pag == 'MBWay' ? 'selected' : '' }}>MBWay</option>
                <option value="Transferência" {{ $pagamento->metodo_pag == 'Transferência' ? 'selected' : '' }}>Transferência</option>
            </select>
        </div>

        <div>
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" value="{{ $pagamento->valor }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Pagamento</button>
    </form>
</div>
@endsection
