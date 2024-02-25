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
					$.scojs_message("[FAT001] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
				} else {
					if (resposta.errors == true) {
						$.scojs_message("[FAT002] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
					} else {
						if (resposta.data == null) {
							$.scojs_message("[FAT003] Ocorreu um erro . Contacte o administrador", $.scojs_message.TYPE_ERROR);
						} else {
							var dados = resposta.data;
							var nome = "'"+dados.Nome+"'";
							var nif = "'"+dados.Nif+"'";

							if(idCliente > 1){
								if(idCliente == 1){
									$('#btns-wrapper').append('&nbsp;<button class="btn btn-yellow" type="button" disabled> <i class="fa fa-edit"></i>&nbsp;Editar </a>');
								} else {
									$('#btns-wrapper').append('&nbsp;<a href="editar?cliente='+idCliente+'" class="btn btn-yellow" type="button"> <i class="fa fa-edit"></i>&nbsp;Editar </a>');
								}

								//active options
								if( dados.Ativo == 1 ){
									$('#btns-wrapper').append('&nbsp;<button class="btn bg-violet" type="button" onClick="alterarEstadoCliente('+idCliente+','+nome+')"> <i class="fa fa-ban"></i>&nbsp;Desativar </button>');
								}else{
									$('#btns-wrapper').append('&nbsp;<button class="btn btn-success" type="button" onClick="alterarEstadoCliente('+idCliente+','+nome+')"> <i class="fa fa-check"></i>&nbsp;Ativar </button>');
								}

								//remove options
								if(dados.Usado > 0){
									$('#btns-wrapper').append('&nbsp;<button class="btn btn-danger" type="button" disabled> <i class="fa fa-trash"></i>&nbsp;Remover </button>');
								}else{
									$('#btns-wrapper').append('&nbsp;<button class="btn btn-danger" type="button" onClick="eliminarCliente('+idCliente+','+nome+')"> <i class="fa fa-trash"></i>&nbsp;Remover </button>');
								}
							}

							$('#btns-wrapper').append('&nbsp;&nbsp;<a  href="../clientes" class="btn btn-default" type="button"> Cancelar </a>');

							$("#codigo_cliente").html(dados.Codigo);
							$("#codigo_interno_cliente").html(dados.CodigoInterno);
							$("#nome_cliente").html(dados.Nome);
							$("#nif_cliente").html(dados.Nif);
							$("#pais_cliente").html(dados.PaisFull);
							$("#endereco_cliente").html(dados.Endereco);
							$("#codigopostal_cliente").html(dados.CodigoPostal);
							$("#localidade_cliente").html(dados.Localidade);
							$("#regiao_cliente").html(dados.Regiao);
							$("#cidade_cliente").html(dados.Cidade);

							$("#email_cliente").html(dados.Email);
							$("#website_cliente").html(dados.Website);
							$("#tlm_cliente").html(dados.Telemovel);
							$("#tlf_cliente").html(dados.Telefone);
							$("#fax_cliente").html(dados.Fax);
							$("#preferencial_nome_cliente").html(dados.PreferenciaNome);
							$("#preferencial_email_cliente").html(dados.PreferenciaEmail);
							$("#preferencial_tlm_cliente").html(dados.PreferenciaTelemovel);
							$("#preferencial_tlf_cliente").html(dados.PreferenciaTelefone);
							$("#contacorrente_cliente").html(dados.Account);
							$("#pagamento_cliente").html(dados.Metodo);
							if(dados.Vencimento == 0) $("#vencimento_Cliente").html('Pronto Pagamento');
							else $("#vencimento_Cliente").html(dados.Vencimento+' dias');
							$("#desconto_cliente").autoNumeric('set', dados.Desconto);

							if(dados.IsencaoIVA == 1) $('#isento_iva').html('Sim');
							else $('#isento_iva').html('Não');
							$("#motivo_isencao_iva").html(dados.MotivoIsencaoDescricao);
							$("#fitofarmaceuticos_cliente").html(dados.NumAtividadeFitoFarmac);
							$("#observacoes_cliente").html(dados.ObservacoesCliente);

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

						}
					}
				}
			},
			complete : function() {
			}
		});
	}

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
					setTimeout(function() {
						location.reload();
					}, 1000);
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
					setTimeout(function() {
						window.location.href = "../clientes";
					}, 1000);
				}
			});
		} else { return false; }
	}
</script>
