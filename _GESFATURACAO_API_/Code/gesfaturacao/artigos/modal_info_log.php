<div id="modal-registo-log" tabindex="-1" role="dialog" aria-labelledby="modal-header-primary-label" data-backdrop="static" data-keyboard="false" aria-hidden="true" class="modal fade">
	<div class="modal-dialog modal-wide-width">
		<div class="modal-content">
			<div class="modal-header modal-header-orange">
				<button type="button" data-dismiss="modal" aria-hidden="true" class="close">
					&times;
				</button>
				<h4 id="modal-header-primary-label" class="modal-title">Detalhes do Registo</h4>
			</div>
			<div class="modal-body" style="overflow-y: visible;">
				<div id="form_div">
					<div class="row">
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Código</label>
								<span id="codigo_stock_artigo" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">Nome</label>
								<span id="nome_stock_artigo" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Stock Atual</label>
								<span id="qtd_atual_stock_artigo" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Cód. Barras</label>
								<span id="codBarras_stock_artigo" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Nº Série</label>
								<span id="nSerie_stock_artigo" style="display: block"></span>
							</div>
						</div>
						<div class="col-xs-12"><hr></div>
					</div>
					<div class="row mtm">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Data</label>
								<span id="data_registo" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Criado por:</label>
								<span id="utilizador_registo" style="display: block"></span>
							</div>
						</div>
					</div>
					<div class="row mtm">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Documento Associado</label>
								<span id="documentoassociado_registo" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Stock Anterior</label>
								<span id="stockanterior_registo" class="qtd" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Stock Posterior</label>
								<span id="stockposterior_registo" class="qtd" style="display: block"></span>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Diferença</label>
								<span id="diferenca_registo" class="qtd" style="display: block"></span>
							</div>
						</div>
					</div>
					<div class="row mtm">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Ação</label>
								<div id="acao_registo" class="text-justify"></div>
							</div>
						</div>
					</div>

					<div class="row mtm" id="acertosWrapper">
						<div class="col-sm-2">
							<div class="form-group">
								<label class="control-label">Acerto Manual</label>
								<div id="acerto_registo" style="display: block"></div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label class="control-label">Data de Registo do Acerto</label>
								<div id="dataacerto_registo" style="display: block"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">
					Cancelar
				</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		//init elements
		$(".qtd").autoNumeric("init", {
			aSep : '.',
			aDec : ',',
			aSign : '',
			pSign : 's',
			mDec : 3
		});
	});

	/**
	 * Get article details
	 * @param  idArtigo
	 * @return fill details
	 */
	function fill_registo_data(idArtigo, idRegisto){
		//hide special wrapper
		$("#acertosWrapper").addClass('hide');
		$("#stockposterior_registo").removeClass("text-orange");
		$("#acerto_registo").html("---");
		$("#dataacerto_registo").html("---");

		//get data
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/artigos/artigos_registo_detalhes.php',
			data : { 
				idArtigo : idArtigo,
				idRegisto : idRegisto,
			},
			dataType : 'json',
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL007] Ocorreu um erro. Contacte o administrador", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL008] Ocorreu um erro. Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							//disable the selects
							// $(seriesSel).attr("disabled", true);
							// $(metodosSel).attr("disabled", true);
							// $(bancosSel).attr("disabled", true);
						} else {
							var dados = resposta.data;

							$('#codigo_stock_artigo').html(dados.Codigo);
							$('#nome_stock_artigo').html(dados.Nome);
							$('#codBarras_stock_artigo').html(dados.CodigoBarras);
							$('#nSerie_stock_artigo').html(dados.SerialNumber);
							$('#qtd_atual_stock_artigo').html(dados.Stock+' ('+dados.Unidade+')');

							//registo
							$('#data_registo').html(dados.DataRegisto);
							$('#stockanterior_registo').autoNumeric('set',dados.StockAnterior);
							$('#stockposterior_registo').autoNumeric('set',dados.StockPosterior);
							$('#diferenca_registo').autoNumeric('set',dados.DiferencaRegisto);
							$('#utilizador_registo').html(dados.NomeUtilizador);
							$('#acao_registo').html(dados.Acao);

							if(dados.ID_Doc_Associado > 0){
								var link_doc_origem = '';
								var label_doc_origem = '';

								switch (dados.Tipo_Doc_Associado) {
									case 'FT':
										link_doc_origem = '/gesfaturacao/faturas/detalhes.php?fatura='+dados.ID_Doc_Associado;
										label_doc_origem = '(Fatura Normal)';
										break;
									case 'FS':
										link_doc_origem = '/gesfaturacao/faturas-simplificadas/detalhes.php?fatura='+dados.ID_Doc_Associado;
										label_doc_origem = '(Fatura Simplificada)';
										break;
									case 'FR':
										link_doc_origem = '/gesfaturacao/faturas-recibo/detalhes.php?fatura='+dados.ID_Doc_Associado;
										label_doc_origem = '(Fatura Recibo)';
										break;
									case 'GT':
										link_doc_origem = '/gesfaturacao/guias-transporte/detalhes.php?guia='+dados.ID_Doc_Associado;
										label_doc_origem = '(Guia de Transporte)';
										break;
									case 'NC':
										link_doc_origem = '/gesfaturacao/notas-credito/detalhes.php?nota='+dados.ID_Doc_Associado;
										label_doc_origem = '(Nota de Crédito)';
										break;
									case 'ND':
										link_doc_origem = '/gesfaturacao/notas-debito/detalhes.php?nota='+dados.ID_Doc_Associado;
										label_doc_origem = '(Nota de Débito)';
										break;
									case 'OR':
										link_doc_origem = '/gesfaturacao/orcamentos/detalhes.php?orcamento='+dados.ID_Doc_Associado;
										label_doc_origem = '(Orçamento)';
										break;
									case 'PF':
										link_doc_origem = '/gesfaturacao/proformas/detalhes.php?proforma='+dados.ID_Doc_Associado;
										label_doc_origem = '(Proforma)';
										break;
									case 'FTC':
										link_doc_origem = '/gesfaturacao/compras/detalhes.php?compra='+dados.ID_Doc_Associado;
										label_doc_origem = '(Fatura de Compra)';
										break;
									case 'NCC':
										link_doc_origem = '/gesfaturacao/compras-notas-credito/detalhes.php?nota='+dados.ID_Doc_Associado;
										label_doc_origem = '(Nota de Crédito de Compra)';
										break;
									case 'GR':
										link_doc_origem = '/gesfaturacao/guias-remessa/detalhes.php?guia='+dados.ID_Doc_Associado;
										label_doc_origem = '(Guia de Remessa)';
										break;
									case 'FC':
										link_doc_origem = '/gesfaturacao/faturas-consignacao/detalhes.php?fconsignacao='+dados.ID_Doc_Associado;
										label_doc_origem = '(Fatura de Consignação)';
										break;
									case 'GC':
										link_doc_origem = '/gesfaturacao/guias-consignacao/detalhes.php?guia='+dados.ID_Doc_Associado;
										label_doc_origem = '(Guia de Consignação)';
										break;
									case 'GD':
										link_doc_origem = '/gesfaturacao/guias-devolucao/detalhes.php?guia='+dados.ID_Doc_Associado;
										label_doc_origem = '(Guia de Devolução)';
										break;
									case 'GA':
										link_doc_origem = '/gesfaturacao/guias-ativos-proprios/detalhes.php?guia='+dados.ID_Doc_Associado;
										label_doc_origem = '(Guia de Movimentação de Ativos Próprios)';
										break;
								}

								var htmlDocAss = '<a href="'+link_doc_origem+'">'+dados.Ref_Doc_Associado+'&nbsp;'+label_doc_origem+'&nbsp;<i class="fa fa-eye"></i></a>';
								$('#documentoassociado_registo').html(htmlDocAss);
							}else $('#documentoassociado_registo').html('---');

							if(dados.DiferencaRegisto < 0){
								$('#diferenca_registo').addClass('text-red');
								$('#diferenca_registo').removeClass('text-green');
							}
							else {
								$('#diferenca_registo').addClass('text-green');
								$('#diferenca_registo').removeClass('text-red');
							}

							if(dados.AcertoStock){
								//fields acertos info
								$("#acerto_registo").html("Sim");
								$("#acerto_registo").addClass("text-orange");
								$("#dataacerto_registo").html(dados.DataAcertoStock);
								$("#dataacerto_registo").addClass("text-orange");
								$("#acertosWrapper").removeClass('hide');
								$("#stockposterior_registo").addClass("text-orange");

								//non used fields
								$('#stockanterior_registo').autoNumeric('set',0);
								$('#diferenca_registo').autoNumeric('set',0);
								$('#diferenca_registo').removeClass('text-green');
								$('#diferenca_registo').removeClass('text-red');
							}

							//init elements
							$(".qtd").autoNumeric("init", {
								aSep : '.',
								aDec : ',',
								aSign : '',
								pSign : 's',
								mDec : 3
							});
						}
					}
				}
			},
			complete : function() {
				$('#modal-registo-log').modal("show");
			}
		});
	}

	//ver recibo
	function infoRegisto(idArtigo, idRegisto){
		//get data to fill
		fill_registo_data(idArtigo, idRegisto);
	}
</script>