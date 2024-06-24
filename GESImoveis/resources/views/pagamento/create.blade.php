@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">

<div class="form-container">
    <form action="{{ route('pagamento.store') }}" method="POST">
        @csrf

        <div>
            <label for="id_contrato">ID Contrato</label>
            <select id="id_contrato" name="id_contrato" required>
                @foreach($contratos as $contrato)
                    <option value="{{ $contrato->id }}">{{ $contrato->id }} - {{ $contrato->inquilino->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="data_pag">Data Pagamento</label>
            <input type="date" id="data_pag" name="data_pag" required>
        </div>

        <div>
            <label for="metodo_pag">Método de Pagamento</label>
            <select id="metodo_pag" name="metodo_pag" required>
                <option value="MBWay">MBWay</option>
                <option value="Transferência">Transferência</option>
            </select>
        </div>

        <div>
            <label for="valor">Valor</label>
            <input type="number" step="0.01" id="valor" name="valor" required>
        </div>
        <div>

            <label for="valor_falta">Valor em Falta</label>
            <input type="number" step="0.01" id="valor_falta" name="valor_falta" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Criar Pagamento</button>
    </form>
</div>
<script>
    document.getElementById('id_contrato').addEventListener('change', function() {
        var contratoId = this.value;
        if(contratoId) {
            fetch(`/contrato/${contratoId}/valor-em-falta`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('valor_falta').value = data.valor_em_falta;
                });
        }
    });
</script>
@endsection
