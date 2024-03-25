<html lang="pt">
	<head>
		<title>GESFaturação | Software de Faturação Online</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex"/>

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">
		<link type="text/css" rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="css/sco.message.css">
		<link type="text/css" rel="stylesheet" href="css/style-responsive.css">
		<link type="text/css" rel="stylesheet" href="css/orange-blue.css" >
		<link type="text/css" rel="stylesheet" href="css/gesautarquia.css" >
		<link type="text/css" rel="stylesheet" href="/css/gesfaturacao.css" >
	</head>

	<body id="signin-page">
		<div align="center" class="fullscreen">
			<i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw " style="margin-top: 20%"></i>
		</div>
		<div class="logo-div" align="center">
			<a href="/"><img src="/img/ges-faturacao.png" style="max-width: 250px;" alt="GESFaturação" /></a>
		</div>

		<div class="page-form">
			<form id="form_recuperar">
				<div class="header-content">
					<h4 class="text-center text-white"><b>Recuperar Password</b></h4>
				</div>
				<div class="body-content">
					<div class="paxl" align="center">
						<?php
							$callback_image = "/uploads/faturacao/logo_default.png";
							$image = $callback_image;
							echo '<img class="img-responsive" src="'.$image.'" alt="GESFaturação" style="max-height: 100px; margin-top:0px;"/>';
						?>
					</div>
					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-user"></i>
							<input type="text" placeholder="Username" name="username" id="username" class="form-control required">
						</div>
					</div>
					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-envelope"></i>
							<input type="text" placeholder="Email" name="email" id="email" class="form-control required email">
						</div>
					</div>
					<div class="text-center col-md-12 ptl pbl">
						<button type="submit" class="btn btn-grey submit_button" >
							<i class="fa fa-arrow-right"></i> Recuperar
						</button>
					</div>
					<div class="text-center col-md-12 pbl">
						<a class="options-link" onclick="window.history.back();"><i class="fa fa-reply"></i> Voltar</a>
					</div>
					<div class="clearfix"></div>
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

	<script>
		$(document).ajaxStart(function() {
			$(".fullscreen").show();
		});

		$(document).ajaxComplete(function() {
			$(".fullscreen").fadeOut();
		});

		$(document).ready(function() {
			$(".fullscreen").fadeOut();
		});

		$("#form_recuperar").submit(function(e) {
			e.preventDefault();

			var invalid = "Username e Email são obrigatórios.";
			var wrong = "Dados de acesso incorretos.";
			var error = " Ocorreu um erro ao processar o pedido."
			var valid = $("#form_recuperar").valid();
			var flagSended = "";

			if (!valid) {
				$.scojs_message(invalid, $.scojs_message.TYPE_ERROR);
				return;
			}

			$.ajax({
				type : "POST",
				url : "server/recuperar_password.php",
				dataType : "json",
				data : {
					username : $("#username").val(),
					email : $("#email").val()
				}
			}).done(function(resposta) {
				if (resposta.errors) {
					if(resposta.invalid_edition) {
						$.scojs_message(""+resposta.message, $.scojs_message.TYPE_ERROR);
					} else if (resposta.invalid_edition) {
						$.scojs_message(resposta.message, $.scojs_message.TYPE_ERROR);
					} else if (resposta.type == 4) {
						$.scojs_message(wrong, $.scojs_message.TYPE_ERROR);
					} else {
						$.scojs_message(resposta.message + resposta.type + error, $.scojs_message.TYPE_ERROR);
					}
				} else {
					flagSended = "?reset_email_send=1";
					window.location.href = "/index"+flagSended;
				}
			});
			return false;
		});

		$("#form_recuperar").validate({
			rules : {
				username : {
					required : true
				},
				email : {
					required : true,
					email: true
				}
			},
			messages : {
				username : {
					required : "Username é obrigatório"
				},
				email : {
					required : "Email é obrigatório",
					email : "Email inválido",
				}
			}
		});
	</script>
</html>