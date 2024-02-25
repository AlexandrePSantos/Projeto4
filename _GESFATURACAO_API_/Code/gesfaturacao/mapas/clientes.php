<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';
?>
<html>
	<title>Mapa de Clientes | GESFaturação</title>
	<head>
		<?php include('../base/css.php') ?>
		<!-- ADDED CSS -->
		<link rel="stylesheet" href="/js/vendors/bootstrap-select/bootstrap-select.min.css">
		<link rel="stylesheet" href="/js/vendors/bootstrap-datepicker/datepicker3.css">
		<!-- //ADDED CSS -->
		<style type="text/css">
			.label { font-size: 12px; }
			tfoot>tr>th { border: 0px !important; border-top: 2px solid #888 !important; }
		</style>
	</head>
	<body>
		<div class="container">
			<?php include '../menu.php'; ?>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-heading">
						<div class="pull-right" >
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li>
								Mapa de Clientes
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<form id="form_new" class="form-validate">

									<!--<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Código Cliente (Apenas Numérico)<span class="require"></span></label>
												<div class="row">
													<div class="col-sm-5">
														<div class="form-group">
															<input type="number" class="form-control" name="filter_codigo_min" id="filter_codigo_min" placeholder="0">
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group"><span>até</span></div>
													</div>
													<div class="col-sm-5">
														<div class="form-group">
															<input type="number" class="form-control" name="filter_codigo_max" id="filter_codigo_max" placeholder="999999">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Nome<span class="require"></span></label>
												<div class="form-group">
													<input type="text" class="form-control" name="filter_nome" id="filter_nome" placeholder="Termo de Pesquisa">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Endereço, Código Postal ou Localidade<span class="require"></span></label>
												<div class="form-group">
													<input type="text" class="form-control" name="filter_morada" id="filter_morada" placeholder="Termo de Pesquisa">
												</div>
											</div>
										</div>
									</div>-->

									<div class="form-footer">
										<!--<div class="mtxl text-center">
											<button class="btn btn-red btn-flat submit_button" type="submit" id="submitFormBtn">
												<i class="fa fa-file-pdf-o"></i> Gerar Mapa de Clientes
											</button>
										</div>
										<div class="col-sm-6 mtxl ">
											<button class="btn btn-green btn-flat submit_button" type="button" id="exportaExcel" onclick="exportarExcel()">
												<i class="fa fa-file-excel-o"></i> Exportar Excel Detalhado
											</button>
										</div>-->
										<div class="col-sm-6 mtxl text-right">
											<button class="btn btn-red btn-flat submit_button" type="submit" id="submitFormBtn">
												<i class="fa fa-file-pdf-o"></i> Gerar Mapa de Clientes
											</button>
										</div>
										<div class="col-sm-6 mtxl ">
											<button class="btn btn-green btn-flat submit_button" type="button" id="exportaExcel" onclick="exportarExcel()">
												<i class="fa fa-file-excel-o"></i> Exportar Excel Detalhado
											</button>
										</div>
									</div>
								</form>
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

		<!-- //ADDED SCRIPTS -->

		<script>
			$(".navbar-nav li.mapas").addClass("active");
			$(".navbar-nav li.mapas li.clientes_mapas").addClass("active");
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
				$(".moneyBig").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's',
					mDec : 3
				});
				$(".moneyCountry").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' ',
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
				//init elements
				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '%',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
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
				$(".moneyBig").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's',
					mDec : 3
				});
				$(".moneyCountry").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' ',
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
				//init elements
				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '%',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});

				// fill_selects
				// fill_clientes();

				//datepicker init
				/*$('.datepicker').datepicker({
					autoclose : true,
					todayHighlight : true,
					toggleActive : true,
					format : 'dd/mm/yyyy',
					language : 'pt'
				});
				var today = new Date();
				var firstDay =  new Date( today.getFullYear(), today.getMonth() - 3, 1 );
				var lastDay =  new Date( today.getFullYear(), today.getMonth(), 1 );
				lastDay.setDate(lastDay.getDate() - 1);
				$('.firstday').datepicker().datepicker("setDate", firstDay);
				$('.lastday').datepicker().datepicker("setDate", lastDay);

				$( ".datepicker" ).datepicker("refresh");*/

			});

			//-----------------------------------------------------------
			//						PROCESS FORM
			//-----------------------------------------------------------
			/* Custom validators numbers bigger than. */
			/*$.validator.addMethod("checkRangeCodigo", function (value, element) {
				var result;

				var dt_min = $('#filter_codigo_min').val();
				var dt_max = $('#filter_codigo_max').val();

				//check dates
				if(dt_min == "" || dt_max == "") return true;

				if ( parseInt(dt_min) > parseInt(dt_max) ) {
					result = false;
				} else {
					result = true;
				}

				return result;
			}, "Indique um intervalo de códigos válido.");

			val_form_new = $("#form_new").validate({
				ignore : "",
				rules : {
					filter_codigo_max : {
						checkRangeCodigo : true,
					},
				},
				messages : {
				},
				highlight : function(element, errorClass, validClass) {
					$(element).addClass(errorClass).removeClass(validClass);
				},
				unhighlight : function(element, errorClass, validClass) {
					$(element).removeClass(errorClass).addClass(validClass);
				},
				errorPlacement : function(error, element) {
					if (element.hasClass('selectpicker') || element.hasClass('datepicker') || element.hasClass('timepicker-default')) {
						if (element.parent().hasClass("input-group"))
							error.insertAfter(element.parent());
						else
							error.insertAfter(element.next("div"));
					} else {
						error.insertAfter(element);
					}
				}
			});*/

			//FORM SUBMIT ---------------------------
			$("#form_new").submit(function(e) {
				e.preventDefault();

				var valid = $("#form_new").valid();
				if (valid == false) {
					$.scojs_message("Preencha todos os campos", $.scojs_message.TYPE_ERROR);
				} else {
					window.open("/gesfaturacao/server/imprimir_pdf/exportar_clientes");
				}
				return false;
			});

			function exportarExcel(){
				var valid = $("#form_new").valid();

				if (valid == false) {
					$.scojs_message("Preencha todos os campos", $.scojs_message.TYPE_ERROR);
				} else {
					window.open( "/gesfaturacao/server/exportacao/clientes");
				}
			}

	</script>
	</body>
</html>
