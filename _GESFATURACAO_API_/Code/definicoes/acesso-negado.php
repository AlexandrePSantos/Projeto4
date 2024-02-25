<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
?>
<html>
	<title>Acesso Negado | GESFaturação</title>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">
		<link rel="stylesheet" href="/css/font-awesome.min.css">

		<link type="text/css" rel="stylesheet" href="/js/vendors/sco.message/sco.message.css">

		<link type="text/css" rel="stylesheet" href="/css/style-responsive.css">
		<link type="text/css" rel="stylesheet" href="/css/orange-blue.css" >
		<link rel="stylesheet"  type="text/css" href="/css/gesautarquia.css">
		<link rel="stylesheet"  type="text/css" href="/css/gestoponimia.css">

		<script src="/js/jquery-1.11.3.min.js"></script>
		<script src="/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>

		<script src="/js/vendors/jquery-validate/jquery.validate.min.js"></script>
		
		<script src="/js/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="/js/vendors/bootstrap-select/defaults-pt_BR.min.js"></script>
		<script src="/js/vendors/sco.message/sco.message.js"></script>
	</head>
	<body>
		<div class="container">
			<?php include 'menu.php'; ?>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-heading">
						Acesso Negado
					</div>
					<div class="panel-body">
						<?php
							echo '<h4 class="ptxl text-center">O seu perfil de permissões não lhe permite efecutar a operação pretendida :<b> ' . $_GET['redirectfrom'] . '</b> <p class="ptxxl text-center"><a class="btn btn-blue" href="' . $_GET['redirectto'] . '">Clique aqui para voltar</a></p></h4>';
							echo '<script>$(".fullscreen").fadeOut();
								$.scojs_message("O seu perfil de permissões não lhe permite efecutar a operação pretendida : ' . $_GET['redirectfrom'] . '", $.scojs_message.TYPE_ERROR);
								$.extend($.scojs_message, {
								options : {
								delay : 6000
								}
								});
								</script>
							';
						?>
					</div>
				</div>
			</div>
		</div>
	</body>

	<?php include 'footer.php'; ?>
	<script>
		var val_form_new;
		
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