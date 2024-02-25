<script type="text/javascript">
	/**
	 * Fill the categories
	 * @return select list
	 */
	function fill_categories() {
		var options = $("select#categoria_artigo");
		$(options).empty();
		//get data
		$.ajax({
			type: 'POST',
			url: '/gesfaturacao/server/combobox/artigos.php',
			data: {
				opcao: 1
			},
			dataType: 'json',
			success: function (resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL001] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL002] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);
						} else {
							$(options).attr("disabled", false);
							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							var html_categorias = '';
							html_categorias += '<option value="0" selected>Sem Categoria</option>';

							var current_group = '';

							$.each(resposta.data, function () {
								html_categorias += '<option value="' + this.id + '">' + this.nome + '</option>';
							});

							$(options).html(html_categorias);
						}
					}
				}
			},
			complete: function () {
				$(options).val($("select#categoria_artigo option:eq(0)").val());
				$(options).selectpicker('refresh');
			}
		});
	}

	/**
	 * Fill the impostos
	 * @return select list
	 */
	function fill_impostos() {
		var options = $("select#imposto_artigo");
		$(options).empty();
		//get data
		$.ajax({
			type: 'POST',
			url: '/gesfaturacao/server/combobox/artigos.php',
			data: {
				opcao: 2
			},
			dataType: 'json',
			success: function (resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL001] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL002] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);
						} else {
							$(options).attr("disabled", false);
							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							let beginRegion = '';
							let indexGroup = 1;

							$.each(resposta.data, function () {
								if (beginRegion == '') {
									beginRegion = this.Regiao;
									$(options).append('<optgroup id="'+indexGroup+'_opt_ivas_1" label="'+this.RegiaoLabel+'"></optgroup>');
								} else if(beginRegion != this.Regiao) {
									beginRegion = this.Regiao;
									indexGroup++;
									$(options).append('<optgroup id="'+indexGroup+'_opt_ivas_1" label="'+this.RegiaoLabel+'"></optgroup>');
								}

								$("#"+indexGroup+"_opt_ivas_1").append($("<option />").val(this.id).html(this.nome + ': ' + this.taxa + '%').attr('data-taxa', this.taxa).attr('data-predef', this.predefinido));
							});
						}
					}
				}
			},
			complete: function () {
				// $(options).val($("select#imposto_artigo option:eq(1)").val());
				$(options).val($("select#imposto_artigo option[data-predef=1]").val());
				// $(options).selectpicker('refresh');

				//init select2
				$(options).select2({
					width: '100%',
					escapeMarkup: function (m) {
						return m;
					},
					language: "pt",
					placeholder: "Imposto",
					templateSelection: ivasTemplateLabel
				});
			}
		});
	}

	/**
	 * Fill the unidades
	 * @return select list
	 */
	function fill_unidades() {
		var options = $("select#unidade_artigo");
		$(options).empty();
		//get data
		$.ajax({
			type: 'POST',
			url: '/gesfaturacao/server/combobox/artigos.php',
			data: {
				opcao: 3
			},
			dataType: 'json',
			success: function (resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL001] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);

				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL002] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);

						} else {
							$(options).attr("disabled", false);

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));
							$.each(resposta.data, function () {
								$(options).append($("<option />").val(this.id).text(this.nome));
							});
						}
					}
				}
			},
			complete: function () {
				$(options).val($("select#unidade_artigo option:eq(1)").val());
				$(options).selectpicker('refresh');
			}
		});
	}

	/**
	 * Fill motivos
	 * @return select list
	 */
	function fill_motivos() {
		var options = $("select#motivo_isencao_artigo");
		var idPredefinido = 0;
		$(options).empty();
		//get data
		$.ajax({
			type: 'POST',
			url: '/gesfaturacao/server/combobox/artigos.php',
			data: {
				opcao: 4
			},
			dataType: 'json',
			success: function (resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL001] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL002] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);
						} else {
							$(options).attr("disabled", false);

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							$.each(resposta.data, function () {
								$descriptionSummary = '';
								/*if(this.Descricao.length > 20) descriptionSummary = this.Descricao.substr(0,20)+"...";
								else*/
								descriptionSummary = this.Descricao;
								$(options).append($("<option />").val(this.ID_Motivo).html('<small>' + this.Codigo + ': ' + descriptionSummary + '</small>'));
							});

							if (resposta.idPredefinido && resposta.idPredefinido > 0) idPredefinido = resposta.idPredefinido;
						}
					}
				}
			},
			complete: function () {
				if (idPredefinido > 0) $(options).attr("data-predefinido", idPredefinido);
				$(options).prop('disabled', true);
				$(options).selectpicker('refresh');

				//ensure that this field is active if Tax Is 0
				$("select#imposto_artigo").trigger('change');
			}
		});
	}

	/**
	 * Calculate Price
	 * @return price pvp value
	 */
	function calculaPreco() {
		var taxa = $('select#imposto_artigo option:selected').attr('data-taxa');
		taxa = Number((taxa * 0.01) + 1);
		var preco_pvp = Number($("#precoPVP_artigo").autoNumeric('get'));
		//calculate new
		var preco_final = (preco_pvp / taxa);
		$("#preco_artigo").autoNumeric('set', preco_final);
	}

	/**
	 * Calculate Price PVP
	 * @return price value
	 */
	function calculaPrecoPVP() {
		var taxa = $('select#imposto_artigo option:selected').attr('data-taxa');
		taxa = Number((taxa * 0.01) + 1);
		var preco = Number($("#preco_artigo").autoNumeric('get'));
		//calculate new
		var preco_final = (preco * taxa);
		$("#precoPVP_artigo").autoNumeric('set', preco_final);
	}

	/**
	 * get new EAN13BARCODE
	 * @return string BARCODE
	 */
	function generateBarcode(line) {
		$.ajax({
			url: "/gesfaturacao/server/artigos/gerar_codigo_barras",
			type: "GET",
			dataType : "json",
			success: function(response){
				if(response.errors === false){
					$("#codigobarras_artigo_" + line).val(response.codigoBarras);
				}
			},
		});
	}


	/**
	 * Function to add new line
	 * @return
	 */
	function new_line() {
		lastIdLine++;

		$.ajax({
			url: "/gesfaturacao/server/artigos/gerar_codigo_barras",
			type: "GET",
			dataType : "json",
			success: function(response){
				if(response.errors === false){
					var htmlLine = '<tr class="articles_lines" id="line_' + lastIdLine + '">' +
							'<td style="width:100px;">' +
							'<div class="input-group">' +
							'<input type="text" class="form-control codigobarras_artigo" id="codigobarras_artigo_' + lastIdLine + '" name="codigobarras_artigo[]" placeholder="123456" pattern="[0-9]+" value="' + response.codigoBarras + '" />' +
							'<span class="input-group-btn">' +
							'<button type="button" class="btn btn-orange special_inptgroup_btn" onclick="generateBarcode(' + lastIdLine + ')">' +
							'<i class="fa fa-refresh"></i>' +
							'</button>' +
							'</span>' +
							'</div>' +
							'</td>' +
							'<td style="width:30px; text-align: center;">' +
							'<a class="options-link text-red" onclick="eliminarLinha(' + lastIdLine + ')" title="Remover Linha"><i class="trashLineIcone fa fa-trash"></i></a>' +
							'</td>' +
							'</tr>';
					$('#tbody_codigos_barras').append(htmlLine);
					valorLinhas++;
				}
			},
		});
	}

	/**
	 * Delete Line
	 * @param  lineID
	 */
	function eliminarLinha(lineID) {
		valorLinhas--;
		$('#line_' + lineID).remove();
		$('#line_' + lineID + '_comment').remove();
	}


	/**
	 * Add Article PriceLine
	 */
	function addArticlePriceLine() {
		var parent = document.getElementById("tbody_prices");
		var lasIndex = parent.rows.length - 1;

		var lastIdPriceLine = 1;
		var lastElementID = parent.rows[lasIndex];

		if (lastElementID != undefined) {
			lastElementID = parent.rows[lasIndex].id;
			var lastID = lastElementID.split('_');
			lastIdPriceLine = parseInt(lastID[2]) + 1;

			if (Number.isNaN(lastIdPriceLine)) {
				lastIdPriceLine = 1;
				parent.innerHTML = '';
			}
		}

		var htmlLine = '<tr class="articles_prices_lines" id="price_line_' + lastIdPriceLine + '">' +
			'<td style="min-width:200px;">' +
			'<select data-id-line="' + lastIdPriceLine + '" class="lineInputImposto form-control select2 show-tick" data-live-search="true"  data-header="Selecione Imposto" id="iva_linha_' + lastIdPriceLine + '" name="iva_linha_' + lastIdPriceLine + '" >' +
			'<option value="" data-hidden="true">Imposto</option>' +
			'</select>' +
			'</td>' +
			'<td style="min-width:200px;">' +
			'<input type="text" data-id-line="' + lastIdPriceLine + '" class="lineInputPrecoPVP form-control moneyBig" id="precopvp_linha_' + lastIdPriceLine + '" name="precopvp_linha_' + lastIdPriceLine + '" placeholder="0,00 €" />' +
			'</td>' +
			'<td style="min-width:200px;">' +
			'<input type="text" data-id-line="' + lastIdPriceLine + '" class="lineInputPreco form-control moneyBig" id="preco_linha_' + lastIdPriceLine + '" name="preco_linha_' + lastIdPriceLine + '" placeholder="0,00 €" />' +
			'</td>' +
			'<td style="width:30px; text-align: center;">' +
			'<a class="options-link text-red" onclick="deletePriceLine(' + lastIdPriceLine + ')" title="Remover Linha"><i class="trashLineIcone fa fa-trash"></i></a>' +
			'</td>' +
			'</tr>';

		$('#tbody_prices').append(htmlLine);

		$(".moneyBig").autoNumeric("init", {
			aSep: '.',
			aDec: ',',
			aSign: ' €',
			pSign: 's',
			mDec: <?php echo $nDec; ?>,
			vMin: '0'
		});

		fill_ivas(lastIdPriceLine);

		$(".lineInputImposto").on('change', function (event) {
			calculaUN(lastIdPriceLine);
		});

		$(".lineInputPreco").on('keyup', function (event) {
			calculaPVPModal(lastIdPriceLine);
		});

		$(".lineInputPrecoPVP").on('keyup', function (event) {
			calculaUN(lastIdPriceLine);
		});
	}

	/**
	 * Calculate Price PVP
	 * @return price value
	 */
	function calculaPVPModal(lastIdPriceLine) {
		var taxa = $('select#iva_linha_' + lastIdPriceLine + ' option:selected').attr('data-valor');
		if (taxa) {
			taxa = Number((taxa * 0.01) + 1);

			var preco = Number($("#preco_linha_" + lastIdPriceLine).autoNumeric('get'));

			//calculate new
			var preco_final = (preco * taxa);
			$("#precopvp_linha_" + lastIdPriceLine).autoNumeric('set', preco_final);
		}
	}

	/**
	 * Calculate Price
	 * @return price pvp value
	 */
	function calculaUN(lastIdPriceLine) {
		var taxa = $('select#iva_linha_' + lastIdPriceLine + ' option:selected').attr('data-valor');
		if (taxa) {
			taxa = Number((taxa * 0.01) + 1);

			var preco_pvp = Number($("#precopvp_linha_" + lastIdPriceLine).autoNumeric('get'));

			//calculate new
			var preco_final = (preco_pvp / taxa);

			$("#preco_linha_" + lastIdPriceLine).autoNumeric('set', preco_final);
		}
	}

	/**
	 * Delete Price Line
	 * @param  rowPosition
	 * @return
	 */
	function deletePriceLine(rowPosition) {
		$('#price_line_' + rowPosition).remove();
	}

	/**
	 * Fill the ivas select
	 * @param  select id
	 * @return ivas
	 */
	function fill_ivas(lineID, impostoID = 0) {
		var options = $("select#iva_linha_" + lineID);
		$(options).empty();

		$.ajax({
			type: 'POST',
			url: '/gesfaturacao/server/combobox/artigos.php',
			dataType: 'json',
			data: {
				opcao: 6
			},
			success: function (resposta) {
				if (resposta == null) {
					$.scojs_message("[FAT9999] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[FAT9999] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);

						} else {
							$(options).attr("disabled", false);
							$(options).append($('<option data-hidden="true"/>').val("").text("Selecione Imposto"));

							let beginRegion = '';
							let indexGroup = 1;

							$.each(resposta.data, function () {
								if (beginRegion == '') {
									beginRegion = this.Regiao;
									$(options).append('<optgroup id="'+indexGroup+'_opt_ivas_ln_'+lineID+'" label="'+this.RegiaoLabel+'"></optgroup>');
								} else if(beginRegion != this.Regiao) {
									beginRegion = this.Regiao;
									indexGroup++;
									$(options).append('<optgroup id="'+indexGroup+'_opt_ivas_ln_'+lineID+'" label="'+this.RegiaoLabel+'"></optgroup>');
								}

								$("#"+indexGroup+"_opt_ivas_ln_"+lineID).append($("<option />").val(this.ID_Imposto).html(this.Nome + ': ' + this.Valor + '%').attr('data-subclasse', this.Subclasse).attr('data-valor', this.Valor));
							});
						}
					}
				}
			},
			complete: function () {
				if (impostoID != 0) $(options).val(impostoID);

				//init select2
				$(options).select2({
					width: '100%',
					escapeMarkup: function (m) {
						return m;
					},
					language: "pt",
					placeholder: "Imposto",
					templateSelection: ivasTemplateLabel
				});
			}
		});
	}

	/**
	 * Fill motivos
	 * @return select list
	 */
	function fill_alerta_stocks_min() {
		//get data
		$.ajax({
			type: 'POST',
			url: '/gesfaturacao/server/combobox/artigos.php',
			data: {
				opcao: 9
			},
			dataType: 'json',
			success: function (resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL001] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL002] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						<?php if ($_SESSION['id_plano_atual'] !== 1) { ?>
						if (resposta.data.alertaStockMinimo) $("input#alerta_stock_min").iCheck('check');
						else $("input#alerta_stock_min").iCheck('uncheck');
						<?php } else { ?>
							$("input#alerta_stock_min").iCheck('uncheck');
						<?php } ?>
					}
				}
			}
		});
	}
</script>
