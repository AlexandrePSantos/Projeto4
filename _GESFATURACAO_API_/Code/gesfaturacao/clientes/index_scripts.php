<script type="text/javascript">
	table = $('#table_id').dataTable({
		"dom" : '<lfrtip><"clear">',
		"sRowSelect" : "os",
		"sRowSelector" : 'td:first-child',
		"lengthMenu" : [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		"aaSorting" : [[0, "asc"]],
		"bProcessing" : true,
		"bServerSide" : true,
		"sAjaxSource" : "/gesfaturacao/server/datatable/clientes.php",
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
		"aoColumns" : [null, null, null, null, null, null,
		{
			"bVisible" : false,
		}, null,{
			"bVisible" : false,
		},
		{
			"bVisible" : true,
			"bSortable" : false,
			"bSearchable" : false,
			"sClass" : "text-center",
		},{
			"bVisible" : false,
			"bSortable" : false,
			"bSearchable" : false,
		}],
		"aoColumnDefs" : [
		{
			"aTargets" : [2],
			"mRender" : function(data, type, full) {
				//return html
				return '<span class="ellipsis" data-size="30">'+full[2]+'</span>';
			}
		},
		{
			"aTargets" : [5],
			"mRender" : function(data, type, full) {
				//return html
				return '<span class="ellipsis" data-size="28">'+full[5]+'</span>';
			}
		},
		{
			"aTargets" : [6],
			"mRender" : function(data, type, full) {
				var element = '';
				if(full[6] != null){
					if(full[6].length > 30) element = full[6].substr(0,30)+"...";
					else element = full[6];
				}else{
					element = 'Sem grupo';
				}
				//return html
				return element;
			}
		},
		{
			"aTargets" : [7],
			"mRender" : function(data, type, full) {
				//return html
				return '<span class="ellipsis" data-size="26">'+full[7]+'</span>';
			}
		},
		{
			"aTargets" : [9],
			"mRender" : function(data, type, full) {
				var processedName = full[2].replace(/'/gi, " "); processedName = processedName.replace(/"/gi, " ");
				var nome = "'" + processedName + "'";
				var html = '';

				html += '<a href="detalhes.php?cliente='+ full[9] +'" class="options-link text-info"><i class="fa fa-eye" title="Detalhes"></i></a>';

				if(full[9] > 1){
					//edition options
					if( full[9] != 1 ){
						html += '<a href="editar.php?cliente='+full[9]+'" class="options-link text-orange"><i class="fa fa-edit" title="Editar"></i></a>';
					}else{
						html += '<span class="text-gray" style="margin: 4px;"><i class="fa fa-edit"></i></span>';
					}

					//active options
					if( full[11] == 1 ){
						html += '<a onclick="alterarEstadoCliente('+ full[9] +', '+nome+')" class="options-link text-violet"><i class="fa fa-ban" title="Desativar"></i></a>';
					}else{
						html += '<a onclick="alterarEstadoCliente('+ full[9] +', '+nome+')" class="options-link text-success"><i class="fa fa-check" title="Ativar"></i></a>';
					}

					//remove options
					if( full[10] > 0 ){
						html += '<span class="text-gray" style="margin: 4px;"><i class="fa fa-trash"></i></span>';
					}else{
						html += '<a class="options-link text-red" onclick="eliminarCliente('+ full[9] +', '+nome+')" title="Remover"><i class="fa fa-trash"></i></a>';
					}
				}

				//return all html composed
				return html;
			}
		}],

		"fnRowCallback" : function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			$(nRow).attr("dbID", aData[9]);

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

	//alterar estado
	function alterarEstadoCliente(idCliente, nome){
		if (confirm("Tem a certeza que pretende alterar o estado do cliente \n'" + nome + "' ?") == true) {
			$.ajax({
				type : 'POST',
				url : '/gesfaturacao/server/clientes/alterar_estado.php',
				dataType : 'json',
				data : {
					idCliente : idCliente
				},
				success : function(resposta) {
					var resp = resposta;
					if (resposta == null)
						$.scojs_message("[FAT001] Não é possivel alterar o estado deste cliente. Contacte o administrador.", $.scojs_message.TYPE_ERROR);
					else {
						if (resposta.errors) {
							$.scojs_message("[FAT002] Não é possivel alterar o estado deste cliente. Contacte o administrador.", $.scojs_message.TYPE_ERROR);
						} else {
							$.scojs_message("Cliente alterado com sucesso.", $.scojs_message.TYPE_OK);
						}
					}
				},
				complete : function(resposta) {
					//reload
					// setTimeout(function() {
					// 	location.reload();
					// }, 1000);
					pesquisar();
				}
			});
		} else { return false; }
	}

	//remover
	function eliminarCliente(idCliente, nome){
		if (confirm("Tem a certeza que pretende remover o cliente \n'" + nome + "' ?") == true) {
			$.ajax({
				type : 'POST',
				url : '/gesfaturacao/server/clientes/apagar.php',
				dataType : 'json',
				data : {
					idCliente : idCliente
				},
				success : function(resposta) {
					var resp = resposta;
					if (resposta == null)
						$.scojs_message("[FAT001] Não é possivel remover este cliente. Contacte o administrador.", $.scojs_message.TYPE_ERROR);
					else {
						if (resposta.errors) {
							$.scojs_message("[FAT002] Não é possivel remover este cliente. Contacte o administrador.", $.scojs_message.TYPE_ERROR);
						} else {
							$.scojs_message("Cliente removido com sucesso.", $.scojs_message.TYPE_OK);
						}
					}
				},
				complete : function(resposta) {
					//reload
					// setTimeout(function() {
					// 	location.reload();
					// }, 1000);
					pesquisar();
				}
			});
		} else { return false; }
	}
</script>
