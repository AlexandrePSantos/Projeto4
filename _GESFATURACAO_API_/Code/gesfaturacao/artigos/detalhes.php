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
	<title>Artigo: Detalhes | GESFaturação</title>
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
							<!-- <a href="artigos_compostos?artigo=<?php echo $_GET['artigo'] ? $_GET['artigo'] : 0; ?>" class="btn btn-blue btn-square"><i class="fa fa-object-group"></i>&nbsp;&nbsp;Artigos Associados</a>&nbsp;&nbsp; -->

							<a class="text-red only-ic" href="../artigos"><i class="fa fa-times"></i></a>
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li>
								<a href="../artigos">Artigos</a>
							</li>
							<li class="active">
								Detalhes do Artigo
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row">
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
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Código</label>
															<span id="codigo_artigo" style="display: block"></span>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Nome</label>
															<span id="nome_artigo" style="display: block"></span>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label class="control-label">Categoria</label>
															<span id="categoria_artigo" style="display: block"></span>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Tipo</label>
															<span id="tipo_artigo" style="display: block"></span>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Unidade de medida</label>
															<span id="unidade_artigo" style="display: block"></span>
														</div>
													</div>
													<?php if ($_SESSION['id_plano_atual'] !== 1) { ?>
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Qtd. Stock</label>
															<span id="stock_artigo" style="display: block"></span>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Stock Mínimo</label>
															<span id="stock_minimo" style="display: block"></span>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Alerta Stocks Mínimos</label><br>
															<span id="alerta_stock_min"></span>
														</div>
													</div>
													<?php } ?>
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Nº Série</label>
															<span id="numeroserie_artigo" style="display: block"></span>
														</div>
													</div>
												</div>

												<hr>

												<div class="row mtm">
													<div class="col-xs-12 col-sm-2">
														<div class="form-group">
															<label class="control-label">Preço PVP</label>
															<span id="precoPVP_artigo" class="money" style="display: block"></span>
														</div>
													</div>
													<div class="col-xs-12 col-sm-2">
														<div class="form-group">
															<label class="control-label">IVA</label>
															<span id="imposto_artigo" class="percentage" style="display: block"></span>
														</div>
													</div>
													<div class="col-xs-12 col-sm-2">
														<div class="form-group">
															<label class="control-label">Preço Unitário</label>
															<span id="preco_artigo" class="moneyBig" style="display: block"></span>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Calcular Preço Unit.</label><br>
															<span id="calcular_margem_unitario_artigo"></span>
														</div>
													</div>
													<div class="col-xs-12 col-sm-2">
														<div class="form-group">
															<label class="control-label">Margem de Lucro</label>
															<span id="margemlucro_artigo" class="percentageBig" style="display: block"></span>
														</div>
													</div>
													<div class="col-xs-12 col-sm-2">
														<div class="form-group">
															<label class="control-label">Preço Custo Inicial</label>
															<span id="precocustoinicial_artigo" class="moneyBig" style="display: block"></span>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-sm-4" id="optMotivoIsencao">
														<div class="form-group">
															<label class="control-label">Motivo de Isenção</label><br>
															<span id="motivo_isencao_artigo"></span>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label class="control-label">Retenção</label>
															<span id="retencao_artigo" class="moneyBig" style="display: block"></span>
														</div>
													</div>
												</div>

												<hr class="precocustoelements">

												<div class="row mtm precocustoelements">
													<div class="col-xs-12 col-sm-12">
														<div class="form-group">
															<label class="control-label text-red">Preço de Custo Médio (<em>valor automático baseado nas compras registadas / preço de custo inicial</em>)</label>
															<b><span id="preco_custo" class="moneyBig" style="display: block"></span></b>
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
														<table class="table table-bordered linesTable" id="table_codigos" style="margin-bottom: 5px;">
															<thead>
																<tr>
																	<th style="width:100%;">Código&nbsp;</th>
																</tr>
															</thead>
															<tbody id="tbody_codigos">
															</tbody>
														</table>
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
																</tr>
															</thead>
															<tbody id="tbody_prices"></tbody>
														</table>
													</div>
												</div>

												<hr>

												<h5 class="form-header mtl">
													<legend class="form-legend">
														Referências do fornecedor
													</legend>
												</h5>
												<div class="row">
													<div class="col-xs-12">
														<table class="table table-bordered linesSuppliers" id="table_suppliers" style="margin-bottom: 5px;">
															<thead>
															<tr>
																<th>Fornecedor</th>
																<th>Referência</th>
															</tr>
															</thead>
															<tbody id="tbody_suppliers"></tbody>
														</table>
													</div>
												</div>

												<hr>

												<div class="row mtm">
													<div class="col-sm-3 <?php echo $hideEncomendaAqui; ?>">
														<div class="form-group">
															<label class="control-label">Encomenda Aqui</label><br>
															<span id="encomendaaqui_artigo"></span>
														</div>
													</div>
													<div class="col-sm-3 <?php echo $hidePOS; ?>">
														<div class="form-group">
															<label class="control-label">Disponível para a ementa</label><br>
															<span id="disponivelementa_artigo"></span>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">Artigo Composto</label><br>
															<span id="tipocomposto_artigo"></span>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">Impressora</label><br>
															<span id="impressora_artigo"></span>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">AV/APV Fitofarma.</label><br>
															<span id="fitofarmaceuticos_artigo"></span>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label">Label Etiqueta</label><br>
															<span id="label_artigo"></span>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label class="control-label">Autopreencher Comentário</label><br>
															<span id="auto_preencher_artigo"></span>
														</div>
													</div>
													<div class="col-sm-12 mtm">
														<div class="form-group">
															<label class="control-label">Observações</label><br>
															<span id="observacoes_artigo"></span>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-sm-4" style="display: none;">
														<div class="form-group">
															<label class="control-label">Plano de Contas (Débito)</label>
															<span id="plano_artigo" style="display: block;"></span>
														</div>
													</div>
													<div class="col-sm-4" style="display: none;">
														<div class="form-group">
															<label class="control-label">Plano de Contas (Crédito)</label>
															<span id="plano_2_artigo" style="display: block;"></span>
														</div>
													</div>
												</div>
												<div class="row mtm">
													<div class="col-xs-12" id="fotoWrapper" style="display: none;">
														<div class="form-group">
															<img id="foto_artigo" src="#" alt="Foto Artigo" style="max-width: 150px; max-height: 150px;" />
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


			//load data
			function fill_artigo(idArtigo) {
				$.ajax({
					type : 'POST',
					url : '/gesfaturacao/server/artigos/artigos_detalhes.php',
					dataType : 'json',
					data : { idArtigo : idArtigo },
					success : function(resposta) {
						if (resposta == null) {
							$.scojs_message("[FAT001] Não foi possível processar os dados. Por favor tente novamente", $.scojs_message.TYPE_ERROR);
						} else {
							if (resposta.errors == true) {
								$.scojs_message("[FAT002] Não foi possível processar os dados. Por favor tente novamente", $.scojs_message.TYPE_ERROR);
							} else {
								if (resposta.data == null) {
									$.scojs_message("[FAT003] Não foi possível processar os dados. Por favor tente novamente", $.scojs_message.TYPE_ERROR);
								} else {
									var dados = resposta.data;

									$.each(dados.codigosbarras,function (key,codigo) {
										let html = '<tr class="articles_lines" id="line_"'+key+'>'
										html += '<td style="width:100px;">'
										html +=  '<div style="padding: 5px" class="input-group">'
										html += '<span >'+codigo.CodigoBarras+'</span>'
										html += '</div>'
										html += '</td>'
										html += '</tr>'

										$('#tbody_codigos').append(html);
									});

									$.each(dados.pricesLines,function (key,price) {
										let html = '<tr class="price_lines" id="price_line_"'+key+'>'
										html += '<td>'+price.imposto+'%</td>'
										html += '<td><span class="moneyBig">'+price.precoPVP+'</span></td>'
										html += '<td><span class="moneyBig">'+price.preco+'</span></td>'
										html += '</tr>'

										$('#tbody_prices').append(html);
									});

									$.each(dados.suppliersLines,function (key,fornecedor) {
										let html = '<tr class="articles_supplier_lines" id="supplier_article_line_"'+key+'>'
										html += '<td>'+fornecedor.Nome+'</td>'
										html += '<td>'+fornecedor.Referencia+'</td>'
										html += '</tr>'

										$('#tbody_suppliers').append(html);
									});

									//generic buttons
									$('#btns-wrapper').append('<a href="../artigos/registos_logs?artigo='+idArtigo+'" class="btn btn-grey" type="button"><i class="fa fa-history"></i> Registos (Logs)</a>&nbsp;');
									$('#btns-wrapper').append('&nbsp;&nbsp;|&nbsp;');

									//active or disabled
									if(dados.Ativo == 1){
										$('#btns-wrapper').append('&nbsp;<button type="button" onClick="alterState('+idArtigo+')" class="btn btn-violet" title="Desativar"><i class="fa fa-ban"></i>&nbsp;Desativar</a>');
									}else{
										$('#btns-wrapper').append('&nbsp;<button type="button" onClick="alterState('+idArtigo+')" class="btn btn-green" title="Ativar"><i class="fa fa-check-square-o"></i>&nbsp;Ativar</a>');
									}

									//process used or not used
									$('#btns-wrapper').append('&nbsp;<a href="editar?artigo='+idArtigo+'" class="btn btn-yellow" type="button"> <i class="fa fa-edit"></i>&nbsp;Editar </a>');
									if(dados.Usado == 1){
										$('#btns-wrapper').append('&nbsp;<button class="btn btn-danger" type="button" disabled> <i class="fa fa-trash"></i>&nbsp;Remover </button>');
									}else{
										var nome = "'" + dados.Nome + "'";
										$('#btns-wrapper').append('&nbsp;<button class="btn btn-danger" type="button" onClick="eliminarArtigo('+idArtigo+','+nome+')"> <i class="fa fa-trash"></i>&nbsp;Remover </button>');
									}

									$('#btns-wrapper').append('&nbsp;&nbsp;<a href="../artigos" class="btn btn-default" type="button"> Cancelar </a>');

									$("#codigo_artigo").html(dados.Codigo);
									$("#nome_artigo").html(dados.Nome);
									$("#observacoes_artigo").html(dados.DescricaoLonga);
									$("#label_artigo").html(dados.LabelEtiqueta);
									$("#tipocomposto_artigo").html(dados.TipoCompostoDescricao);
									$("#fitofarmaceuticos_artigo").html(dados.NumAVAPVFitoFarmac);

									if(dados.EncomendaAqui == 1) $("#encomendaaqui_artigo").html('Sim');
									else $("#encomendaaqui_artigo").html('Não');

									if(dados.DisponivelEmenta == 1) $("#disponivelementa_artigo").html('Sim');
									else $("#disponivelementa_artigo").html('Não');

									if(dados.AutoPreencherComentario == 1) $("#auto_preencher_artigo").html('Sim');
									else $("#auto_preencher_artigo").html('Não');

									if(dados.Categoria) $("#categoria_artigo").html(dados.Categoria);
									else $("#categoria_artigo").html('Sem categoria');

									<?php if ($_SESSION['id_plano_atual'] !== 1) { ?>
									if(dados.Tipo != 'Serviços' && dados.TipoComposto != 1) {
										$("#stock_artigo").html(dados.Stock);
										$("#stock_minimo").html(dados.StockMin);
									} else {
										$("#stock_artigo").html('-');
										$("#stock_minimo").html('-');
									}

									if(dados.AlertaStockMinimo) $('#alerta_stock_min').html('Sim');
									else $('#alerta_stock_min').html('Não');
									<?php } ?>

									$("#tipo_artigo").html(dados.Tipo);
									$("#unidade_artigo").html(dados.Unidade);
									$("#precoPVP_artigo").autoNumeric('set', dados.PrecoPVP);
									$("#imposto_artigo").autoNumeric('set', dados.IVA);
									$("#preco_artigo").autoNumeric('set', dados.Preco);
									$("#codigobarras_artigo").html(dados.CodigoBarras);
									$("#numeroserie_artigo").html(dados.SerialNumber);
									$("#retencao_artigo").autoNumeric('set', dados.Retencao);
									$('#precocustoinicial_artigo').autoNumeric('set', dados.PrecoCustoInicial);

									if(dados.MotivoIsencao && dados.MotivoIsencao != '') {
										$("#motivo_isencao_artigo").html(dados.MotivoIsencao);
										$("#optMotivoIsencao").show();
									} else {
										$("#optMotivoIsencao").hide();
									}
									if(dados.imagem) {
										$("#foto_artigo").attr('src',"/uploads/faturacao/artigos/"+dados.imagem);
										$("#fotoWrapper").show();
									}

									if(dados.ProcessarPorMargemLucro) $('#calcular_margem_unitario_artigo').html('Sim: Margem de Lucro');
									else $('#calcular_margem_unitario_artigo').html('Não');
									$('#margemlucro_artigo').autoNumeric('set', dados.PercentagemMargemLucro);

									//preco de custo
									if(dados.Tipo != 'Produtos'){
										$(".precocustoelements").hide();
									}
									if(dados.PrecoCusto > 0) $('#preco_custo').autoNumeric('set', dados.PrecoCusto);
									else $('#preco_custo').autoNumeric('set', dados.PrecoCustoInicial);

									$('#plano_artigo').html(dados.PlanoContas);
									//$('#plano_2_artigo').html(dados.PlanoContasCompras);

									//remake percentage
									$(".percentage").autoNumeric("init", {
										aSep : '.',
										aDec : ',',
										aSign : '  %',
										vMax : '100',
										mDec : 2,
										vMin:'0',
										pSign : 's'
									});

									//remake money
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
								}
							}
						}
					},
					complete : function() {
					}
				});
			}

			//ALTER STATE ARTIGO
			function alterState(idArtigo){
				$.ajax({
					type : 'POST',
					url : '/gesfaturacao/server/artigos/artigos_estado.php',
					dataType : 'json',
					data : {
						idArtigo : idArtigo
					},
					success : function(resposta) {
						var resp = resposta;
						if (resposta == null)
							$.scojs_message("[FAT001] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
						else {
							if (resposta.errors) {
								$.scojs_message("[FAT002] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
							} else {
								$.scojs_message("Artigo atualizado com sucesso.", $.scojs_message.TYPE_OK);
							}
						}
					},
					complete : function(resposta) {
						location.reload();
					}
				});
			}

			//REMOVER ARTIGO
			function eliminarArtigo(idArtigo, nome){
				if (confirm("Tem a certeza que pretende remover o artigo \n'" + nome + "' ?") == true) {
					var resp = null;
					//send data
					$.ajax({
						type : 'POST',
						url : '/gesfaturacao/server/artigos/artigos_apagar.php',
						dataType : 'json',
						data : {
							idArtigo : idArtigo
						},
						success : function(resposta) {
							resp = resposta.errors;
							if (resposta == null) {
								$.scojs_message("[FTGP000] Não foi possível executar esta operação. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
							} else {
								if (resposta.errors) {
									if (resposta.utilizado) {
										$.scojs_message("[" + resposta.type + "] Não é possível remover este artigo porque está a ser utilizado.", $.scojs_message.TYPE_ERROR);
									}else{
										$.scojs_message("[" + resposta.type + "] Não foi possível executar esta operação. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
									}
								}else {
									$.scojs_message("Artigo removido com sucesso.", $.scojs_message.TYPE_OK);
								}
							}
						},
						complete : function() {
							if (resp == false) {
								window.location.href = "../artigos";
							}
						}
					});
				} else { return false; }
			}
		</script>
	</body>
</html>
