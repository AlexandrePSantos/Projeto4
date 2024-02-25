<script type="text/javascript">
	/**
	 * Fill clientes
	 * @return {[type]}		[description]
	 */
	function fill_clientes() {
		var lastID = 0; var blockResume = false; var dadosObj = null;
		var options = $("select#cliente_mapa");
		// $(options).empty();

		$(".fullscreen").show();

		//prepare select
		$(options).attr("disabled", false);

		if(lastID != 0) $(options).append($("<option />").val(lastID).html(dadosObj).attr('selected', 'selected'));

		//init select2
		$('#cliente_mapa').select2({
			escapeMarkup: function(m) { return m; },
			language: "pt",
			placeholder: "-- Cliente --",
			allowClear: true,
			// minimumInputLength: 2,
			templateResult: clientesTemplate,
			templateSelection: clientesTemplateLabel,
			ajax: {
				global: false,
				type : "POST",
				url : '/gesfaturacao/server/combobox/mapas.php',
				dataType : "json",
				delay : 250,
				data: function (params) {
					return {
						opcao: 5, //search term
						search_term: params.term, //search term
						page: params.page || 1 // page number
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results:$.map(data.results,function(val,i){
							var textLabel = val.Nome+" - "+val.Nif;
							return{id:val.ID_Cliente,text:textLabel,data:val};
						}), //data.results,
						pagination: {
							more: (params.page * 10) < data.count_filtered
						}
					};
				}
			}
		});

		$(".fullscreen").fadeOut();
	}

	/**
	 * Fill series
	 * @return select2
	 */

	function fill_series() {
		var options = $("select#serie_filtro");
		$(".fullscreen").show();
		(options).attr("disabled", false);

		//init select2
		$('#serie_filtro').select2({
			escapeMarkup: function(m) { return m; },
			language: "pt",
			placeholder: "-- Series --",
			allowClear: true,
			// minimumInputLength: 2,
			/*templateResult: categoriesTemplate,
			templateSelection: categoriesTemplateLabel,*/
			ajax: {
				global: false,
				type : "POST",
				url : '/gesfaturacao/server/combobox/mapas.php',
				dataType : "json",
				delay : 250,
				data: function (params) {
					return {
						opcao: 9, //search term
						search_term: params.term, //search term
						page: params.page || 1 // page number
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results:$.map(data.results,function(val,i){
							var textLabel = val.Nome;
							return{id:val.ID_Serie,text:textLabel,data:val};
						}), //data.results,
						pagination: {
							more: (params.page * 10) < data.count_filtered
						}
					};
				}
			}
		});

		$(".fullscreen").fadeOut();
	}

	/**
	 * Fill tipos documentos (vendas)
	 * @return description
	 */
	function fill_tipos_docs_cliente() {
		var options = $("select#tiposdocumento_filtro");
		$(options).empty();

		//fill options
		$(options).append($("<option />").val("FT").html("Fatura Normal"));
		$(options).append($("<option />").val("FS").html("Fatura Simplificada"));
		$(options).append($("<option />").val("FR").html("Fatura Recibo"));
		$(options).append($("<option />").val("NC").html("Nota de Crédito"));
		$(options).append($("<option />").val("ND").html("Nota de Débito"));

		//INIT
		$('#tiposdocumento_filtro').select2({
			escapeMarkup: function(m) { return m; },
			language: "pt",
			placeholder: "-- Tipo do Documento --",
			allowClear: true,
		});
		$('#tiposdocumento_filtro').val(0);
		$('#tiposdocumento_filtro').trigger('change');
	}

	/**
	 * Fill estados documentos (vendas)
	 * @return description
	 */
	function fill_estados_docs_cliente() {
		var options = $("select#estado_filtro");
		$(options).empty();

		//fill options
		$(options).append($("<option />").val("Aberto").html("Aberto"));
		$(options).append($("<option />").val("Pago").html("Pago"));
		$(options).append($("<option />").val("Anulado").html("Anulado"));

		//INIT
		$('#estado_filtro').select2({
			escapeMarkup: function(m) { return m; },
			language: "pt",
			placeholder: "-- Estado do Documento --",
			allowClear: true,
		});
		$('#estado_filtro').val(0);
		$('#estado_filtro').trigger('change');
	}

	/**
	 * Init the lines listners
	 * @return none
	 */
	function linesListenersInit(){
		//init elements
		$(".money").autoNumeric("init", {
			aSep : '.',
			aDec : ',',
			aSign : ' €',
			pSign : 's',
			vMin:'0'
		});
		$(".moneyBig").autoNumeric("init", {
			aSep : '.',
			aDec : ',',
			aSign : ' €',
			pSign : 's',
			mDec : 3,
			vMin:'0'
		});
		//init elements
		$(".qtd").autoNumeric("init", {
			aSep : '.',
			aDec : ',',
			aSign : '',
			pSign : 's',
			mDec : 3,
			vMin:'0'
		});
		//init elements
		$(".percentage").autoNumeric("init", {
			aSep : '.',
			aDec : ',',
			aSign : '%',
			vMax : '100',
			pSign : 's',
			mDec : 2,
			vMin:'0'
		});
	}

	/* OLD SCRIPTS */
	/*
	function fill_clientes() {
		var options = $("select#cliente_mapa");
		$(options).empty();
		$.ajax({
			type : 'POST',
			url : '/gesfaturacao/server/combobox/mapas.php',
			dataType : 'json',
			data : {
				opcao: 2
			},
			success : function(resposta) {
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

							$(options).append($('<option data-hidden="true"/>').val("").text("Selecionar opção"));

							$.each(resposta.data, function() {
								$(options).append($("<option />").val(this.ID_Cliente).html(this.Nome+" - "+this.Nif));

							});
						}
					}
				}
			},
			complete : function() {
				$(options).val();
				$(options).selectpicker('refresh');
			}
		});
	}
	*/

	/**
	 * Fill Utilizadores
	 */
	function fill_utilizadores() {
		var lastID = 0; var blockResume = false; var dadosObj = null;
		var options = $("select#utilizador_mapa");
		// $(options).empty();

		$(".fullscreen").show();

		//prepare select
		$(options).attr("disabled", false);

		if(lastID != 0) $(options).append($("<option />").val(lastID).html(dadosObj).attr('selected', 'selected'));

		//init select2
		$('#utilizador_mapa').select2({
			escapeMarkup: function(m) { return m; },
			language: "pt",
			placeholder: "-- Utilizador --",
			allowClear: true,
			// minimumInputLength: 2,
			templateResult: utilizadoresTemplate,
			templateSelection: utilizadoresTemplateLabel,
			ajax: {
				global: false,
				type : "POST",
				url : '/gesfaturacao/server/combobox/mapas.php',
				dataType : "json",
				delay : 250,
				data: function (params) {
					return {
						opcao: 7, //search term
						search_term: params.term, //search term
						page: params.page || 1 // page number
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results:$.map(data.results,function(val,i){
							var textLabel = val.nome;
							return{id:val.id_utilizador,text:textLabel,data:val};
						}), //data.results,
						pagination: {
							more: (params.page * 10) < data.count_filtered
						}
					};
				}
			}
		});

		$(".fullscreen").fadeOut();
	}
</script>
