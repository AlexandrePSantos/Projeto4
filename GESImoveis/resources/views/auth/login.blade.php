<!DOCTYPE html>
<html lang="pt">
<head>
    <title>GESImóveis | Software de Gestão de Imóveis</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex"/>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/opensans.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/oswald.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui-1.10.4.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sco.message.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('js/vendors/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/orange-blue.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gesautarquia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gesfaturacao.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.ml-keyboard.css') }}">
    <!-- End Stylesheets -->

    <!-- Add your custom styles here -->

</head>

<body id="signin-page">
    <div class="logo-div" align="center">
        <a href="/">
            <div style="width: 250px; height: auto;"></div>
        </a>
    </div>

    <div class="page-form">
        <form id="form-login" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="header-content">
                <h5 class="text-center text-white"><b>Bem-vindo ao GESImóveis</b></h5>
            </div>
            <div class="body-content">
                <div class="ptxl pbm" align="center">
                    <img class="img-responsive" src="{{ asset('uploads/faturacao/logo_default.png') }}" alt="GESFaturação" style="max-height: 100px; margin-top:0px;"/>
                </div>
                <div class="pbxl" align="center"></div>

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

                <div class="text-center ptl pbl">
                    <button type="submit" class="btn btn-grey submit_button">
                        <i class="fa fa-sign-in"></i> Entrar
                    </button>
                </div>

                <div class="text-center pbl"></div>
            </div>
        </form>
    </div>
    <div class="logo-div" align="center">
        <a href="/">
            <div style="width: 250px; height: auto;"></div>
        </a>
    </div>
    <p class="text-center">
        <b>GESImóveis desenvolvido por <a href="https://www.ftkode.com" class="options-link" target="_blank">FTKode Software</a>© {{ date("Y") }} | Todos os direitos reservados.</b>
    </p>

    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ml-keyboard.min.js') }}"></script>
    <!-- End JavaScripts -->
</body>
</html>
