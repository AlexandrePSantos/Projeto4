<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

//init db
updateCurrencyTable();

?>
<html>
	<title>Início | GESFaturação</title>
	<head>
		<?php include('base/css.php')
		?>
		<!-- ADDED CSS -->
		<link rel="stylesheet" href="/js/vendors/bootstrap-select/bootstrap-select.min.css">
		<link rel="stylesheet" href="/js/vendors/bootstrap-datepicker/datepicker3.css">
		<link rel="stylesheet" href="/js/vendors/bootstrap-toggle/bootstrap-toggle.min.css">
		<style type="text/css">
			/* Fix Charts Tooltip Flickering on hover*/
			svg > g > g:last-child { pointer-events: none }
			#tableFaturacaoWrapper .pam { padding-left: 5px !important; padding-right: 5px !important; }
			#tableFaturacaoWrapper .colpaddingspecial { padding-left: 10px !important; padding-right: 10px !important; }
			#tableFaturacaoWrapper .h4special { font-size: 17px !important; }
			.historyFilterWrapper .select2-container, .historyFilterWrapper.select2-container--default { display: inline-block; width: 50% !important; /*margin-left: 5% !important;*/ }
			/*.historyFilterWrapper .historyFilterCls { display: inline-block; width: 50% !important;  }*/
			.historyFilterWrapper .historyFilterBtn { display: inline-block; width: 40% !important; max-width: 40% !important; }
			.historyFilterWrapper { padding-left: 0; }
			.seriesFilterWrapper { display: flex; justify-content: end; padding-right: 0px; }
		</style>
		<!-- //ADDED CSS -->
	</head>
	<body>
		<div class="container">
			<?php include 'menu.php'; ?>

			<!-- Resume: Expired Invoices -->
			<div id="modal-resumo-vencidas-massive" role="dialog" aria-labelledby="modal-header-primary-label" data-backdrop="static" data-keyboard="false" aria-hidden="true" class="modal fade">
				<div class="modal-dialog modal-wide-width">
					<div class="modal-content">
						<div class="modal-header modal-header-orange">
							<button type="button" data-dismiss="modal" aria-hidden="true" class="close">
								&times;
							</button>
							<h4 id="modal-header-primary-label" class="modal-title"><i class="fa fa-file-text-o"></i>&nbsp;Resumo de Envio de Documentos</h4>
						</div>
						<div class="modal-body" id="resumeMassiveWrapper">
						</div>
						<div class="modal-footer">
							<button type="button" data-dismiss="modal" class="btn btn-default">
								Fechar
							</button>

						</div>
					</div>
				</div>
			</div>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="text-center">
									<h4><i class="fa fa-eur"></i>&nbsp;Visão Global</h4>
								</div>
								<div class="row">
									<div class="col-xs-12" id="tableFaturacaoWrapper"></div>
								</div>
							</div>
						</div>

						<div class="row mtm mbm">
							<div class="col-xs-12 col-sm-4 col-md-4"></div>
							<div class="col-xs-12 col-sm-4 col-md-4 historyFilterWrapper">
								<!-- <label>Histórico</label> -->
								<select class="form-control select2 show-tick historyFilterCls" data-live-search="true"  data-header="Selecionar Ano" id="history_year" name="history_year">
									<option value="" data-hidden="true">Sélectionnez</option>
									<?php
									$getYearsListOpt = getYearsHistoryOtps();
									foreach ($getYearsListOpt as $optItem) {
										echo $optItem;
									}
									?>
								</select>
								<button type="button" id="searchBtn" class="historyFilterBtn btn btn-orange btn-outlined btn-square btn-block" onclick="callHistoryChange()"><i class="fa fa-bar-chart"></i> Filtrar</button>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<input type="checkbox" id="toggle-historyGraph" checked data-toggle="toggle" data-on="Situação Mensal" data-off="Acumulado" data-onstyle="orange" data-offstyle="yellow">
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<div class="text-center" id="graphicWrapperTitle5"></div>
								<div class="row">
									<div class="col-xs-12" id="graphicWrapper5"></div>
								</div>
								<div class="row">
									<div class="col-xs-12" id="graphicWrapper5Totals">
										<div class="row">
											<div class=" text-center col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
												<label>Total Faturado:</label>
												<p id="valor-ano-vendas" class="money" placeholder="0,00€">0</p>
											</div>
											<div class=" text-center col-xs-12 col-sm-6 col-md-3">
												<label>Total IVA:</label>
												<p id="valor-iva-ano-vendas" class="money" placeholder="0,00€">0</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<hr>

						<div class="row mtxl">
							<div class="col-xs-12 col-md-12">
								<div class="text-center" id="graphicWrapperTitle6"></div>
								<div class="row">
									<div class="col-xs-12" id="graphicWrapper6"></div>
								</div>
								<div class="row">
									<div class="col-xs-12" id="graphicWrapper6Totals">
										<div class="row">
											<div class=" text-center col-xs-12 col-sm-6 col-md-3 col-md-offset-3">
												<label>Total Faturado:</label>
												<p id="valor-ano-compras" class="money" placeholder="0,00€">0</p>
											</div>
											<div class=" text-center col-xs-12 col-sm-6 col-md-3">
												<label>Total IVA:</label>
												<p id="valor-iva-ano-compras" class="money" placeholder="0,00€">0</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row mtxl">
							<div class="col-xs-12 col-md-6">
								<div class="text-center" id="graphicWrapperTitle8"></div>
								<div class="row">
									<div class="col-xs-12" id="graphicWrapper8"></div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="text-center" id="graphicWrapperTitle9"></div>
								<div class="row">
									<div class="col-xs-12" id="graphicWrapper9"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include 'footer.php'; ?>
		<?php include('base/scripts.php'); ?>

		<!-- ADDED SCRIPTS -->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<script src="/js/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="/js/vendors/bootstrap-select/defaults-pt_BR.min.js"></script>

		<script src="/js/vendors/DataTables/media/js/jquery.dataTables.js"></script>
		<script src="/js/vendors/DataTables/media/js/dataTables.bootstrap.js"></script>

		<script src="/js/vendors/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="/js/vendors/bootstrap-datepicker/bootstrap-datepicker.pt.js"></script>
		<script src="/js/vendors/jquery-maskedinput/jquery-maskedinput.js"></script>
		<script src="/js/fnReload.js"></script>

		<script src="/js/jquery.showmore.js"></script>
		<script src="/js/autoNumeric.js"></script>
		<script src="/js/vendors/bootstrap-toggle/bootstrap-toggle.min.js"></script>

		<?php include ('index_scripts.php'); ?>
		<!-- //ADDED SCRIPTS -->

		<script>
			//load libraries
			google.charts.load('current', {
				packages : ['corechart','table']
			});

			$(".navbar-nav li.home").addClass("active");

			var typeGraphToggle = true;
			var val_form_new;

			/* LOADING ------------------------ */
			$(document).ready(function() {
				$(".fullscreen").fadeOut();
			});

			$(document).ajaxStart(function() {
				// $(".fullscreen").show();
			});

			$(document).ajaxComplete(function() {
				if ($.active == 1) {
					$(".fullscreen").fadeOut();
				}
				init_iCheck();

				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's',
					// vMin:'0'
				});
				$(".money-tmp").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's',
					// vMin:'0'
				});
			});

			$(document).ready(function() {
				$(".fullscreen").fadeOut();
				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's',
					// vMin:'0'
				});

				$("select#history_year").select2({ escapeMarkup: function(m) { return m; }, language: "pt",	placeholder: "Selecionar Opção", });
				$("select#history_serie").select2({
					escapeMarkup: function(m) {
						return m;
					},
					language: "pt",
					placeholder: "Selecionar Serie",
				});

				init_iCheck();
			});
			/* //LOADING ------------------------ */

			/* Listner History Year */
			$('#toggle-historyGraph').change(function() {
				console.log('here changed');
				typeGraphToggle = $(this).prop('checked');
				// console.log(typeGraphToggle, 'toggle state');
				callHistoryChange()
			});
			/*$("select#history_year").on('change', function(){
				$(".fullscreen").show();

				// $('#tableFaturacaoWrapper').empty();
				// setTimeout( fill_faturacao , 10);

				setTimeout( initFaturacaoAnual, 100);
				setTimeout( initComprasAnual, 500);
			});*/

			/* func History Year */
			function callHistoryChange(){
				$(".fullscreen").show();

				/* total boxes */
				// $('#tableFaturacaoWrapper').empty();
				setTimeout( fill_faturacao_ano, 10);

				/* graphs */
				setTimeout( initFaturacaoAnual, 100);
				setTimeout( initComprasAnual, 500);
			}

			function fill_faturacao_ano(){
				/* clean values */
				$('#valor-ano-vendas').autoNumeric('set', 0);
				$('#valor-iva-ano-vendas').autoNumeric('set', 0);

				$('#valor-ano-compras').autoNumeric('set', 0);
				$('#valor-iva-ano-compras').autoNumeric('set', 0);

				$.ajax({
					type : 'POST',
					url : '/gesfaturacao/server/graficos/faturacao_totais_ano.php',
					global : false,
					dataType : 'json',
					async : true,
					data : {
						filterSerie: $("#history_serie").val(),
						filterYear : $("#history_year").val(),
						filterTypeGraph : typeGraphToggle
					},
					success : function(resposta) {
						var resp = resposta;
						if (resposta)
							if (!resposta.errors) {
								$('#valor-ano-vendas').autoNumeric('set', resposta['AnoTotalVendas']);
								$('#valor-iva-ano-vendas').autoNumeric('set', resposta['IvaTotalVendas']);

								$('#valor-ano-compras').autoNumeric('set', resposta['AnoTotalCompras']);
								$('#valor-iva-ano-compras').autoNumeric('set', resposta['IvaTotalCompras']);
							}
					},
					complete : function(){
					}
				});
			}
			/* -------------------- */

			/* ---------- Page Scripts ---------- */
			$(document).ready(function() {
				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's',
					// vMin:'0'
				});

				// init_iCheck();

				//call graph
				setTimeout( initFaturacaoAnual, 500);
				setTimeout( initComprasAnual, 1000);
				//call tables
				setTimeout( fill_faturacao , 10);
				setTimeout( fill_faturacao_ano , 10);
			});

			function initFaturacaoAnual(){ callGraphData(5); }
			function initComprasAnual(){ callGraphData(6); }
			/* ---------------------------------- */

			//Call Graph Data
			function callGraphData(idSelected){
				//vars
				var ID = idSelected;

				//choose graph
				switch(ID) {
					case 5:
						google.charts.setOnLoadCallback( getGraphFaturacaoFat );
						break;
					case 6:
						google.charts.setOnLoadCallback( getGraphFaturacaoComp );
						break;
					case 7:
						google.charts.setOnLoadCallback( getGraphFaturacaoImp );
						break;
					case 8:
						google.charts.setOnLoadCallback( getGraphFaturacaoCentCusto );
						break;
					case 9:
						google.charts.setOnLoadCallback( getGraphFaturacaoCentCustoComp );
						break;

					default:
						break;
				}
				//disable loading
				$(".fullscreen").fadeOut();

				//finish form
				return false;
			}
		</script>
	</body>
</html>
