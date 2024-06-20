<!-- HEADER AND STATS -->
<div class="col-md-12 mts">
    <div class="row">
        <div class="col-md-2 text-center flt-left mtl no-padding">
            <a href="{{ route('dashboard') }}">
                <img class="logoimg" src="{{ asset('uploads/faturacao/logo_default.png') }}" alt="Logotipo">
            </a>
        </div>

        <div class="col-md-3 mtl">
            @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
            @endphp
            <p>Bem Vindo ao GESImoveis, <a href="{{ route('admin.profile') }}" aria-haspopup="true" aria-expanded="false">{{ $profileData->name }}</a><p>
            <p>
                <a class="options-link text-red" href="{{ route('admin.logout') }}">Sair</a>
            </p>
            <!-- NAVBAR -->
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('inquilinos.index') }}">Inquilinos</a>
                            </li>
                            @if($profileData->role != 'proprietario')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('utilizadores.index') }}">Utilizadores</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('imoveis.index') }}">Imoveis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contrato.index') }}">Contratos</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
