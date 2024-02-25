<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
?>
<html>
	<title>Acesso Negado | GESFaturação </title>
	<head>
		<?php include('base/css.php') ?>
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
							echo '<h4 class="ptxl text-center">O seu plano não permite aceder a esta funcionalidade! <p>Para obter esta e outras funcionalidades, consulte <a href="https://gesfaturacao.pt/planos.php" target="_blank"><b>aqui</b></a> os nossos planos e escolha o mais adequado ao seu negócio. </p>
							<p class="ptxxl text-center"><a class="btn btn-yellow" href="' . $_GET['redirectto'] . '">Clique aqui para voltar</a></p></h4>';
						?>
					</div>
				</div>
			</div>
		</div>

		<?php include 'footer.php';	?>
		<?php include('base/scripts.php') ?>

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
	</body>
</html>