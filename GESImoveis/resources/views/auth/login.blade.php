<!DOCTYPE html>
<html lang="pt">
<head>
    <title>GESImóveis | Software de Gestão de Imóveis</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex"/>

    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/fonts/opensans.css">
    <link type="text/css" rel="stylesheet" href="/fonts/oswald.css">
    <link type="text/css" rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/sco.message.css">
    <link type="text/css" rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="/js/vendors/bootstrap-select/bootstrap-select.min.css">

    <link type="text/css" rel="stylesheet" href="css/orange-blue.css" >
    <link type="text/css" rel="stylesheet" href="css/gesautarquia.css" >
    <link type="text/css" rel="stylesheet" href="/css/gesfaturacao.css" >

    <link rel="stylesheet" type="text/css" href="css/jquery.ml-keyboard.css"/>
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
                    <img class="img-responsive" src="/uploads/faturacao/logo_default.png" alt="GESFaturação" style="max-height: 100px; margin-top:0px;"/>
                </div>                <div class="pbxl" align="center"> </div>

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

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="text-center ptl pbl">
                    <button type="submit" class="btn btn-grey submit_button" >
                        <i class="fa fa-sign-in"></i> Entrar
                    </button>
                </div>

                <div class="text-center pbl">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="options-link" ><i class="fa fa-key"></i> Recuperar Password</a>
                    @endif
                </div>

                <div class="text-center pbl"> </div>
            </div>
        </form>
    </div>
    <div class="logo-div" align="center">
        <a href="/">
            <div style="width: 250px; height: auto;"></div>
        </a>
    </div>
    <p class="text-center">
        <b >GESImóveis desenvolvido por<a href="https://www.ftkode.com" class="options-link" target="_blank">FTKode Software</a>© {{ date("Y") }} | Todos os direitos reservados. </b>
    </p>
</body>

<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="/js/jquery.ml-keyboard.min.js"></script>

<script>
    let keyboardActive = false;

    $('#keyboard_login').click(function(){
        if(keyboardActive){
            keyboardActive = false
            setCookie('vkeyboard_login', keyboardActive)
            $(this).html('<i class="fa fa-keyboard-o"></i> Ativar Teclado Virtual')
        }else{
            keyboardActive = true
            setCookie('vkeyboard_login', keyboardActive)
            $(this).html('<i class="fa fa-keyboard-o"></i> Desativar Teclado Virtual')
        }
    });

    function closeKeyboard() {
        $('#mlkeyboard').removeClass('force-open');
        $('#mlkeyboard').hide();
    }

    function setCookie(cname, cvalue) {
        let tenYearsFromNow = new Date();
        tenYearsFromNow.setFullYear(tenYearsFromNow.getFullYear() + 10);
        document.cookie = cname + "=" + cvalue + ";expires=" + tenYearsFromNow + "; path=/;";
    }

    $(document).ready(function(e) {
        let vkeyboardLogin = getCookie('vkeyboard_login')
        keyboardActive = vkeyboardLogin == '' || vkeyboardLogin == 'false'   ? false : true
        if(keyboardActive){
            $('#keyboard_login').html('<i class="fa fa-keyboard-o"></i> Desativar Teclado Virtual')
        }else{
            $('#keyboard_login').html('<i class="fa fa-keyboard-o"></i> Ativar Teclado Virtual')
        }

        $('#username,#password').mlKeyboard({layout: 'pt_PT',active_shift: false});

        let closeKeyboardBtn = '<div><div class="keyboard-corner">' +
            '<div class="circCont">' +
            '<button onclick="closeKeyboard()" class="circle" data-animation="simpleRotate" data-remove="200"></button></div></div>'

        $('#mlkeyboard ul').append(closeKeyboardBtn);
    });
</script>

</html>
