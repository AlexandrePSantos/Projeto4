<script type="text/javascript">
	table = $('#table_id').dataTable({
		"dom" : '<lfrtip><"clear">',
		"sRowSelect" : "os",
		"sRowSelector" : 'td:first-child',
		"lengthMenu" : [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		"aaSorting" : [[0, "asc"]],
		"bProcessing" : true,
		"bServerSide" : true,
		"sAjaxSource" : "/gesfaturacao/server/datatable/artigos.php",
		"fnServerParams": function (aoData) {
			aoData.push(
				{
					"name": "categoria",
					"value": $("#categoria_filtro").val()
				}, {
					"name": "tipo",
					"value": $("#tipo_filtro").val()
				}, {
					"name": "iva",
					"value": $("#iva_filtro").val()
				}, {
					"name": "stock_minimo",
					"value": $("#stock_minimo_filtro").val()
				}, {
					"name": "stock_maximo",
					"value": $("#stock_maximo_filtro").val()
				});
		},
		"oLanguage" : {
			"sLengthMenu" : "Mostrar _MENU_ registos por página",
			"sZeroRecords" : "Nenhum Registo",
			"sInfo" : "_START_ a _END_ de _TOTAL_ registos",
			"sInfoEmpty" : " 0 a 0 de 0 registos",
			"sProcessing" : "<div></div>",
			"sInfoFiltered" : "",
			"oPaginate" : {
				"sNext" : "Próxima",
				"sFirst" : "Primeira",
				"sPrevious" : "Anterior",
				"sLast" : "Última"
			}
		},
		"aoColumns" : [
			null, null, null, null,
			{
				"sClass" : "text-right",
			},
			{
				"sClass" : "text-right",
			},
			{
				"sClass" : "text-right",
				<?php if ($_SESSION['id_plano_atual'] == 1) { ?> "bVisible" : false <?php } ?>
			},
			{
				"sClass" : "text-center",
			},
			{
				"bVisible" : true,
				"bSortable" : false,
				"bSearchable" : false,
				"sClass" : "text-center",
			},
			{
				"bVisible" : false,
				"bSortable" : false,
				"bSearchable" : false,
			},
			{
				"bVisible" : false,
				"bSortable" : false,
				"bSearchable" : false,
			},
			{
				"bVisible" : false,
				"bSortable" : false,
				"bSearchable" : true,
			},
			{
				"bVisible" : false,
				"bSortable" : false,
				"bSearchable" : true,
			},
			{
				"bVisible" : false,
				"bSortable" : false,
				"bSearchable" : true,
			}
		],
		"aoColumnDefs" : [
		{
			"aTargets" : [1],
			"mRender" : function(data, type, full) {
				//return html
				return '<span class="ellipsis" data-size="35">'+full[1]+'</span>';
			}
		},
		{
			"aTargets" : [2],
			"mRender" : function(data, type, full) {
				var element = '';
				if(full[2] == null) element = 'Sem categoria';
				else element = full[2];

				//return html
				return '<span class="ellipsis" data-size="20">'+element+'</span>';
			}
		},
		{
			"aTargets" : [4],
			"mRender" : function(data, type, full) {
				var element = '';
				element ='<span class="money">'+full[4]+'</span>';

				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's'
				});

				//return html
				return element;
			}
		},
		{
			"aTargets" : [5],
			"mRender" : function(data, type, full) {
				var element = '';
				element ='<span class="percentage">'+full[5]+'</span>';

				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});
				//return html
				return element;
			}
		},
		{
			"aTargets" : [6],
			"mRender" : function(data, type, full) {
				var element = '-';
				if(full[3]!="Serviços" && full[12] != 1){
					element ='<span class="qtd">'+full[6]+'</span>';

					//init elements
					$(".qtd").autoNumeric("init", {
						aSep : '.',
						aDec : ',',
						aSign : '',
						pSign : 's',
						mDec : 3
					});
				}

				//return html
				return element;
			}
		},
		{
			"aTargets" : [8],
			"mRender" : function(data, type, full) {
				var processedName = full[1].replace(/'/gi, " "); processedName = processedName.replace(/"/gi, " ");
				var nome = "'" + processedName + "'";
				var html = '';

				//show details
				html += '<a href="detalhes?artigo=' + full[8] + '" class="options-link text-info"><i class="fa fa-eye" title="Ver"></i></a>';

				//edition options
				html += '<a href="editar?artigo=' + full[8] + '" class="options-link text-orange"><i class="fa fa-edit" title="Editar"></i></a>';

				//state options
				if(full[9] == 1){
					html += '<a onClick="alterState('+full[8]+')" class="options-link text-violet" title="Desativar"><i class="fa fa-ban"></i></a>';
				}else{
					html += '<a onClick="alterState('+full[8]+')" class="options-link text-green" title="Ativar"><i class="fa fa-check-square"></i></a>';
				}

				if( full[10] > 0 ){
					html += '<span class="text-gray" style="margin: 4px;"><i class="fa fa-trash"></i></span>';
				}else{
					html += '<a class="options-link text-red" onclick="eliminarArtigo('+ full[8] +', '+nome+')" title="Remover"><i class="fa fa-trash"></i></a>';
				}

				//return all html composed
				return html;
			}
		}],

		"fnRowCallback" : function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			$(nRow).attr("dbID", aData[8]);

			return nRow;
		},
		"fnDrawCallback" : function(oSettings) {
			$(".ellipsis").ellipsis();
		},
	});

	$('#table_id').on('click', 'tbody td:not(.dataTables_empty)', function() {
		$('#table_id tbody tr').removeClass('selected');
		$(this).parent('tr').removeClass('DTTT_selected');
		$(this).parent('tr').addClass('selected');
	});

	$('#table_id_filter input').unbind();

	$('#table_id_filter').html('<label><div class="input-group input-group-sm mbs"><input type="search" class="form-control input-sm" placeholder="" aria-controls="table_id"><span class="input-group-btn"><button type="button" data-toggle="dropdown" class="btn btn-yellow dropdown-toggle" onclick="pesquisar()"><i class="fa fa-search"></i> Pesquisar</button></span></div></label>');

	$('#table_id_filter input').bind('keyup', function(e) {
		if (e.keyCode == 13) {
			table.fnFilter(this.value);
		}
	});

	function pesquisar() {
		table.fnFilter($('#table_id_filter input').val());
	}

	$('#table_id_filter input').bind('keyup', function(e) {
		if (($(this).val().length) == 0) {
			table.fnFilter('');
		}
	});

	function fnGetSelected(tabela) {
		var aReturn = new Array();
		var aTrs = tabela.fnGetNodes();
		for (var i = 0; i < aTrs.length; i++) {
			if ($(aTrs[i]).hasClass('row_selected')) {
				aReturn.push(aTrs[i]);
			}
		}
		return aReturn;
	}

	//END OF TABLE ---------------------------------------------

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
				// location.reload();
				pesquisar();
			}
		});
	}

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
						table.fnReloadAjax();
					}
				}
			});
		} else { return false; }
	}

	/**
	 * Fill the impostos
	 * @return select list
	 */
	function fill_impostos() {
		var options = $("select#iva_filtro");
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

							$(options).append($('<option/>').val("").text("Selecionar opção").attr('selected','selected'));

							$.each(resposta.data, function () {
								$(options).append($("<option />").val(this.id).html(this.nome).attr('data-taxa', this.taxa));
							});
						}
					}
				}
			},
			complete: function () {
				// $(options).val($("select#imposto_artigo option:eq(1)").val());
				$(options).val($("select#iva_filtro option[data-predef=1]").val());
				$(options).selectpicker('refresh');
			}
		});
	}

	/**
	 * Fill the categories
	 * @return select list
	 */
	function fill_categories() {
		var options = $("select#categoria_filtro");
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

							$(options).append($('<option/>').val("").text("Selecionar opção"));
							$(options).append($('<option/>').val("0").text("Sem Categoria"));

							/*var html_categorias = '';
							html_categorias += '<option value="0" selected>Sem Categoria</option>';

							var current_group = '';

							$.each(resposta.data, function () {
								html_categorias += '<option value="' + this.id + '">' + this.nome + '</option>';
							});*/

							$.each(resposta.data, function () {
								$(options).append($("<option />").val(this.id).html(this.nome));
							});

							//$(options).html(html_categorias);
						}
					}
				}
			},
			complete: function () {
				$(options).val($("select#categoria_filtro option:eq(0)").val());
				$(options).selectpicker('refresh');
			}
		});
	}

	function pesquisar_detalhe() {
		table.api().ajax.reload();
	}
</script>
