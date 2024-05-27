@extends('admin.admin_dashboard')
@section('admin')
    <h2>Detalhes da Despesa</h2>

    <p><strong>ID:</strong> {{ $despesa->id }}</p>
    <p><strong>ID Imóvel:</strong> {{ $despesa->id_imovel }}</p>
    <p><strong>ID User:</strong> {{ $despesa->id_user }}</p>
    <p><strong>ID Tipo Despesa:</strong> {{ $despesa->id_tipo_despesa }}</p>
    <p><strong>Data:</strong> {{ $despesa->data }}</p>
    <p><strong>Valor:</strong> {{ $despesa->valor }}</p>

    <a href="{{ route('despesa.edit', $despesa->id) }}">Editar</a>
    <form action="{{ route('despesa.destroy', $despesa->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Remover">
    </form>
@endsection
