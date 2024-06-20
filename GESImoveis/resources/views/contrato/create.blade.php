@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    <div class="form-container">
        <h2>Criar Contrato</h2>

        <form action="{{ route('contrato.store') }}" method="POST">
            @csrf

            <label for="id_inquilino">Inquilino:</label>
            <input type="text" id="id_inquilino" name="id_inquilino" class="form-control">

            <label for="id_imovel">Imóvel:</label>
            <input type="text" id="id_imovel" name="id_imovel" class="form-control">

            <label for="id_tipo_contrato">Tipo:</label>
            <input type="text" id="id_tipo_contrato" name="id_tipo_contrato" class="form-control">

            <label for="data_ini">Início:</label>
            <input type="date" id="data_ini" name="data_ini" class="form-control">

            <label for="data_fim">Fim:</label>
            <input type="date" id="data_fim" name="data_fim" class="form-control">

            <label for="valor">Valor total:</label>
            <input type="number" id="valor" name="valor" class="form-control">

            <label for="valor_pago">Valor pago:</label>
            <input type="number" id="valor_pago" name="valor_pago" value="0" readonly class="form-control">

            <label for="perocidade_pag">Periocidade pagamentos:</label>
            <input type="text" id="perocidade_pag" name="perocidade_pag" class="form-control">

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" class="form-control">

            <label for="data_termino">Termino:</label>
            <input type="date" id="data_termino" name="data_termino" class="form-control">

            <input type="submit" value="Create" class="btn btn-primary">
        </form>
    </div>
@endsection
