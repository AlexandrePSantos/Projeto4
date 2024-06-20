@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    <div class="form-container">
        <h2>Editar Contrato</h2>

        <form action="{{ route('contrato.update', $contrato->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="id_inquilino">Inquilino:</label>
            <input type="text" id="id_inquilino" name="id_inquilino" value="{{ $contrato->id_inquilino }}" class="form-control">

            <label for="id_imovel">Imóvel:</label>
            <input type="text" id="id_imovel" name="id_imovel" value="{{ $contrato->id_imovel }}" class="form-control">

            <label for="id_tipo_contrato">Tipo:</label>
            <input type="text" id="id_tipo_contrato" name="id_tipo_contrato" value="{{ $contrato->id_tipo_contrato }}" class="form-control">

            <label for="data_ini">Início:</label>
            <input type="date" id="data_ini" name="data_ini" value="{{ $contrato->data_ini }}" class="form-control">

            <label for="data_fim">Fim:</label>
            <input type="date" id="data_fim" name="data_fim" value="{{ $contrato->data_fim }}" class="form-control">

            <label for="valor">Valor total:</label>
            <input type="number" id="valor" name="valor" value="{{ $contrato->valor }}" class="form-control">

            <label for="valor_pago">Valor pago:</label>
            <input type="number" id="valor_pago" name="valor_pago" value="{{ $contrato->valor_pago }}" class="form-control">

            <label for="perocidade_pag">Periocidade pagamentos:</label>
            <input type="text" id="perocidade_pag" name="perocidade_pag" value="{{ $contrato->perocidade_pag }}" class="form-control">

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" value="{{ $contrato->estado }}" class="form-control">

            <input type="submit" value="Atualizar Contrato" class="btn btn-primary">
        </form>
    </div>
@endsection
