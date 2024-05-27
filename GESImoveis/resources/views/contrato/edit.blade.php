@extends('admin.admin_dashboard')
{{-- @extends('proprietario.proprietario_dashboard') --> por criar --}}

@section('admin')
    <h2>Editar Contrato</h2>

    <form action="{{ route('contratos.update', $contrato->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="id_inquilino">Inquilino:</label>
        <input type="text" id="id_inquilino" name="id_inquilino" value="{{ $contrato->id_inquilino }}">

        <label for="id_imovel">Imovel:</label>
        <input type="text" id="id_imovel" name="id_imovel" value="{{ $contrato->id_imovel }}">

        <label for="id_tipo_contrato">Tipo:</label>
        <input type="text" id="id_tipo_contrato" name="id_tipo_contrato" value="{{ $contrato->id_tipo_contrato }}">

        <label for="data_ini">Inicio:</label>
        <input type="date" id="data_ini" name="data_ini" value="{{ $contrato->data_ini }}">

        <label for="data_fim">Fim:</label>
        <input type="date" id="data_fim" name="data_fim" value="{{ $contrato->data_fim }}">

        <label for="valor">Valor total:</label>
        <input type="number" id="valor" name="valor" value="{{ $contrato->valor }}">

        <label for="valor_pago">Valor pago:</label>
        <input type="number" id="valor_pago" name="valor_pago" value="{{ $contrato->valor_pago }}">

        <label for="perocidade_pag">Perocidade pagamentos:</label>
        <input type="text" id="perocidade_pag" name="perocidade_pag" value="{{ $contrato->perocidade_pag }}">

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="{{ $contrato->estado }}">

        <input type="submit" value="Atualizar Contrato">
    </form>
@endsection
