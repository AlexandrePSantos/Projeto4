<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';
?>
<html>
	<title>Clientes | GESFaturação</title>
	<head>
		<?php include('../base/css.php') ?>
		<!-- ADDED CSS -->
		<link rel="stylesheet" href="/js/vendors/bootstrap-select/bootstrap-select.min.css">
		<link rel="stylesheet" href="/js/vendors/bootstrap-datepicker/datepicker3.css">
		<!-- //ADDED CSS -->
	</head>
	<body>
		<div class="container">
			<?php include '../menu.php'; ?>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-heading">
						<div class="pull-right" >
							<a href="novo.php" class="btn btn-yellow btn-outlined btn-square"><i class="fa fa-plus"></i>&nbsp;&nbsp;Novo Cliente</a>
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li>
								Todos os Clientes
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row ptm">
							<div class="col-md-12 ">
								<table class="table table-bordered table-striped" id="table_id" >
									<thead>
										<tr>
											<th style="width: 60px;">Cód.</th>
											<th style="width: 60px;">Cód. Int.</th>
											<th>Nome</th>
											<th style="width: 100px;">NIF</th>
											<th style="width: 100px;">Contacto</th>
											<th style="width: 220px;">Email</th>
											<th>Grupo</th>
											<th style="width: 200px;">Cód.Postal/Localidade</th>
											<th style="width: 70px;">Conta</th>
											<th style="width: 80px;">Opções</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include '../footer.php';	?>
		<?php include('../base/scripts.php') ?>

		<!-- ADDED SCRIPTS -->
		<script src="/js/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="/js/vendors/bootstrap-select/defaults-pt_BR.min.js"></script>

		<script src="/js/vendors/DataTables/media/js/jquery.dataTables.js"></script>
		<script src="/js/vendors/DataTables/media/js/dataTables.bootstrap.js"></script>

		<script src="/js/vendors/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="/js/vendors/bootstrap-datepicker/bootstrap-datepicker.pt.js"></script>
		<script src="/js/vendors/jquery-maskedinput/jquery-maskedinput.js"></script>
		<script src="/js/fnReload.js"></script>

		<script src="/js/autoNumeric.js"></script>
		<script src="/js/jquery.showmore.js"></script>

		<?php include('index_scripts.php');  ?>
		<!-- //ADDED SCRIPTS -->

		<script>
			$(".navbar-nav li.clientes").addClass("active");
			$(".navbar-nav li.clientes li.clientes_clientes").addClass("active");
		</script>
		<script type="text/javascript">

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
