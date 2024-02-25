<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';
?>
<html>
	<title>Clientes: Detalhes do Cliente | GESFaturação</title>
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
							<a class="text-red only-ic" href="../clientes"><i class="fa fa-times"></i></a>
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li>
								<a href="../clientes">Clientes</a>
							</li>
							<li class="active">
								Detalhes do Cliente
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-body">
									<div id="form_div">
										<h5 class="form-header">
											<legend class="form-legend">
												Dados do Cliente
											</legend>
										</h5>
										<div class="section-form">
											<div class="row">
												<div class="col-sm-4 col-md-2">
													<div class="form-group">
														<label class="control-label">Código</label>
														<span id="codigo_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-4 col-md-2">
													<div class="form-group">
														<label class="control-label">Cód. Interno</label>
														<span id="codigo_interno_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-12 col-md-6">
													<div class="form-group">
														<label class="control-label">Nome Completo</label>
														<span id="nome_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-2">
													<div class="form-group">
														<label class="control-label">Nif</label>
														<span id="nif_cliente" style="display: block"></span>
													</div>
												</div>
											</div>

											<div class="row mtm">
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Endereço</label>
														<span id="endereco_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Código Postal</label>
														<span id="codigopostal_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Localidade</label>
														<span id="localidade_cliente" style="display: block"></span>
													</div>
												</div>
											</div>
											<div class="row mtm">
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Distrito</label>
														<span id="regiao_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Cidade</label>
														<span id="cidade_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">País</label>
														<span id="pais_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Autorização Fitofarmacêuticos</label>
														<span id="fitofarmaceuticos_cliente" style="display: block"></span>
													</div>
												</div>
											</div>

											<div class="row mtm">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="control-label">Observações</label>
														<span id="observacoes_cliente" style="display: block"></span>
													</div>
												</div>
											</div>

											<!-- <div class="row mtm">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="control-label">Grupo de Clientes</label>
														<span id="grupo_cliente" style="display: block"></span>
													</div>
												</div>
											</div> -->
										</div>

										<h5 class="form-header">
											<legend class="form-legend">
												Contactos
											</legend>
										</h5>
										<div class="section-form">
											<div class="row">
												<div class="col-sm-6 col-md-3">
													<div class="form-group">
														<label class="control-label">Email</label>
														<span id="email_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-3">
													<div class="form-group">
														<label class="control-label">Website</label>
														<span id="website_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-2">
													<div class="form-group">
														<label class="control-label">Telemóvel</label>
														<span id="tlm_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-2">
													<div class="form-group">
														<label class="control-label">Telefone</label>
														<span id="tlf_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-2">
													<div class="form-group">
														<label class="control-label">Fax</label>
														<span id="fax_cliente" style="display: block"></span>
													</div>
												</div>
											</div>
										</div>

										<h5 class="form-header">
											<legend class="form-legend">
												Contacto do Representante
											</legend>
										</h5>
										<div class="section-form">
											<div class="row">
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Nome</label>
														<span id="preferencial_nome_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Email</label>
														<span id="preferencial_email_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-2">
													<div class="form-group">
														<label class="control-label">Telemóvel</label>
														<span id="preferencial_tlm_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-2">
													<div class="form-group">
														<label class="control-label">Telefone</label>
														<span id="preferencial_tlf_cliente" style="display: block"></span>
													</div>
												</div>
											</div>
										</div>

										<h5 class="form-header">
											<legend class="form-legend">
												Conta e Faturação
											</legend>
										</h5>
										<div class="section-form">
											<div class="row">
												<div class="col-sm-6 col-md-4">
													<div class="form-group">
														<label class="control-label">Conta Corrente</label>
														<span id="contacorrente_cliente" style="display: block"></span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6 col-md-4">
													<div class="row">
														<div class="col-xs-4">
															<div class="form-group">
																<label class="control-label">Isento de IVA?</label>
																<span id="isento_iva" style="display: block"></span>
															</div>
														</div>
														<div class="col-xs-8">
															<div class="form-group">
																<label class="control-label">Motivo de Isenção (IVA)</label>
																<span id="motivo_isencao_iva" style="display: block"></span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-6 col-md-3">
													<div class="form-group">
														<label class="control-label">Método Pagamento</label>
														<span id="pagamento_cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-3">
													<div class="form-group">
														<label class="control-label">Condições de Pagamento</label>
														<span id="vencimento_Cliente" style="display: block"></span>
													</div>
												</div>
												<div class="col-sm-6 col-md-2">
													<div class="form-group">
														<label class="control-label">Desconto (%)</label>
														<span id="desconto_cliente" class="percentage" style="display: block"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-footer">
									<div class="mtxl pull-right" id="btns-wrapper">
									</div>
								</div>
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

		<?php include('detalhes_scripts.php');  ?>
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
				//init elements
				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});

			});

			$(document).ready(function() {
				//init elements
				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});


				var idCliente = getParameterByName('cliente');
				//fill infos
				fill_cliente(idCliente);
			});

			//get vars
			function getParameterByName(name, url) {
				if (!url)
					url = window.location.href;
				url = url.toLowerCase();
				// This is just to avoid case sensitiveness
				name = name.replace(/[\[\]]/g, "\\$&").toLowerCase();
				// This is just to avoid case sensitiveness for query parameter name
				var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"), results = regex.exec(url);
				if (!results)
					return null;
				if (!results[2])
					return '';
				return decodeURIComponent(results[2].replace(/\+/g, " "));
			}
		</script>
	</body>
</html>
