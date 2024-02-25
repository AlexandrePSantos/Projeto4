<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

	/* get number of decimals */
	$nDec = 4;
?>
<html>
	<title>Artigos | GESFaturação</title>
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
							<a href="novo" class="btn btn-yellow btn-outlined btn-square"><i class="fa fa-plus"></i>&nbsp;&nbsp;Novo Artigo</a>
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li class="active">
								Todos os Artigos
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-4 col-xs-6">
								<div class="form-group ">
									<label class="control-label">Categoria</label>
									<select class="form-control select2 show-tick" data-live-search="true" id="categoria_filtro" name="categoria_filtro">
										<option data-hidden="true" value="">Selecione uma opção</option>
									</select>
								</div>
							</div>
							<div class="col-sm-2 col-xs-6">
								<div class="form-group ">
									<label class="control-label">Tipo</label>
									<select class="form-control select2 show-tick" data-live-search="true" id="tipo_filtro" name="tipo_filtro">
										<option value="">Selecionar opção</option>
										<option value="P">Produtos</option>
										<option value="S">Serviços</option>
									</select>
								</div>
							</div>
							<div class="col-sm-2 col-xs-6">
								<div class="form-group ">
									<label class="control-label">IVA</label>
									<select class="form-control select2 show-tick" data-live-search="true" id="iva_filtro" name="iva_filtro">
										<option data-hidden="true" value="">Selecione uma opção</option>
									</select>
								</div>
							</div>

							<div class="col-sm-2 col-xs-6">
								<div class="form-group ">
									<label class="control-label">Stock Minimo</label>
									<input type="text" class="form-control qtd" id="stock_minimo_filtro" name="stock_minimo_filtro" placeholder="..." />
								</div>
							</div>

							<div class="col-sm-2 col-xs-6">
								<div class="form-group ">
									<label class="control-label">Stock Máximo</label>
									<input type="text" class="form-control qtd" id="stock_maximo_filtro" name="stock_maximo_filtro" placeholder="..." />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-yellow" type="button" onclick="pesquisar_detalhe()">
									<i class="fa fa-search"></i> Pesquisar
								</button>
							</div>
						</div>

						<div class="row ptm">
							<div class="col-md-12 ">
								<table class="table table-bordered table-striped" id="table_id" >
									<thead>
										<tr>
											<th style="width: 100px;">Código</th>
											<th>Nome</th>
											<th style="width: 110px;">Categoria</th>
											<th style="width: 60px;">Tipo</th>
											<th style="width: 90px;">Preço PVP</th>
											<th style="width: 50px;">IVA</th>
											<th style="width: 80px;">Stock</th>
											<th style="width: 60px;">Unidade</th>
											<th style="width: 170px;">Opções</th>
											<th>Hidden</th>
											<th>Hidden</th>
											<th>Hidden</th>
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
		<?php include('../modals/stock_artigos.php');  ?>
		<?php include('registos_novo.php');  ?>
		<?php include('modal_recalc_precocusto.php');  ?>
		<?php include('modal_precos_venda.php');  ?>
		<!-- //ADDED SCRIPTS -->

		<script>
			$(".navbar-nav li.artigos").addClass("active");
			$(".navbar-nav li.artigos li.artigos_artigos").addClass("active");
		</script>
		<script type="text/javascript">
			$(document).ajaxStart(function() {
				$(".fullscreen").show();
			});
			$(document).ajaxComplete(function() {
				if ($.active == 1) {
					$(".fullscreen").fadeOut();
				}
				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's'
				});

				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});
				//init elements
				$(".qtd").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '',
					pSign : 's',
					mDec : 3
				});
			});
			$(document).ready(function() {
				$(".fullscreen").fadeOut();

				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's'
				});

				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});
				//init elements
				$(".qtd").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '',
					pSign : 's',
					mDec : 3
				});

				/* INPUT RADIO */
				$('input:radio').removeAttr("checked");
				$(".default_radio").attr("checked", true);
				$('input[type=radio]').iCheck({
					radioClass : 'iradio_square-orange',
					increaseArea : '20%' // optional
				});

				/* INPUT CHECKBOX */
				$('input:checkbox').removeAttr("checked");
				$(".default_checked").attr("checked", true);
				$('input[type=checkbox]').iCheck({
					checkboxClass : 'icheckbox_flat-orange',
					increaseArea : '20%' // optional
				});

				$("#tipo_filtro").selectpicker('refresh');

				fill_impostos();
				fill_categories()
			});

			$(document).ready(function() {
				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's'
				});

				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});
				//init elements
				$(".qtd").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '',
					pSign : 's',
					mDec : 3
				});

				/* INPUT RADIO */
				$('input:radio').removeAttr("checked");
				$(".default_radio").attr("checked", true);
				$('input[type=radio]').iCheck({
					radioClass : 'iradio_square-orange',
					increaseArea : '20%' // optional
				});

				/* INPUT CHECKBOX */
				$('input:checkbox').removeAttr("checked");
				$(".default_checked").attr("checked", true);
				$('input[type=checkbox]').iCheck({
					checkboxClass : 'icheckbox_flat-orange',
					increaseArea : '20%' // optional
				});
			});
		</script>
	</body>
</html>
