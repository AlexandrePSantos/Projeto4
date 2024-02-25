<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

if(json_encode($_SESSION['user_pos']) == "1" && json_encode($_SESSION['gesfatur_user']) == "0"){
	header("location:/gesfaturacao/pos");
}

?>
<html>
	<title>Painel de Controlo | Definições </title>
	<head>
		<meta charset="utf-8" />
		<link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">
		<link rel="stylesheet" href="/css/font-awesome.min.css">

		<link type="text/css" rel="stylesheet" href="/js/vendors/sco.message/sco.message.css">

		<link type="text/css" rel="stylesheet" href="/css/style-responsive.css">
		<link type="text/css" rel="stylesheet" href="/css/orange-blue.css" >
		<link rel="stylesheet"  type="text/css" href="/css/gesautarquia.css">

		<script src="/js/jquery-1.11.3.min.js"></script>
		<script src="/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>

		<script src="/js/vendors/jquery-validate/jquery.validate.min.js"></script>

		<script src="/js/vendors/sco.message/sco.message.js"></script>
		<style type="text/css">
			.fa2_5x { font-size: 2.5em !important; }
			.modulo-item { width: 100% !important; margin: auto !important; text-align: center !important; padding-right: 0px !important; padding-left: 0px !important; }
		</style>
	</head>
	<body>
		<div class="container">
			<?php include 'menu.php'; ?>

			<script>
				$(".navbar-nav li.home").addClass("active");
			</script>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-heading">
						Painel de Controlo
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3 pts pbs">
								<a class="btn btn-lg btn-block no-padding" href="/definicoes/dados_acesso">
									<div class="paxl modulo-item">
										<i class="fa fa-key fa2_5x" style="margin-bottom: 4px;"></i>
										<br>
										Dados de Acesso
									</div>
								</a>
							</div>
							<div class="col-md-3 pts pbs">
								<a class="btn btn-lg btn-block no-padding" href="/definicoes/formacao">
									<div class="paxl modulo-item">
										<i class="fa fa-youtube-play fa2_5x" style="margin-bottom: 4px;"></i>
										<br>
										Formação
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

	<?php include 'footer.php'; ?>

	<script>
		$(document).ajaxStart(function() {
			$(".fullscreen").show();
		});

		$(document).ajaxComplete(function() {
			if ($.active == 1) {
				$(".fullscreen").fadeOut();
			}
		});

		$(document).ready(function() {
			$(".fullscreen").fadeOut();
		});
	</script>
</html>
