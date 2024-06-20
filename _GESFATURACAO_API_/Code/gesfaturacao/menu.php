<!-- HEADER AND STATS -->
<div class="col-md-12 mts">
    <div class="row">
        <div class="col-md-2 text-center flt-left mtl no-padding">
            <a href="{{ route('dashboard') }}">
                <img class="logoimg" src="{{ asset('uploads/faturacao/logo_default.png') }}" alt="Logotipo">
            </a>
        </div>

        <div class="col-md-3 mtl">
            <p>Bem Vindo ao GESImoveis, <a href="{{ route('admin.profile') }}">{{ Auth::user()->name }}</a></p>
            <p>
                <a class="options-link text-red" href="{{ route('admin.logout') }}">Sair</a>
            </p>
        </div>

        <!-- NAVBAR -->
        <div class="col-md-7">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inquilinos.index') }}">Inquilinos</a>
                        </li>
                        @if(Auth::user()->role != 'proprietario')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('utilizadores.index') }}">Utilizadores</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('imoveis.index') }}">Imóveis</a>
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

<!-- NORMAL MENU BAR -->
<nav class="navbar navbar-custom navbar-gesfaturacao hidden-xs hidden-sm" role="navigation">
    <div class="container-fluid">
        <div class="collapse navbar-collapse no-padding" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav nav-gesfaturacao">
                <li class="home">
                    <a class="mnitemln k" href="/gesfaturacao">Visão Global</a>
                </li>

                <li class="dropdown artigos clientes tabelas importacao integracao">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tabelas <span class="caret"></span></a>
                    <ul class="dropdown-menu mainmenu-right">
                        <li class="artigos_artigos">
                            <a class="mnitemlnk" href="/gesfaturacao/artigos">Artigos</a>
                        </li>
                        <hr class="divider-custom2">
                        <li class="clientes_clientes">
                            <a class="mnitemlnk" href="/gesfaturacao/clientes">Clientes</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown mapas">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mapas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu clientes_mapas">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mapas de Clientes</a>
                            <ul class="dropdown-menu submenu-left">
                                <li class="clientes_mapas">
                                    <a class="mnitemlnk" href="/gesfaturacao/mapas/clientes">Mapa de Clientes</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>