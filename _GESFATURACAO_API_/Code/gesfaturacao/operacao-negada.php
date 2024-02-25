<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
?>
<html>
	<title>Operação Não Permitida | GESFaturação </title>
	<head>
		<?php include('base/css.php') ?>
	</head>
	<body>
		<div class="container">
			<?php include 'menu.php'; ?>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-heading">
						Operação Não Permitida
					</div>
					<div class="panel-body">
						<?php
							echo '<h4 class="ptxl text-center">A operação selecionada <b> ' . $_GET['redirectfrom'] . '</b>  não está disponível!</h4> <p class="ptxxl text-center"><a class="btn btn-yellow" href="' . $_GET['redirectto'] . '">Clique aqui para voltar</a></p>';
							echo '<script>$(".fullscreen").fadeOut();
								$.scojs_message("O seu perfil de permissões não lhe permite efecutar a operação pretendida : ' . $_GET['redirectfrom'] . '", $.scojs_message.TYPE_ERROR);
								$.extend($.scojs_message, {
								options : {
								delay : 6000
								}
								});
								</script>';
						?>
					</div>
				</div>
			</div>
		</div>

		<?php include 'footer.php'; ?>
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