@extends('admin.admin_dashboard')

@section('admin')

<form action="{{ route('contrato.store') }}" method="POST">
    @csrf

    <label for="id_inquilino">Inquilino</label>
    <input type="text" id="id_inquilino" name="id_inquilino">

    <label for="id_imovel">Imovel</label>
    <input type="text" id="id_imovel" name="id_imovel">

    <label for="id_tipo_contrato">Tipo</label>
    <input type="text" id="id_tipo_contrato" name="id_tipo_contrato">

    <label for="data_ini">Inicio</label>
    <input type="date" id="data_ini" name="data_ini">

    <label for="data_fim">Fim</label>
    <input type="date" id="data_fim" name="data_fim">

    <label for="valor">Valor total</label>
    <input type="number" id="valor" name="valor">

    <input type="hidden" id="valor_pago" name="valor_pago" value="0" readonly>

    <label for="perocidade_pag">Perocidade pagamentos</label>
    <input type="text" id="perocidade_pag" name="perocidade_pag">

    <label for="estado">Estado</label>
    <input type="text" id="estado" name="estado">

    <label for="data_termino">Termino</label>
    <input type="date" id="data_termino" name="data_termino">

    <input type="submit" value="Create">
</form>

@endsection
