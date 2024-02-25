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
			<?php include('base/scripts.php') ?>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-heading">
						Acesso Negado
					</div>
					<div class="panel-body">
						<?php
							if($_GET['missingpermissions']){
								echo '<h4 class="ptxl text-center">Permissões em  falta:</h4>';
								echo '<h4 style="margin-top: 10px !important;" class="text-center"><b>['.$_GET['missingpermissions'].']</b></h4>';
							}

							echo '<h4 class="ptxl text-center">O seu perfil de permissões não lhe permite efecutar a operação pretendida :<b> ' . $_GET['redirectfrom'] . '</b> <p class="ptxxl text-center"><a class="btn btn-yellow" href="' . $_GET['redirectto'] . '">Clique aqui para voltar</a></p></h4>';
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