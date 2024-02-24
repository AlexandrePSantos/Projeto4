$(document).ready(function() {
	if (document.getElementById("tableHome")) {
		var datatable = $('#tableHome').dataTable({
			"language": {
				"lengthMenu": "_MENU_"
			},
			"ajax": {
				"url": "/api/minhas_habitacoes",
				"dataSrc": ""
			},
			columns: [
				{ data: 'portaria' },
				{ data: 'tipo' },
				{ data: 'nome' },
				{ data: null,
						render: function (data, type, row) {
							return '<div class="btn-group dropdown">' +
							'<a class="btn btn-xs btn-warning btn-raised" href="editarHabitacao/' + data.id +'">Editar</a>' +
							'<button class="btn btn-xs btn-warning btn-raised dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>' +
							'<ul class="dropdown-menu" role="menu">' +
								'<li><a href="pagamentos/' + data.id +'">Ver Pagamentos</a></li>' +
							'</ul>' +
						'</div>';
					} 
				}
			]
		});
		
		$('.dataTables_filter input').attr('placeholder','Procurar...');
	
	
		//DOM Manipulation to move datatable elements integrate to panel
		$('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
		$('.panel-ctrls').append("<i class='separator'></i>");
		$('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
	
		$('.panel-footer').append($(".dataTable+.row"));
		$('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
	} else if (document.getElementById("formNovaHabitacao")) {
		$('#tipoHabitacoes').on('change', function() {
			if (this.value == "outro") {
				bootbox.prompt("Digite o novo tipo de habitação.", function(result) {
					if (result === null) {
						$("#tipoHabitacoes").val($("#tipoHabitacoes option:first").val());
					} else {
						var data = {};
						data.novaHabitacao = result;
						data._method = 'POST';
						$.ajax({
							url: "/api/novaHabitacao",
							type:"POST",
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							data: {
								'novaHabitacao': result
							},
							success:function(response){
								$("#tipoHabitacoes option[value='outro']").remove();
								$("#tipoHabitacoes").append(new Option(result, response));
								$("#tipoHabitacoes").val($("#tipoHabitacoes option:last").val());
								$("#tipoHabitacoes").append(new Option("Outro", "outro"));
							},
							error: function(error) {
								console.log(error);
							}
						 });
					}
				});
			}
		});

		$("#cc").on("input", function() {           
			var value = $(this).val();
            if (value.length == 8) {

				new PNotify({
					title: 'Informação',
					text: 'A procurar um utilizador com o cartão de cidadão ' + value + '.',
					type: 'info',
					icon: 'ti ti-close',
					styling: 'fontawesome'
				});

				axios.get('/api/proprietario/' + value)
				.then((response) => {
					if (response.data[0]) {
						new PNotify({
							title: 'Informação',
							text: 'O utilizador for encontrado e os dados foram preenchidos.',
							type: 'success',
							icon: 'ti ti-close',
							styling: 'fontawesome'
						});

						$("#nome").val(response.data[0].nome);
						$("#email").val(response.data[0].email);
						$("#telefone").val(response.data[0].telefone);

						$('#nome').prop("readonly", true);
						$("#email").prop("readonly", true);
						$("#telefone").prop("readonly", true);
					} else {
						new PNotify({
							title: 'Informação',
							text: 'Não foi encontrado nenhum utilizador terá de o preencher manualmente.',
							type: 'notice',
							icon: 'ti ti-close',
							styling: 'fontawesome'
						});

						$("#nome").val("");
						$("#email").val("");
						$("#telefone").val("");

						$('#nome').prop("readonly", false);
						$("#email").prop("readonly", false);
						$("#telefone").prop("readonly", false);
					}
				})
				.catch((error) => {
					new PNotify({
						title: 'Oops!',
						text: 'Ocorreu um erro por favor tente mais tarde.',
						type: 'error',
						icon: 'ti ti-close',
						styling: 'fontawesome'
					});
				});
			}
		});
	} else if (document.getElementById("tabelaProprietarios")) {
		var datatable = $('#tabelaProprietarios').dataTable({
			"language": {
				"lengthMenu": "_MENU_"
			},
			"ajax": {
				"url": "/api/meus_proprietarios",
				"dataSrc": ""
			},
			columns: [
				{ data: 'nome' },
				{ data: 'habitacoes' },
				{ data: null,
						render: function (data, type, row) {
							$(".resumo").unbind().click(function(){ 
								var id = $(this).data("id");
								axios.get('/api/habitacoes_users/' + id)
								.then((response) => {
									if (response.data[0]) {
										bootbox.hideAll();
										var fullString = "<hr>";
										for (let i = 0; i < response.data.length; i++) {
											fullString += "<b>Habitação:</b> " + response.data[i].portaria + "<br><b>Tipo de Habitação:</b> " + response.data[i].tipo + "<br><b>Pagamentos:</b> <a href='/pagamentos/" + response.data[i].id + "'>Clique Aqui!</a><hr>"
										}
										bootbox.alert(fullString);
									} else {
										new PNotify({
											title: 'Oops!',
											text: 'Ocorreu um erro por favor tente mais tarde.',
											type: 'error',
											icon: 'ti ti-close',
											styling: 'fontawesome'
										});
									}
								})
								.catch((error) => {
									new PNotify({
										title: 'Oops!',
										text: 'Ocorreu um erro por favor tente mais tarde.',
										type: 'error',
										icon: 'ti ti-close',
										styling: 'fontawesome'
									});
								});
							});
							return '<div class="btn-group dropdown">' +
							'<a class="btn btn-xs btn-success btn-raised resumo" data-id="' + data.id +'" >Detalhes</a>' +
						'</div>';
					} 
				}
			]
		});
		
		$('.dataTables_filter input').attr('placeholder','Procurar...');
	
	
		//DOM Manipulation to move datatable elements integrate to panel
		$('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
		$('.panel-ctrls').append("<i class='separator'></i>");
		$('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
	
		$('.panel-footer').append($(".dataTable+.row"));
		$('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
	} else if (document.getElementById("tableDespesas")) {
		var datatable = $('#tableDespesas').dataTable({
			"language": {
				"lengthMenu": "_MENU_"
			},
			"ajax": {
				"url": "/api/minhas_despesas/por_pagar",
				"dataSrc": ""
			},
			columns: [
				{ data: 'data' },
				{ data: 'descricao' },
				{ data: null,
					render: function (data, type, row) {
						return data.valor + '€';
					}
				},
				{ data: null,
					render: function (data, type, row) {
						if (data.pago == 1) {
							return '<a class="marcarPago" data-id=' + data.id + ' data-estado=1 style="color:green">Pago</a>';
						} else if (data.pago == 0) {
							return '<a class="marcarPago" data-id=' + data.id + ' data-estado=0 style="color:red">Por Pagar</a>';
						}
					} 
				},
				{ data: null,
						render: function (data, type, row) {
							return '<div class="btn-group dropdown">' +
							'<a class="btn btn-xs btn-warning btn-raised" href="editarDespesa/' + data.id +'">Editar</a>' +
							'<button class="btn btn-xs btn-warning btn-raised dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>' +
							'<ul class="dropdown-menu" role="menu">' +
								'<li><a style="color:red" class="apagar" data-id="' + data.id +'">Apagar</a></li>' +
							'</ul>' +
						'</div>';
					} 
				}
			]
		});

		$('#tableDespesas tbody').on('click', '.marcarPago', function(){ 
			var html = $(this);
			var estado = html.data("estado");
			var id = html.data("id");
			bootbox.confirm("Tem a certeza que deseja mudar o estado para " + ((estado == 1) ? "Por Pagar" : "Pago") + "?", function(result) {
				if (result) {
					$.ajax({
						url: "/api/atualizarEstadoDespesa",
						type:"POST",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						data: {
							'id': id,
							'pago': ((estado == 1) ? 0 : 1)
						},
						success:function(response){
							var stringPago = '<a class="marcarPago" data-id=' + id + ' data-estado=1 style="color:green">Pago</a>';
							var stringPorPagar = '<a class="marcarPago" data-id=' + id + ' data-estado=0 style="color:red">Por Pagar</a>';

							if (estado == 1) {
								html.parent().html(stringPorPagar);
							} else if (estado == 0) {
								html.parent().html(stringPago);
							}
						},
						error: function(error) {
							console.log(error);
						}
					});
				}
			}); 
			
		});

		$('#tableDespesas tbody').on('click', '.apagar', function(){ 
			var linha = $(this).parents('tr');
			var id = $(this).data("id");
			bootbox.confirm("Tem a certeza que deseja apagar?", function(result) {
				if (result) {
					$.ajax({
						url: "/api/apagarPagamento",
						type:"POST",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						data: {
							'id': id
						},
						success:function(response){
							linha.remove();
						},
						error: function(error) {
							console.log(error);
						}
					});
				}
			});
		});
		
		$('.dataTables_filter input').attr('placeholder','Procurar...');
	
	
		//DOM Manipulation to move datatable elements integrate to panel
		$('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
		$('.panel-ctrls').append("<i class='separator'></i>");
		$('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
	
		$('.panel-footer').append($(".dataTable+.row"));
		$('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");

		$(".atualizarTabela").click(function(){ 
			datatable.api().ajax.url('/api/minhas_despesas/' + $(this).data("id")).load();
		});

	}  else if (document.getElementById("tableAtas")) {
		var datatable = $('#tableAtas').dataTable({
			"language": {
				"lengthMenu": "_MENU_"
			},
			"ajax": {
				"url": "/api/minhas_atas",
				"dataSrc": ""
			},
			columns: [
				{ data: 'data' },
				{ data: 'descricao' },
				{ data: null,
						render: function (data, type, row) {
							$(".resumo").unbind().click(function(){ 
								var id = $(this).data("id");
								axios.get('/api/ata/' + id)
								.then((response) => {
									if (response.data[0]) {
										bootbox.hideAll();
										bootbox.alert("<b>Data:</b> " + response.data[0].data + "<br><b>Descrição:</b> " + response.data[0].descricao + "<br><b>Resumo:</b><br>" + (response.data[0].ata).replace(/\r\n/g,"<br>"));
									} else {
										new PNotify({
											title: 'Oops!',
											text: 'Ocorreu um erro por favor tente mais tarde.',
											type: 'error',
											icon: 'ti ti-close',
											styling: 'fontawesome'
										});
									}
								})
								.catch((error) => {
									new PNotify({
										title: 'Oops!',
										text: 'Ocorreu um erro por favor tente mais tarde.',
										type: 'error',
										icon: 'ti ti-close',
										styling: 'fontawesome'
									});
								});
							});
							return '<div class="btn-group dropdown">' +
							'<a class="btn btn-xs btn-success btn-raised resumo" data-id="' + data.id +'" >Ver Resumo</a>' +
							'<button class="btn btn-xs btn-success btn-raised dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>' +
							'<ul class="dropdown-menu" role="menu">' +
								'<li><a href="editarAta/' + data.id +'">Editar</a></li>' +
							'</ul>' +
						'</div>';
					} 
				}
			]
		});
		
		$('.dataTables_filter input').attr('placeholder','Procurar...');
	
	
		//DOM Manipulation to move datatable elements integrate to panel
		$('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
		$('.panel-ctrls').append("<i class='separator'></i>");
		$('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
	
		$('.panel-footer').append($(".dataTable+.row"));
		$('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
	} else if (document.getElementById("tablePagamentos")) {
		var datatable = $('#tablePagamentos').dataTable({
			"language": {
				"lengthMenu": "_MENU_"
			},
			"ajax": {
				"url": "/api/pagamentos/por_pagar",
				"dataSrc": ""
			},
			columns: [
				{ data: 'data' },
				{ data: null,
					render: function (data, type, row) {
						return data.valor + '€';
					}
				},
				{ data: null,
					render: function (data, type, row) {
						if (data.pago == 1) {
							return '<a class="marcarPago" data-id=' + data.id + ' data-estado=1 style="color:green">Pago</a>';
						} else if (data.pago == 0) {
							return '<a class="marcarPago" data-id=' + data.id + ' data-estado=0 style="color:red">Por Pagar</a>';
						}
					} 
				},
				{ data: 'nome' },
				{ data: null,
						render: function (data, type, row) {
							return '<div class="btn-group dropdown">' +
							'<a class="btn btn-xs btn-danger btn-raised apagar" data-id="' + data.id +'">Apagar</a>' +
						'</div>';
					} 
				}
			]
		});

		$('#tablePagamentos tbody').on('click', '.marcarPago', function(){ 
			var html = $(this);
			var estado = html.data("estado");
			var id = html.data("id");
			bootbox.confirm("Tem a certeza que deseja mudar o estado para " + ((estado == 1) ? "Por Pagar" : "Pago") + "?", function(result) {
				if (result) {
					$.ajax({
						url: "/api/atualizarEstadoPagamento",
						type:"POST",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						data: {
							'id': id,
							'pago': ((estado == 1) ? 0 : 1)
						},
						success:function(response){
							var stringPago = '<a class="marcarPago" data-id=' + id + ' data-estado=1 style="color:green">Pago</a>';
							var stringPorPagar = '<a class="marcarPago" data-id=' + id + ' data-estado=0 style="color:red">Por Pagar</a>';

							if (estado == 1) {
								html.parent().html(stringPorPagar);
							} else if (estado == 0) {
								html.parent().html(stringPago);
							}
						},
						error: function(error) {
							console.log(error);
						}
					});
				}
			}); 
			
		});

		$('#tablePagamentos tbody').on('click', '.apagar', function(){ 
			var linha = $(this).parents('tr');
			var id = $(this).data("id");
			bootbox.confirm("Tem a certeza que deseja apagar?", function(result) {
				if (result) {
					$.ajax({
						url: "/api/apagarPagamento",
						type:"POST",
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						data: {
							'id': id
						},
						success:function(response){
							linha.remove();
						},
						error: function(error) {
							console.log(error);
						}
					});
				}
			});
		});
		
		$('.dataTables_filter input').attr('placeholder','Procurar...');
	
	
		//DOM Manipulation to move datatable elements integrate to panel
		$('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
		$('.panel-ctrls').append("<i class='separator'></i>");
		$('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");
	
		$('.panel-footer').append($(".dataTable+.row"));
		$('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");

		$(".atualizarTabela").click(function(){ 
			datatable.api().ajax.url('/api/pagamentos/' + $(this).data("id")).load();
		});

	}
    
});