<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex"/>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <!-- End Stylesheets -->
</head>

<body>
<!-- HEADER -->
<header>
    <div class="container">
        <div class="logo-and-info">
            <a href="{{ route('dashboard') }}">
                <img class="logoimg" src="{{ asset('uploads/logotipo.png') }}" alt="Logotipo">
            </a>
            @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
            @endphp
            <p>Bem Vindo ao GESImoveis, <a href="{{ route('admin.profile') }}" aria-haspopup="true" aria-expanded="false">{{ $profileData->name }}</a></p>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="nav-tabs">
                <div class="nav-tab" onclick="window.location.href='{{ route('inquilinos.index') }}'">Inquilinos</div>
                @if($profileData->role != 'proprietario')
                <div class="nav-tab" onclick="window.location.href='{{ route('utilizadores.index') }}'">Utilizadores</div>
                @endif
                <div class="nav-tab" onclick="window.location.href='{{ route('imoveis.index') }}'">Imoveis</div>
                <div class="nav-tab" onclick="window.location.href='{{ route('contrato.index') }}'">Contratos</div>
                <div class="nav-tab nav-tab-red" onclick="window.location.href='{{ route('admin.logout') }}'">Sair</div>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->

</body>
</html>
