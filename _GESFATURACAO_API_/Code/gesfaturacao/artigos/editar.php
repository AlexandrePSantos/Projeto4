<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

	/* define some vars and configs */
	$hideEncomendaAqui = 'hide';
	$hidePOS = 'hide';

	/* get number of decimals */
	$nDec = 4;
?>
<html>
	<title>Editar Artigo | GESFaturação</title>
	<head>
		<?php include('../base/css.php') ?>
		<!-- ADDED CSS -->
		<link rel="stylesheet" href="/js/vendors/bootstrap-select/bootstrap-select.min.css">
		<link rel="stylesheet" href="/js/vendors/bootstrap-datepicker/datepicker3.css">
		<link type="text/css" rel="stylesheet" href="/js/vendors/iCheck/skins/all.css">
		<link href="/js/vendors/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
		<!-- //ADDED CSS -->
		<style type="text/css">
			.special_inptgroup_btn { min-height: 34px !important; padding-left: 10px !important; padding-right: 10px !important; }
		</style>
	</head>
	<body>
		<div class="container">
			<?php include '../menu.php'; ?>

			<div class="page-content">
				<div class="panel panel-white">
					<div class="panel-heading">
						<div class="pull-right" >
							<a class="text-red only-ic" href="../artigos"><i class="fa fa-times"></i></a>
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li>
								<a href="../artigos">Artigos</a>
							</li>
							<li class="active">
								Editar Registo
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row ptm">
							<div class="col-xs-12">
								<form id="form_new" class="form-validate">
									<div class="form-body">
										<div id="form_div">
											<h5 class="form-header">
												<legend class="form-legend">
													Dados do Artigo
												</legend>
											</h5>
											<div class="section-form">
												<div class="row">
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Código<span class="require">*</span></label>
															<input type="text" class="form-control" id="codigo_artigo" name="codigo_artigo" placeholder="0001A..." pattern="[0-9]+" autofocus="true" value="<?php echo getNextID('Codigo','faturacao_artigos'); ?>" />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Nome<span class="require">*</span></label>
															<input type="text" class="form-control" id="nome_artigo" name="nome_artigo" placeholder="Artigo..." />
														</div>
													</div>

													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Categoria</label>
															<select class="form-control selectpicker show-tick" data-live-search="true"  data-header="Selecionar opção" id="categoria_artigo" name="categoria_artigo">
																<option value="" data-hidden="true">Selecionar</option>
															</select>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Tipo<span class="require">*</span></label>
															<select class="form-control selectpicker show-tick" data-live-search="true" data-header="Selecionar opção" id="tipo_artigo" name="tipo_artigo">
																<option value="">Selecionar opção</option>
																<option value="P">Produtos</option>
																<option value="S">Serviços</option>
															</select>
														</div>
													</div>
													<?php if ($_SESSION['id_plano_atual'] !== 1) { ?>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Unidade de medida<span class="require">*</span></label>
																<select class="form-control selectpicker show-tick" data-live-search="true"  data-header="Selecionar opção" id="unidade_artigo" name="unidade_artigo">
																	<option value="" data-hidden="true">Selecionar</option>
																</select>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Qtd. Stock</label>
																<input type="text" class="form-control qtd" id="stock_artigo" name="stock_artigo" placeholder="0,000" />
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Stock Mínimo</label>
																<input type="text" class="form-control qtd" id="stock_minimo" name="stock_minimo" placeholder="0,000" />
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Alerta</label>
																<div class="checkbox">
																	<label>
																		<input type="checkbox" class="iCheck" name="alerta_stock_min" id="alerta_stock_min">
																		Stocks Mínimos ?
																	</label>
																</div>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Nº Série</label>
																<input type="text" class="form-control" id="numeroserie_artigo" name="numeroserie_artigo" placeholder="123456" pattern="[0-9]+" />
															</div>
														</div>
													<?php } else {?>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Unidade de medida<span class="require">*</span></label>
																<select class="form-control selectpicker show-tick" data-live-search="true"  data-header="Selecionar opção" id="unidade_artigo" name="unidade_artigo">
																	<option value="" data-hidden="true">Selecionar</option>
																</select>
															</div>
														</div>
														<div class="hide">
															<div class="form-group">
																<label class="control-label">Qtd. Stock</label>
																<input type="text" class="form-control qtd" id="stock_artigo" name="stock_artigo" placeholder="0,000" />
															</div>
														</div>
														<div class="hide">
															<div class="form-group">
																<label class="control-label">Stock Mínimo</label>
																<input type="text" class="form-control qtd" id="stock_minimo" name="stock_minimo" placeholder="0,000" />
															</div>
														</div>
														<div class="hide">
															<div class="form-group">
																<label class="control-label">Alerta</label>
																<div class="checkbox">
																	<label>
																		<input type="checkbox" class="iCheck" name="alerta_stock_min" id="alerta_stock_min">
																		Stocks Mínimos ?
																	</label>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Nº Série</label>
																<input type="text" class="form-control" id="numeroserie_artigo" name="numeroserie_artigo" placeholder="123456" pattern="[0-9]+" />
															</div>
														</div>
													<?php } ?>
												</div>

												<hr>

												<div class="row mtm">
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Preço PVP<span class="require">*</span></label>
															<input type="text" class="form-control money" id="precoPVP_artigo" name="precoPVP_artigo" placeholder="0,00 €" value="0"/>
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">IVA<span class="require">*</span></label>
															<select class="form-control select2 show-tick" data-live-search="true" data-header="Selecionar opção" id="imposto_artigo" name="imposto_artigo">
																<option value="" data-hidden="true">Selecionar</option>
															</select>
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Preço Unitário</label>
															<input type="text" class="form-control moneyBig" id="preco_artigo" name="preco_artigo" placeholder="0,00 €" value="0" />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Calcular Preço Unit.</label>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="iCheck" name="calcular_margem_unitario_artigo" id="calcular_margem_unitario_artigo">
																	Margem de Lucro ?
																</label>
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label>Margem de Lucro</label>
															<input type="text" class="form-control percentageBig" id="margemlucro_artigo" name="margemlucro_artigo" placeholder="0,00 %" disabled/>
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label>Preço de Custo Inicial</label>
															<input type="text" class="form-control moneyBig" id="precocustoinicial_artigo" name="precocustoinicial_artigo" placeholder="0,00 €" />
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-md-4">
														<div class="form-group">
															<label>Motivo de Isenção<span class="require" id="motivo_obrigatorio"></span></label>
															<select name="motivo_isencao_artigo" id="motivo_isencao_artigo" class="form-control selectpicker show-tick" data-live-search="true"  data-header="Selecionar opção" disabled></select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Tipo de Retenção</label>
															<select class="form-control selectpicker show-tick" data-live-search="true"  data-header="Selecionar opção" id="retencao_select_artigo" name="retencao_select_artigo">
																<option value="Valor" selected>Valor (€)</option>
																<option value="Percentagem">Percentagem (%)</option>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Retenção</label>
															<input type="text" class="form-control money" id="retencao_valor_artigo" name="retencao_valor_artigo" placeholder="0,00 €"/>
															<input type="text" class="form-control percentage" id="retencao_percentagem_artigo" name="retencao_percentagem_artigo" placeholder="0 %" style="display: none;" />
														</div>
													</div>
												</div>

												<hr>

												<h5 class="form-header mtl">
													<legend class="form-legend">
														Códigos de barras
													</legend>
												</h5>
												<div class="row">
													<div class="col-xs-12">
														<table class="table table-bordered linesTable" id="table_artigos" style="margin-bottom: 5px;">
															<thead>
																<tr>
																	<th style="width:100%;">Código&nbsp;
																		<a class="options-link text-yellow" onclick="new_line()" title="Adicionar Novo Artigo"><i class="fa fa-plus-circle"></i></a>
																	</th>
																	<th style="width:30px;min-width: 30px; text-align: center;"></th>
																</tr>
															</thead>
															<tbody id="tbody_codigos_barras"></tbody>
														</table>
													</div>
													<div class="col-xs-12">
														<button type="button" class="btn btn-blue btn-xs btn-outlined" onclick="new_line()" title="Adicionar Linha"><i class="fa fa-plus"></i>&nbsp;Adicionar Linha</button>
													</div>
												</div>

												<hr>

												<h5 class="form-header mtl">
													<legend class="form-legend">
														Preços
													</legend>
												</h5>
												<div class="row">
													<div class="col-xs-12">
														<table class="table table-bordered linesPrices" id="table_prices" style="margin-bottom: 5px;">
															<thead>
															<tr>
																<th>IVA</th>
																<th>Preço PVP</th>
																<th>Preço Uni.</th>
																<th style="width:30px;min-width: 30px; text-align: center;"></th>
															</tr>
															</thead>
															<tbody id="tbody_prices"></tbody>
														</table>
													</div>
													<div class="col-xs-12">
														<button type="button" class="btn btn-blue btn-xs btn-outlined" onclick="addArticlePriceLine()" title="Adicionar Linha"><i class="fa fa-plus"></i>&nbsp;Adicionar Linha</button>
													</div>
												</div>

												<hr>

												<div class="row mtm">
													<div class="col-md-3 <?php echo $hideEncomendaAqui; ?>">
														<div class="form-group">
															<label class="control-label">Encomenda Aqui</label>
															<select class="form-control selectpicker show-tick"  data-header="Selecionar" id="encomendaaqui_artigo" name="encomendaaqui_artigo">
																<option value="0" selected>Não</option>
																<option value="1">Sim</option>
															</select>
														</div>
													</div>
													<div class="col-md-3 <?php echo $hidePOS; ?>">
														<div class="form-group">
															<label class="control-label">Disponível para a ementa</label>
															<select class="form-control selectpicker show-tick"  data-header="Selecionar" id="disponivelementa_artigo" name="disponivelementa_artigo">
																<option value="0" selected>Não</option>
																<option value="1">Sim</option>
															</select>
														</div>
													</div>
													<div class="col-md-3 <?php echo $hidePOS; ?>">
														<div class="form-group">
															<label class="control-label">Adicionar produto aos postos?</label>
															<select class="form-control selectpicker show-tick"  data-header="Selecionar" id="adicionar_posto" name="adicionar_posto">
																<option value="0" selected>Não</option>
																<option value="1">Sim</option>
															</select>
														</div>
													</div>
													<div class="col-md-3 <?php echo $hidePOS; ?> postos-list">
														<div class="form-group">
															<label class="control-label">Postos</label>
															<select multiple class="form-control selectpicker show-tick" data-live-search="true" data-header="Selecionar opção" id="id_postos" name="id_postos">
															</select>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Impressora</label>
															<select class="form-control selectpicker show-tick"  data-header="Selecionar" ">
															</select>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">AV/APV Fitofarmacêuticos</label>
															<input type="text" class="form-control" id="fitofarmaceuticos_artigo" name="fitofarmaceuticos_artigo" placeholder="..." />
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Label Etiqueta <small><em>(Impressão de Etiquetas e relacionados)</em></small></label>
															<input type="text" class="form-control" id="label_artigo" name="label_artigo" placeholder="..." />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Autopreenchimento</label>
															<div class="checkbox">
																<label>
																	<input type="checkbox" class="iCheck" name="autopreencher_comentario_artigo" id="autopreencher_comentario_artigo">
																	Autopreencher comentário no documento?
																</label>
															</div>
														</div>
													</div>
													<div class="col-md-12 mtm">
														<div class="form-group">
															<label class="control-label">Observações</label>
															<textarea type="text" class="form-control" id="observacoes_artigo" name="observacoes_artigo" placeholder="..." rows="4"></textarea>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-md-6" style="display: none;">
														<div class="form-group">
															<label class="control-label">Plano de Contas (Débito)<span class="require">*</span></label>
															<select name="plano_artigo" id="plano_artigo" class="form-control selectpicker show-tick" data-live-search="true"  data-header="Selecionar opção" >
															</select>
														</div>
													</div>
													<div class="col-md-6" style="display: none;">
														<div class="form-group">
															<label class="control-label">Plano de Contas (Crédito)<span class="require">*</span></label>
															<select name="plano_2_artigo" id="plano_2_artigo" class="form-control selectpicker show-tick" data-live-search="true"  data-header="Selecionar opção" >
															</select>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-xs-12">
														<div class="form-group">
														<label class="control-label">Foto <small>(Recomendado: 800x800px; Máx: 5MB; Formato: .jpeg, .jpg ou .png)</small></label>
														<input class="form-control file" type="file" id="foto_artigo" name="foto_artigo">
													</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-footer">
										<div class="mtxl pull-right">
											<button class="btn btn-yellow submit_button" type="submit">
												<i class="fa fa-floppy-o"></i> Gravar
											</button>
											<a  href="../artigos" class="btn btn-default" type="button"> Cancelar </a>
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
		<script src="/js/vendors/iCheck/icheck.min.js"></script>
		<script src="/js/vendors/iCheck/custom.min.js"></script>
		<script src="/js/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="/js/vendors/bootstrap-select/defaults-pt_BR.min.js"></script>

		<script src="/js/vendors/DataTables/media/js/jquery.dataTables.js"></script>
		<script src="/js/vendors/DataTables/media/js/dataTables.bootstrap.js"></script>

		<script src="/js/vendors/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="/js/vendors/bootstrap-datepicker/bootstrap-datepicker.pt.js"></script>
		<script src="/js/vendors/jquery-maskedinput/jquery-maskedinput.js"></script>
		<script src="/js/fnReload.js"></script>

		<script src="/js/autoNumeric.js"></script>

		<script src="/js/vendors/bootstrap-fileinput/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
		<script src="/js/vendors/bootstrap-fileinput/fileinput.min.js" type="text/javascript"></script>
		<script src="/js/vendors/bootstrap-fileinput/fileinput_locale_pt.js" type="text/javascript"></script>

		<?php include('editar_scripts.php');  ?>
		<!-- //ADDED SCRIPTS -->

		<script>
			$(".navbar-nav li.artigos").addClass("active");
			$(".navbar-nav li.artigos li.artigos_artigos").addClass("active");
		</script>
		<script type="text/javascript">
			$('.postos-list').hide();
			$('#adicionar_posto').change(function () {
				if(this.value == "0"){
					$('.postos-list').hide()
				}else{
					$('.postos-list').show()
				}
			});

			let valorLinhas = 0;
			let lastIdLine = 0;
			var gl_fotoPath = "";

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
					mDec : <?php echo $nDec; ?>
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

				$(".percentageBig").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					// vMax : '100',
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
					mDec : <?php echo $nDec; ?>
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

				$(".percentageBig").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					// vMax : '100',
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

				// iCheck ------------------------
				$('input:checkbox').attr("checked");
				$('input[type=checkbox]').iCheck({
					checkboxClass : 'icheckbox_flat-yellow',
					increaseArea : '20%' // optional
				});

				//fill select boxes
				var idArtigo = getParameterByName('artigo');
				fill_artigo(idArtigo);
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

			/** @plugin Foto Artigo */
			var btnCust = '<button style="display:none" id="remove-pick-btn" type="button" class="btn btn-danger" ' + 'onclick="remover_foto(0)">' + '<i class="fa fa-ban"></i>' + '</button>';
			$("#foto_artigo").fileinput({
				uploadUrl : "/gesfaturacao/artigos/upload_foto.php",
				uploadAsync : false,
				showClose : false,
				showCaption : false,
				showRemove : false,
				showUpload : false,
				dropZoneEnabled : false,
				maxFileSize : 5000,
				browseLabel : 'Selecionar Foto',
				browseIcon : '<i class="fa fa-picture-o"></i>',
				removeLabel : '',
				browseClass : "btn btn-blue",
				elErrorContainer : '#kv-avatar-errors',
				msgErrorClass : 'alert alert-block alert-danger',
				defaultPreviewContent : '<img id="prevFotoFicha" src="/uploads/faturacao/artigos/default.png"  class="file-preview-image" style="max-height: 300px; max-width:300px; text-align:center;" data-prev="no">',
				layoutTemplates : {
					main2 : '{preview} ' + btnCust + ' {remove} {browse}',
					footer : ''
				},
				allowedFileExtensions : ["jpg", "png", "jpeg"]
			}).on('filebatchselected', function(event, files) {
				$("#remove-pick-btn").attr("onclick", "remover_foto(0)");
				$("#remove-pick-btn").html('<i class="fa fa-trash"></i>');
				$("#remove-pick-btn").show();

			});

			//REMOVER FOTO
			function remover_foto(opcao) {
				gl_fotoPath = "";
				if (opcao == 1) {
					//Restaura Original
					$("#remove-pick-btn").attr("onclick", "remover_foto(0)");
					$("#remove-pick-btn").show();
				} else {
					//Unlink da Foto
					$(".file-preview-image").attr("src", "/uploads/faturacao/artigos/default.png");

					$("#remove-pick-btn").hide();
					$("#remove-pick-btn").attr("onclick", "remover_foto(1)");
				}
			}

			//calcula recalcula preco
			$("#imposto_artigo").on('change', function(event){
				var taxa = $(this).find('option:selected').attr('data-taxa');
				if(taxa == 0) {
					$('#motivo_isencao_artigo').prop('disabled', false);
					$('#motivo_obrigatorio').text('*');
				} else {
					$('#motivo_isencao_artigo').selectpicker('val', '');
					$('em[for=motivo_isencao_artigo]').remove();
					$('#motivo_obrigatorio').text('');
					$('#motivo_isencao_artigo').prop('disabled', true);
				}
				$('#motivo_isencao_artigo').selectpicker('refresh');
				calculaPreco();
			});

			//bloqueia retenção ou não
			$("#tipo_artigo").on('change', function(event){
				var tipoArtigo = $(this).val();

				if(tipoArtigo == 'S'){
					$("#retencao_select_artigo").prop('disabled', false);
					$("#retencao_select_artigo").selectpicker('refresh');
					$("#retencao_valor_artigo").prop('disabled', false);
					$("#retencao_percentagem_artigo").prop('disabled', false);
				}else{
					$("#retencao_select_artigo").prop('disabled', true);
					$("#retencao_select_artigo").selectpicker('refresh');
					$("#retencao_valor_artigo").autoNumeric('set',0);
					$("#retencao_valor_artigo").prop('disabled', true);
					$("#retencao_percentagem_artigo").autoNumeric('set',0);
					$("#retencao_percentagem_artigo").prop('disabled', true);
				}
			});

			//calcula preco
			$("#precoPVP_artigo").on('keyup', function(event){
				calculaPreco();
			});
			//calcula preco
			$("#precoPVP_artigo").on('change', function(event){
				calculaPreco();
			});

			//calcula preco pvp
			$("#preco_artigo").on('keyup', function(event){
				calculaPrecoPVP();
			});
			//calcula preco pvp
			$("#preco_artigo").on('change', function(event){
				calculaPrecoPVP();
			});

			//change retenção type
			$("#retencao_select_artigo").on('change', function(event){
				var tipo = $(this).val();

				if(tipo == 'Valor'){
					$('#retencao_valor_artigo').show();
					$('#retencao_percentagem_artigo').hide();
					$('#retencao_percentagem_artigo').autoNumeric('set', 0);
				}else{
					$('#retencao_percentagem_artigo').show();
					$('#retencao_valor_artigo').hide();
					$('#retencao_valor_artigo').autoNumeric('set', 0);
				}
			});

			//prevent enter from focus
			$('body').on('keydown', function(e) {
				if (e.which == 13) {
					if($("#codigobarras_artigo").is(":focus")){
						e.preventDefault();
					}
					if($("#numeroserie_artigo").is(":focus")){
						e.preventDefault();
					}
				}
			});

			//Calculate Unit Price Using Cost Price
			function calculate_unit_price_by_margin(){
				let isMarginActive = $('#calcular_margem_unitario_artigo').is(':checked') ? 1 : 0;
				let margin = $("#margemlucro_artigo").autoNumeric('get');
				if(isMarginActive == 1){
					if(margin > 0){
						let marginPercentage = margin * 0.01;
						let costPrice = $('#precocustoinicial_artigo').autoNumeric('get');

						//calculate margin
						let margin_calc = costPrice * marginPercentage;
						let final_unit_price = Number(costPrice) + Number(margin_calc);

						// console.log(costPrice, margin_calc, final_unit_price);

						//alter unit price
						$('#preco_artigo').autoNumeric('set', final_unit_price);
						$('#preco_artigo').trigger('change');
					}else{
						let costPrice = $('#precocustoinicial_artigo').autoNumeric('get');

						//alter unit price
						$('#preco_artigo').autoNumeric('set', costPrice);
						$('#preco_artigo').trigger('change');
					}
				}
			}

			// ----------------- FORM PROCESSING ------------------
			/* Custom validators for letters and numbers only.
			 * Uppercase/lowercase letters and numbers (0-9).
			 */
			$.validator.addMethod("lettersAndNumbersOnly", function (value, element) {
				return this.optional(element) || /^[a-zA-Z0-9-]+$/i.test(value);
			}, "Por favor introduza apenas letras e números.");

			/* Custom validators for letters and numbers only (with spaces).
			 * Uppercase/lowercase letters and numbers (0-9).
			 */
			$.validator.addMethod("lettersAndNumbersOnlyWS", function (value, element) {
				return this.optional(element) || /^[a-zA-Z0-9- _#*/.]+$/i.test(value);
			}, "Por favor introduza apenas letras e números.");

			/* Custom validators numbers bigger than. */
			$.validator.addMethod("smallerThan", function (value, element, param) {
				var valorPVP = Number( $(param).autoNumeric('get') );
				var retencaoValor = Number( $(element).autoNumeric('get') );
				var result;

				if(valorPVP >= retencaoValor) result = true;
				else result = false;

				return result;
			}, "O valor tem que ser menor do que o campo 'Preço PVP'");

			/* Custom validators require motivo isencao. */
			$.validator.addMethod("motivoRequired", function (value, element) {
				var valorTaxa = $("#imposto_artigo option:selected").attr('data-taxa');

				if(valorTaxa == 0) {
					var motivoIsencao = $("#motivo_isencao_artigo").val();
					if(motivoIsencao == '' || motivoIsencao == 0) return false;
				}

				return true;
			}, "Este campo é obrigatório");

			val_form_new = $("#form_new").validate({
				ignore : "",
				rules : {
					codigo_artigo : {
						required : true,
						lettersAndNumbersOnlyWS : true
					},
					nome_artigo : {
						required : true
					},
					tipo_artigo : {
						required : true
					},
					unidade_artigo : {
						required : true
					},
					precoPVP_artigo : {
						required : true
					},
					preco_artigo : {
						required : true
					},
					imposto_artigo : {
						required : true
					},
					codigobarras_artigo : {
						lettersAndNumbersOnly : true
					},
					retencao_valor_artigo : {
						smallerThan : "#precoPVP_artigo"
					},
					/*plano_artigo : {
						required : true,
					},*/
					/*plano_2_artigo : {
						required : true,
					},*/
					motivo_isencao_artigo : {
						motivoRequired : true,
					}
				},
				messages : {
					codigo_artigo : {
						required : "Este campo é obrigatório"
					},
					nome_artigo : {
						required : "Este campo é obrigatório"
					},
					tipo_artigo : {
						required : "Este campo é obrigatório"
					},
					unidade_artigo : {
						required : "Este campo é obrigatório"
					},
					precoPVP_artigo : {
						required : "Este campo é obrigatório"
					},
					preco_artigo : {
						required : "Este campo é obrigatório"
					},
					imposto_artigo : {
						required : "Este campo é obrigatório"
					},
					/*plano_artigo : {
						required : "Este campo é obrigatório"
					},*/
					/*plano_2_artigo : {
						required : "Este campo é obrigatório"
					},*/
					motivo_isencao_artigo : {
						motivoRequired : "Este campo é obrigatório"
					}
				},
				highlight : function(element, errorClass, validClass) {
					$(element).addClass(errorClass).removeClass(validClass);
				},
				unhighlight : function(element, errorClass, validClass) {
					$(element).removeClass(errorClass).addClass(validClass);
				},
				errorPlacement : function(error, element) {
					if (element.hasClass('selectpicker')) {
						if (element.parent().hasClass("input-group"))
							error.insertAfter(element.parent());
						else
							error.insertAfter(element.next("div"));
					} else {
						error.insertAfter(element);
					}
				}
			});
			//check validation and submit the form
			$("#form_new").submit(function(e) {
				e.preventDefault();

				var img = $(".file-preview-image").attr("src");
				var imgPrev = $(".file-preview-image").attr("data-prev");
				// var resp = null;

				let valorUnit = $("#preco_artigo").autoNumeric('get');
				let valorPVP = $("#precoPVP_artigo").autoNumeric('get');

				if(((valorPVP > 0 && valorUnit == 0) || (valorPVP == 0 && valorUnit > 0)) && valorUnit > 0.004) {
					$.scojs_message("Por favor verifique os campos de Preço PVP e Preço Unitário.", $.scojs_message.TYPE_ERROR);
					return false;
				}

				var valid = $("#form_new").valid();
				if (valid == false) {
					$.scojs_message("Preencha todos os campos", $.scojs_message.TYPE_ERROR);
				} else {
					//try to upload the image
					if(gl_fotoPath !== "" && gl_fotoPath!== null){
						submitData(gl_fotoPath);
					} else if (img != "/uploads/faturacao/artigos/default.png" && imgPrev != 'yes') {
						$("#foto_artigo").fileinput("upload").on('filebatchuploadsuccess', function(event, data, id, index) {
							// console.log(data.response.errors,data.response.name);
							if (data.response.errors) {
								remover_foto(0);
								$.scojs_message("[FTGP000] Ocorreu um problema ao carregar a imagem.", $.scojs_message.TYPE_WARNING);
								return false;
							} else {
								gl_fotoPath = data.response.name ? data.response.name : "";
								submitData(gl_fotoPath);
							}
						});
					} else {
						submitData(gl_fotoPath);
					}
				}
				return false;
			});

			//submit the form in second place
			function submitData(fotoPath) {
				var idArtigo = getParameterByName('artigo');

				var prices_lines = [];
				var validPrices = true;
				$("select.lineInputImposto").each(function() {
					var lineID = $(this).attr('data-id-line');
					var precoUn =  $("#preco_linha_"+lineID).autoNumeric('get');
					var imposto = $("#iva_linha_"+lineID).val();
					var precoPVP = $("#precopvp_linha_"+lineID).autoNumeric('get');

					if(imposto && precoPVP != "" && precoUn != ""){
						//add to array
						prices_lines.push({
							preco : precoUn,
							imposto : imposto,
							precoPvp : precoPVP
						});
					}else if(!imposto && precoPVP == "" && precoUn == ""){

					}else{
						validPrices = false;
					}
				});

				if(validPrices == false){
					$.scojs_message("Preencha todos os campos das linhas de preços", $.scojs_message.TYPE_ERROR);
					return false;
				}

				var valid = $("#form_new").valid();
				if (valid == false) {
					$.scojs_message("Preencha todos os campos", $.scojs_message.TYPE_ERROR);
				} else {
					$("#form_new").find('.submit_button').attr("disabled", true);
					$("#form_new").find('.submit_button').html('<i class="fa fa-circle-o-notch fa-spin  fa-fw "></i> A Carregar...');

					var codigosBarras = [];
					$(".codigobarras_artigo").each(function() {
						if($(this).val() != ""){
							codigosBarras.push({
								codigo: $(this).val()
							});
						}
					});

					let supplier_lines = [];

					//submite the form
					$.ajax({
						type : 'POST',
						url : '/gesfaturacao/server/artigos/artigos_editar.php',
						dataType : 'json',
						data : {
							foto_artigo : fotoPath,

							idArtigo : idArtigo,
							codigo_artigo : $("#codigo_artigo").val(),
							nome_artigo : $("#nome_artigo").val(),
							categoria_artigo : $("#categoria_artigo").val(),
							tipo_artigo : $("#tipo_artigo").val(),
							stock_artigo : $("#stock_artigo").autoNumeric('get'),
							stock_minimo : $("#stock_minimo").autoNumeric('get'),
							unidade_artigo : $("#unidade_artigo").val(),
							precoPVP_artigo : $("#precoPVP_artigo").autoNumeric('get'),
							imposto_artigo : $("#imposto_artigo").val(),
							preco_artigo : $("#preco_artigo").autoNumeric('get'),
							/*codigobarras_artigo : $("#codigobarras_artigo").val(),*/
							codigobarras_artigo : "",
							numeroserie_artigo : $("#numeroserie_artigo").val(),
							retencao_valor_artigo : $("#retencao_valor_artigo").autoNumeric('get'),
							retencao_percentagem_artigo : $("#retencao_percentagem_artigo").autoNumeric('get'),
							// plano_artigo : $('#plano_artigo').val(),
							// plano_2_artigo : $('#plano_2_artigo').val(),
							motivo_isencao_artigo : $('#motivo_isencao_artigo').val(),
							observacoes_artigo : $('#observacoes_artigo').val(),
							label_artigo : $('#label_artigo').val(),
							fitofarmaceuticos_artigo : $('#fitofarmaceuticos_artigo').val(),

							encomendaaqui_artigo : $('#encomendaaqui_artigo').val(),
							precocustoinicial_artigo : $('#precocustoinicial_artigo').autoNumeric('get'),
							codigobarras_artigo : JSON.stringify( codigosBarras ),
							disponivelementa_artigo : $('#disponivelementa_artigo').val(),
							prices_lines : JSON.stringify(prices_lines),

							adicionar_posto : $('#adicionar_posto').val(),
							id_postos: $('#id_postos').val(),
							alertaStockMin: $('#alerta_stock_min').is(':checked') ? 1 : 0,

							calcular_margem_unitario_artigo: $('#calcular_margem_unitario_artigo').is(':checked') ? 1 : 0,
							margemlucro_artigo : $("#margemlucro_artigo").autoNumeric('get'),
							autopreencher_comentario_artigo: $('#autopreencher_comentario_artigo').is(':checked') ? 1 : 0,
							supplier_lines : JSON.stringify(supplier_lines),
						},
						success : function(resposta) {
							var resp = resposta;
							if (resposta == null)
								$.scojs_message("[FAT001] Ocorreu um erro ao inserir os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
							else {
								if (resposta.errors) {
									$.scojs_message("[FAT002] Ocorreu um erro ao inserir os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
								} else {
									$.scojs_message("Dados atualizados com sucesso.", $.scojs_message.TYPE_OK);
								}
							}
						},
						complete : function(resposta) {
							var resp = resposta;
							console.log(resp);
							if (resp.responseJSON.errors) {
								if (resp.responseJSON.codigo) {
									$.scojs_message("[FAT003] O código já se encontra registado.", $.scojs_message.TYPE_ERROR);
								}else if (resp.responseJSON.codigobarras) {
									$.scojs_message("[FAT004] O código de barras já se encontra registado.", $.scojs_message.TYPE_ERROR);
								}else{
									$.scojs_message("[FAT005] Ocorreu um erro ao inserir os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
								}
							} else {
								$.scojs_message("Dados atualizados com sucesso.", $.scojs_message.TYPE_OK);
								//reload
								setTimeout(function() {
									window.location.href = "../artigos/detalhes?artigo="+idArtigo;
								}, 1000);
							}
							$("#form_new").find('.submit_button').attr("disabled", false);
							$("#form_new").find('.submit_button').html('<i class="fa fa-floppy-o"></i> Gravar');
						}
					});
				}
			}
		</script>
	</body>
</html>
