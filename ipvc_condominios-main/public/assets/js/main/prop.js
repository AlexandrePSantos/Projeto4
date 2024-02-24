$(document).ready(function() {
    if (document.getElementById("tableHome")) {
        var datatable = $('#tableHome').dataTable({
            "language": {
                "lengthMenu": "_MENU_"
            },
            "ajax": {
                "url": "/api/minhas_habitacoes_prop",
                "dataSrc": ""
            },
            columns: [
                { data: 'portaria' },
                { data: 'tipo' },
                { data: 'nome' },
                { data: null,
                        render: function (data, type, row) {
                            return '<div class="btn-group dropdown">' +
                            '<a class="btn btn-xs btn-success btn-raised" href="verPagamentos/' + data.id +'">Ver Pagamentos</a>' +
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
				"url": "/api/pagamentos_user/" + window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1) + "/por_pagar",
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
							return '<a class="marcarPago" style="color:green">Pago</a>';
						} else if (data.pago == 0) {
							return '<a class="marcarPago" style="color:red">Por Pagar</a>';
						}
					} 
				},
				{ data: 'nome' },
				{ data: null,
						render: function (data, type, row) {
                            if (data.pago == 1) {
                                return 'Nenhuma Opção';
                            } else if (data.pago == 0) {
                                return '<div class="btn-group dropdown">' +
                                '<a class="btn btn-xs btn-success btn-raised" href="/pagar/' + data.id +'">Pagar</a>' +
                            '</div>';
                            }
							return ;
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

		$(".atualizarTabela").click(function(){ 
			datatable.api().ajax.url('/api/pagamentos_user/' + window.location.pathname.substring(window.location.pathname.lastIndexOf('/') + 1) + '/' + $(this).data("id")).load();
		});
	}
});