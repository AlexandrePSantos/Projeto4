<script type="text/javascript">
	//load data
	function fill_cliente(idCliente) {
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/clientes/detalhes.php',
			dataType : 'json',
			data : { idCliente : idCliente },
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[FAT001] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[FAT002] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$.scojs_message("[FAT003] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
						} else {
							var dados = resposta.data;
							var nome = "'"+dados.Nome+"'";

							// block fields for user 1
							if(dados.ID_Cliente == 1){
								$("#codigo_interno_cliente").prop('disabled', true);
							}

							//process used or not used
							if(dados.Usado > 0){
								/*$("#nome_cliente").prop('disabled', true);
								$("#nif_cliente").prop('disabled', true);
								$("#pais_cliente").prop('disabled', true);*/
								$("#contaCorrente_cliente").html(dados.Account);
								$('#contaCorrenteWrapper').hide();
							}

							if( dados.Pais != 'PT' ){
								$('.nif_field').unmask();
							}

							//remain fields
							$("#pais_cliente").val(dados.Pais);
							$('#pais_cliente').trigger("change");
							$("#nome_cliente").val(dados.Nome);
							$("#nif_cliente").val(dados.Nif);
							$("#codigo_cliente").val(dados.Codigo);
							$("#codigo_interno_cliente").val(dados.CodigoInterno);
							$("#endereco_cliente").val(dados.Endereco);
							$("#codigopostal_cliente").val(dados.CodigoPostal);
							$("#localidade_cliente").val(dados.Localidade);
							$("#email_cliente").val(dados.Email);
							$("#website_cliente").val(dados.Website);
							$("#tlm_cliente").val(dados.Telemovel);
							$("#tlf_cliente").val(dados.Telefone);
							$("#fax_cliente").val(dados.Fax);
							$("#preferencial_nome_cliente").val(dados.PreferenciaNome);
							$("#preferencial_email_cliente").val(dados.PreferenciaEmail);
							$("#preferencial_tlm_cliente").val(dados.PreferenciaTelemovel);
							$("#preferencial_tlf_cliente").val(dados.PreferenciaTelefone);
							$("#fitofarmaceuticos_cliente").val(dados.NumAtividadeFitoFarmac);
							$("#observacoes_cliente").val(dados.Observacoes);

							if(dados.ContaGeral == 1) { $('#conta_geral_cliente').iCheck('check'); flagContaGeral = 1; }
							else { $('#conta_propria_cliente').iCheck('check'); flagContaGeral = 0; }

							$("#desconto_cliente").autoNumeric('set', dados.Desconto);

							//remake money
							$(".percentage").autoNumeric("init", {
								aSep : '.',
								aDec : ',',
								aSign : '  %',
								vMax : '100',
								mDec : 2,
								vMin:'0',
								pSign : 's'
							});

							if( dados.Pais != 'PT' ){
								changeAddressFieldsByLanguage();
								$("#regiao_cliente_estrang").val(dados.Regiao);
								$("#cidade_cliente_estrang").val(dados.Cidade);
								fill_regions();
								fill_cities();
							}else{
								fill_regions(dados.RegiaoID);
								fill_cities(dados.RegiaoID, dados.CidadeID);
							}
							// fill_groups(dados.GrupoID);
							fill_metodos(dados.MetodoID);
							$('#vencimento_Cliente').val(dados.Vencimento);
							$('#vencimento_Cliente').trigger("change");

							if(dados.IsencaoIVA == 1) $('#isento_iva').iCheck('check');
							fill_motivos(dados.MotivoIsencao);
						}
					}
				}
			},
			complete : function() {
			}
		});
	}

	/**
	 * Fill up regions
	 * @return select
	 */
	function fill_regions(lastID = 0){
		var options = $("select#regiao_cliente");
		$(options).empty();
		//get data
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/combobox/clientes.php',
			data : {
				opcao: 1
			},
			dataType : 'json',
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL007] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);

				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL008] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);

						} else {
							$(options).attr("disabled", false);

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							$(options).append($("<option />").val(0).text('Sem Distrito'));
							$.each(resposta.data, function() {
								$(options).append($("<option />").val(this.id).text(this.nome));

							});
						}
					}
				}
			},
			complete : function() {
				if(lastID != 0) $(options).val(lastID);
				else $(options).val(0); //viana do castelo district

				$("select#regiao_cliente").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});
			}
		});
	}

	/**
	 * Fill up cities based on the region
	 * @param city
	 * @return select
	 */
	function fill_cities(region, lastID = 0){
		var options = $("select#cidade_cliente");
		$(options).empty();
		$(options).select2('destroy');
		//get data
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/combobox/clientes.php',
			data : {
				opcao: 2,
				regiao: region
			},
			dataType : 'json',
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL007] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);

				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL008] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);

						} else {
							$(options).attr("disabled", false);

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							$(options).append($("<option />").val(0).text('Sem Cidade'));
							$.each(resposta.data, function() {
								$(options).append($("<option />").val(this.id).text(this.nome));

							});
						}
					}
				}
			},
			complete : function() {
				if(lastID != 0) $(options).val(lastID);
				else $(options).val( $("select#cidade_cliente option:eq(1)").val() );

				$("select#cidade_cliente").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});

				// $(options).trigger("change");
			}
		});
	}

	/**
	 * Fill up groups
	 * @return select
	 */
	function fill_groups(lastID = 0){
		var id_predefinido = 0;
		var options = $("select#grupo_cliente");
		$(options).empty();
		//get data
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/combobox/clientes.php',
			data : {
				opcao: 3
			},
			dataType : 'json',
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[SEL007] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);

				} else {
					if (resposta.errors == true) {
						$.scojs_message("[SEL008] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);

						} else {
							$(options).attr("disabled", false);

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							$(options).append($("<option />").val(0).text('Sem Grupo'));
							$.each(resposta.data, function() {
								if(this.predefinido == 1) id_predefinido = this.id;
								$(options).append($("<option />").val(this.id).text(this.nome));

							});
						}
					}
				}
			},
			complete : function() {
				if(lastID != 0) $(options).val(lastID);
				else $(options).val(id_predefinido);
				$(options).trigger("change");
			}
		});
	}

	/**
	 * Fill metodos de pagamento
	 * @param  {Number} lastID [description]
	 * @return {[type]}		[description]
	 */
	function fill_metodos(lastID = 0) {
		console.log(lastID);
		var options = $("select#pagamento_cliente");
		$(options).empty();
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/combobox/clientes.php',
			dataType : 'json',
			data : {
				opcao: 4
			},
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[FAT9999] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[FAT9999] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);

						} else {
							$(options).attr("disabled", false);

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							$(options).append($("<option />").val('-').text('Método Padrão'));
							$.each(resposta.data, function() {
								$(options).append($("<option />").val(this.ID).html(this.Codigo+" - "+this.Descricao));

							});
						}
					}
				}
			},
			complete : function() {
				if(lastID != 0) $(options).val(lastID);
				else $(options).val($("select#pagamento_cliente option:eq(1)").val());
				$(options).trigger("change");
			}
		});
	}

	/**
	 * Fill the motivos isenção select
	 * @param  select id
	 * @return motivos isenção
	 */
	function fill_motivos(motivoID = 0){
		var options = $("select#motivo_isencao_iva");
		$(options).empty();
		var id_predefinido = 0;
		var defaultID = 0;
		var isento = 0;

		//get data
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/combobox/clientes.php',
			dataType : 'json',
			data : {
				opcao: 5
			},
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[FAT9999] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[FAT9999] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$(options).attr("disabled", true);

						} else {
							$(options).attr("disabled", false);

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecione Motivo"));

							$(options).append($("<option />").val(0).text('Sem Motivo'));

							$.each(resposta.data, function() {
								var descriptionSummary = '';
								descriptionSummary = this.Descricao;
								$(options).append( $("<option />").val(this.ID_Motivo).html('<small>'+this.Codigo+': '+descriptionSummary+'</small>') );
							});
						}
					}
				}
			},
			complete : function() {
				if(motivoID != 0) $(options).val(motivoID);
				else $(options).val($("select#motivo_isencao_iva option:eq(1)").val());

				//change select2
				$(options).trigger('change');
			}
		});
	}

	/**
	 * Get Details Nif
	 * @return data if available
	 */
	function get_nif_details(){
		//close all error messages
		$('#close-message').trigger('click');

		//get data
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/webservices_vies_nif/detalhes_nif.php',
			dataType : 'json',
			data : {
				isoCountry: $("#pais_cliente").val(),
				vatNumber: $("#nif_cliente").val(),
			},
			success : function(resposta) {
				if (resposta == null) {
					$.scojs_message("[INFO001] Não foi possível obter dados para o contribuinte indicado.", $.scojs_message.TYPE_INFO);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[FAT999A] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$.scojs_message("[INFO002] Não foi possível obter dados para o contribuinte indicado.", $.scojs_message.TYPE_INFO);
						} else {
							var dados = resposta.data;
							// Process data
							$("#nome_cliente").val(dados.full_name);
							$("#endereco_cliente").val(dados.address);
							$("#codigopostal_cliente").val(dados.postalcode);

							if($("#pais_cliente").val() != 'PT'){
								// $("#regiao_cliente_estrang").val(dados.city);
								$("#cidade_cliente_estrang").val(dados.city);
							}else{
								// $("#regiao_cliente").val(dados.regionID);
								// $("#regiao_cliente").trigger("change");

								// $("#cidade_cliente").val(dados.cityID);
								// $("#cidade_cliente").trigger("change");

								if(dados.localeID) $("#localidade_cliente").val(dados.locale);
								else $("#localidade_cliente").val(dados.city);

								fill_regions( dados.regionID );
								fill_cities( dados.regionID, dados.cityID );
							}
						}
					}
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log(jqXHR.status, errorThrown);
				if(jqXHR && jqXHR.responseJSON && jqXHR.responseJSON.errors == true){
					if(jqXHR.responseJSON.required_fields){
						$.scojs_message("[REQ0001] Por favor indique um país e um contribuinte.", $.scojs_message.TYPE_ERROR);
					}else if(jqXHR.responseJSON.invalid_nif){
						$.scojs_message("[INFO002] Não foi possível obter dados para o contribuinte indicado. Por favor verifique se o contribuinte é válido e se pertence a uma entidade empresarial.", $.scojs_message.TYPE_INFO);
					}else{
						$.scojs_message("[FAT999B] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
					}

				}else{
					$.scojs_message("[FAT999C] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
				}
			},
			complete : function() { }
		});
	}
</script>
