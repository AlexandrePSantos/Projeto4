@extends('admin.admin_dashboard')

@section('admin')
    <h2>Detalhes do Contrato</h2>

    <p><strong>ID:</strong> {{ $contrato->id }}</p>
    <p><strong>Inquilino:</strong> {{ $contrato->id_inquilino }}</p>
    <p><strong>Imovel:</strong> <a href="{{ route('imoveis.show', $contrato->id_imovel) }}">{{ $contrato->id_imovel }}</a></p>
    <p><strong>Tipo:</strong> {{ $contrato->id_tipo_contrato }}</p>
    <p><strong>Inicio:</strong> {{ $contrato->data_ini }}</p>
    <p><strong>Fim:</strong> {{ $contrato->data_fim }}</p>
    <p><strong>Valor total:</strong> {{ $contrato->valor }}</p>
    <p><strong>Valor pago:</strong> {{ $contrato->valor_pago }}</p>
    <p><strong>Valor em falta:</strong> {{ $contrato->valor - $contrato->valor_pago }}</p>
    <p><strong>Perocidade pagamentos:</strong> <a href="{{ route('pagamento.index', ['contrato' => $contrato->id]) }}">{{ $contrato->perocidade_pag }}</a></p>
    <p><strong>Estado:</strong> {{ $contrato->estado }}</p>
    <p><strong>Termino:</strong> {{ $contrato->data_termino }}</p>

    <a href="{{ route('contrato.edit', $contrato->id) }}" class="btn btn-primary">Editar Contrato</a>

    <form action="{{ route('contrato.destroy', $contrato->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Terminar Contrato" class="btn btn-danger">
    </form>
@endsection
