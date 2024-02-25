<html lang="pt">
<head>
	<title>GESFaturação | Software de Faturação Online</title>
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
	<style>
		/*virtual keyboard*/
		@media screen and (min-width: 700px) {
			.keyboard-corner {
				bottom: 315px;
				right: 500px;
			}

			div#mlkeyboard ul li.active {
				background-color: #5F8C46;
				border-color: #6FDA54;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul {
				width: 1000px;
				height: 346px;
				margin:0 auto;
				padding:0px;
				border-radius:5px 5px 0 0
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul li {
				width:60px;
				height:60px;
				line-height:60px;
				margin:2.5px
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-backspace {
				width: 93px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-tab {
				width: 93.5px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-capslock {
				width: 110.5px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-return {
				width: 112px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-space {
				width: 990px;
			}
		}

		@media screen and (min-width: 540px) {
			div#mlkeyboard ul #mlkeyboard-right-shift {
				width: 147px;
				margin-right:0
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-left-shift {
				width: 144px;
			}
		}

		div#mlkeyboard ul li {
			border: 2px solid #e86646;
			color: #333;
			font-size: 25px;
			font-weight: bold;
			border-radius: 0px;
		}

		#mlkeyboard{
			z-index:250000;
		}

		div#mlkeyboard ul {
			margin-bottom: 5px !important;
			border-radius: 5px;
		}

		div#mlkeyboard ul.mlkeyboard-modifications{
			height:69px
		}

		.keyboard-corner {
			bottom: 375px !important;
			left: 955px !important;
			position: relative !important;
		}

		.circle {
			background: white;
			width: 40px;
			height: 40px;
			/* background: transparent;*/
			border: 4px solid #cd0c0d;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
			position: relative;
			cursor: pointer;
			display: inline-block;
			margin: 10px 20px;
		}
		.circle:after {
			width: 24px;
			height: 4px;
			background-color: #cd0c0d;
			content: "";
			left: 50%;
			top: 50%;
			margin-left: -12px;
			margin-top: -2px;
			position: absolute;
			-moz-transform: rotate(-45deg);
			-ms-transform: rotate(-45deg);
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			/*@include transform-origin(100%,100%);*/
		}
		.circle:before {
			left: 50%;
			top: 50%;
			margin-left: -12px;
			margin-top: -2px;
			width: 24px;
			height: 4px;
			background-color: #cd0c0d;
			content: "";
			position: absolute;
			-moz-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg);
			/*@include transform-origin(0%,0%);*/
		}
	</style>
</head>

<body id="signin-page">
	<div align="center" class="fullscreen">
		<i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw " style="margin-top: 20%"></i>
	</div>
	<div class="logo-div" align="center">
		<a href="/"><img src="/images/logo.png" style="max-width: 250px;"/></a>
	</div>

	<div class="page-form">
		<form id="form-login" >
			<div class="header-content">
				<h5 class="text-center text-white"><b>Bem-vindo ao GESFaturação</b></h5>
			</div>
			<div class="body-content">
				<div class="ptxl pbm" align="center">
					<?php
					$callback_image = "/uploads/faturacao/logo_default.png";
					$image = $callback_image;

					echo '<img class="img-responsive" src="'.$image.'" alt="GESFaturação" style="max-height: 100px; margin-top:0px;"/>';
					?>
				</div>
				<div class="pbxl" align="center"> </div>
				<div class="form-group">
					<div class="input-icon">
						<i class="fa fa-user"></i>
						<input placeholder="Username" class="form-control" type="text" id="username" name="username" />
					</div>
				</div>
				<div class="form-group">
					<div class="input-icon">
						<i class="fa fa-lock"></i>
						<input placeholder="Password" class="form-control" type="password" id="password" name="password" />
					</div>
				</div>
				<div class="text-center ptl pbl">
					<button type="submit" class="btn btn-grey submit_button" >
						<i class="fa fa-sign-in"></i> Entrar
					</button>
				</div>
				<div class="text-center pbl">
					<a href="recuperar-password.php" class="options-link" ><i class="fa fa-key"></i> Recuperar Password</a>
					|
					<a id="keyboard_login" class="keyboard_login options-link" ><i class="fa fa-keyboard-o"></i> Ativar Teclado Virtual</a>
				</div>

				<div class="text-center pbl"> </div>
			</div>
		</form>
	</div>

	<p class="text-center">
		<b > <a href="https://gesfaturacao.pt" class="options-link" target="_blank">GESFaturação</a>desenvolvido por<a href="https://www.ftkode.com" class="options-link" target="_blank">FTKode Software</a>© <?php echo date("Y"); ?> | Todos os direitos reservados. </b>
	</p>
</body>

<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<!-- <script src="js/sco.message.js"></script> -->
<script src="/js/vendors/sco.message/sco.message.js"></script>

<script src="/js/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/js/vendors/bootstrap-select/defaults-pt_BR.min.js"></script>

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

	function getCookie(cname) {
		let name = cname + "=";

		if(name == 'vkeyboard=') {
			if (getCookie('vkeyboard_login') == 'true') {
				return 'true'
			}else{
				return 'false'
			}
		}

		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for (let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) === ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) === 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	$(document).ajaxStart(function() {
		$(".fullscreen").show();
	});

	$(document).ajaxComplete(function() {
		if ($.active == 1) {
			$(".fullscreen").fadeOut();
		}
	});

	$(document).ready(function(e) {
		let vkeyboardLogin = getCookie('vkeyboard_login')
		keyboardActive = vkeyboardLogin == '' || vkeyboardLogin == 'false'   ? false : true
		if(keyboardActive){
			$('#keyboard_login').html('<i class="fa fa-keyboard-o"></i> Desativar Teclado Virtual')
		}else{
			$('#keyboard_login').html('<i class="fa fa-keyboard-o"></i> Ativar Teclado Virtual')
		}
		$(".fullscreen").fadeOut();

		$('#username,#password').mlKeyboard({layout: 'pt_PT',active_shift: false});

		let closeKeyboardBtn = '<div><div class="keyboard-corner">' +
			'<div class="circCont">' +
			'<button onclick="closeKeyboard()" class="circle" data-animation="simpleRotate" data-remove="200"></button></div></div>'

		$('#mlkeyboard ul').append(closeKeyboardBtn);

		//show success reset email sended msg
		let reset_email_send = getParameterByName('reset_email_send');
		if(Number(reset_email_send) == 1) {
			setTimeout(() => {
				$.scojs_message("Email de recuperação de password enviado com sucesso.", $.scojs_message.TYPE_OK);
			}, 500);
		}
	});

	//get vars
	function getParameterByName(name, url) {
		if (!url)
			url = window.location.href;
		url = url.toLowerCase();
		// This is just to avoid case sensitiveness
		name = name.replace(/[\[\]]/g, "\\$&").toLowerCase();
		// This is just to avoid case sensitiveness for query parameter name
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"), results = regex.exec(url);
		if (!results)
			return null;
		if (!results[2])
			return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	//Form Validation Rules
	$("#form-login").validate({
		rules : {
			username : {
				required : true
			},
			password : {
				required : true
			}
		},
		messages : {
			username : {
				required : "Username é obrigatório"
			},
			password : {
				required : "Password é obrigatório"
			}
		}
	});

	//Form submit
	$("#form-login").submit(function(e) {
		e.preventDefault();

		var invalid = "Username e Password são obrigatórios.";
		var wrong = "Dados de acesso incorrectos.";
		var error = " Ocorreu um erro ao processar o pedido."
		var valid = $("#form-login").valid();

		if (!valid) {
			$.scojs_message(invalid, $.scojs_message.TYPE_ERROR);
			return;
		}
		$.ajax({
			type : "POST",
			url : "server/login.php",
			dataType : "json",
			data : {
				username : $("#username").val(),
				password : $("#password").val(),
			}
		}).done(function(resposta) {
			if (resposta.errors) {
				if(resposta.invalid_edition) {
					$.scojs_message(""+resposta.message, $.scojs_message.TYPE_ERROR);
				} else if (resposta.type) {
					switch (resposta.type) {
						case 1:
							$.scojs_message("[FTGP000] Preencha todos os campos!", $.scojs_message.TYPE_ERROR);
							break;
						case 2:
							$.scojs_message("[FTGP000] Não foi possível processar os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
							break;
						case 3:
							$.scojs_message("Nome de utilizador ou palavra-passe incorretos!", $.scojs_message.TYPE_ERROR);
							break;
						case 4:
							$.scojs_message("Nome de utilizador ou palavra-passe incorretos!", $.scojs_message.TYPE_ERROR);
							break;
						case 10:
							$.scojs_message("A sua licença expirou! <br>Para continuar necessita de renovar a sua licença.", $.scojs_message.TYPE_ERROR);
							break;
						case 11:
							$.scojs_message("A sua licença está desativada! <br>Contacte o administrador.", $.scojs_message.TYPE_ERROR);
							break;
						default:
							$.scojs_message("[FTGP000] Não foi possível processar os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
							break;
					}
				} else{
					$.scojs_message(resposta.message + resposta.type + error, $.scojs_message.TYPE_ERROR);
				}
			} else {
				window.location.href = 'gesfaturacao';
			}
		});
		return false;
	});
</script>
</html>