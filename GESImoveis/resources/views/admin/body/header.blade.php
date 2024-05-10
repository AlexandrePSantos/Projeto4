<!-- CUSTOM STYLES -->
<style type="text/css">
    .divider-custom { height: 3px; /* margin: 2px 0; */ overflow: hidden; background-color: #e5e5e5; }
    .divider-custom2 { height: 1px;  margin: 0px;  overflow: hidden; background-color: #e5e5e5; }
    img.logoimg { max-height: 100px !important; max-width: 100% !important; height: auto !important; width: auto   !important; }
    .nav-gesfaturacao { margin-left: 15px; margin-right: 15px; }
    .nav-gesfaturacao>li>a { padding-right: 10px; padding-left: 10px; }
    .mts { padding-top: 20px; }
    .navbar-nav { display: flex; flex-direction: row; }
    .navbar-nav .nav-item { margin-right: 30px; }
</style>

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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('utilizadores.index') }}">Utilizadores</a>
                            </li>
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



