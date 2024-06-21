@extends('admin.admin_dashboard')

@section('admin')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    <div class="form-container">
        <h2>Criar Contrato</h2>

        <form action="{{ route('contrato.store') }}" method="POST">
            @csrf

            <div>
                <label for="id_inquilino">Inquilino:</label>
                <select id="id_inquilino" name="id_inquilino" class="form-control">
                    <option value="">Escolha uma opção</option>
                    @foreach ($inquilinos as $inquilino)
                        <option value="{{ $inquilino->id }}">{{ $inquilino->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_imovel">Imóvel:</label>
                <select id="id_imovel" name="id_imovel" class="form-control">
                    <option value="">Escolha uma opção</option>
                    @foreach ($imoveis as $imovel)
                        <option value="{{ $imovel->id }}">{{ $imovel->id }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_tipo_contrato">Tipo:</label>
                <select id="id_tipo_contrato" name="id_tipo_contrato" class="form-control">
                    <option value="">Escolha uma opção</option>
                    @foreach ($tiposContrato as $tipoContrato)
                        <option value="{{ $tipoContrato->id }}">{{ $tipoContrato->tipo }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="data_ini">Início:</label>
                <input type="date" id="data_ini" name="data_ini" class="form-control">
            </div>

            <div>
                <label for="data_fim">Fim:</label>
                <input type="date" id="data_fim" name="data_fim" class="form-control">
            </div>

            <div>
                <label for="valor">Valor total:</label>
                <input type="number" id="valor" name="valor" class="form-control">
            </div>

            <input type="submit" value="Criar" class="btn btn-primary">
        </form>
    </div>
@endsection
