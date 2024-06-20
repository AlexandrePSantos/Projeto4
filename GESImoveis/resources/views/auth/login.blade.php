<!DOCTYPE html>
<html lang="pt">
<head>
    <title>GESImóveis | Software de Gestão de Imóveis</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex"/>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <!-- End Stylesheets -->

</head>

<body id="signin-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="body-content">
                    <div class="logo-div">
                        <a href="/">
                            <img src="{{ asset('uploads/logotipo.png') }}" alt="GESFaturação" style="max-height: 100px;">
                        </a>
                    </div>
                    <div class="header-content">
                        <h5><b>Bem-vindo ao GESImóveis</b></h5>
                    </div>
                    <form id="form-login" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <input placeholder="Email" class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus />
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <input placeholder="Password" class="form-control" type="password" id="password" name="password" required autocomplete="current-password" />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-submit">
                                <i class="fa fa-sign-in"></i> Entrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <p>
                <b>GESImóveis desenvolvido por <a href="https://www.ftkode.com" class="options-link" target="_blank">FTKode Software</a>© {{ date("Y") }} | Todos os direitos reservados.</b>
            </p>
        </div>
    </footer>

</body>
</html>
