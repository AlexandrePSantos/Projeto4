<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

	// insert_log_artigo($_GET['artigo'], 'Atualização de stocks', 0, null, 200, 600, $sqli_connection);

	if ( checkProfilePermission("Artigos_Stocks") != 1 ) {
		header('Location: ../acesso-funcionalidades?redirectfrom=gesfaturacao/tabelas/artigos&redirectto=/gesfaturacao');
	}
?>
<html>
	<title>Artigo: Detalhes - Registos de Logs | GESFaturação</title>
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
							<a class="text-red only-ic" href="../artigos/detalhes?artigo=<?php echo $_GET['artigo']; ?>"><i class="fa fa-times"></i></a>
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li>
								<a href="../artigos">Artigos</a>
							</li>
							<li>
								<a href="../artigos/detalhes?artigo=<?php echo $_GET['artigo']; ?>">Detalhes do Artigo</a>
							</li>
							<li class="active">
								Registos de Logs
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row" id="mainInfoWrapper">
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label">Código</label>
									<span id="codigo_artigo" style="display: block"></span>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label class="control-label">Nome</label>
									<span id="nome_artigo" style="display: block"></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label">Stock Atual</label>
									<span id="stock_artigo" style="display: block"></span>
									<span id="unidade_artigo" style="display: block"></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label">Código de Barras</label>
									<span id="codigobarras_artigo" style="display: block"></span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label class="control-label">Nº Série</label>
									<span id="numeroserie_artigo" style="display: block"></span>
								</div>
							</div>
						</div>
						<hr>
						<div class="row mtm">
							<div class="col-md-12 ">
								<table class="table table-bordered table-striped" id="table_id" >
									<thead>
										<tr>
											<th style="width: 80px;">ID</th>
											<th style="width: 120px;">Data</th>
											<th>Ação</th>
											<th style="width: 140px;">Doc.Associado</th>
											<th style="width: 140px;">Utilizador</th>
											<th style="width: 110px;">Stock Anterior</th>
											<th style="width: 110px;">Stock Posterior</th>
											<th style="width: 110px;">Dif. Stock</th>
											<th style="width: 60px;">Opções</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>

						<div class="form-footer">
							<div class="mtxl pull-right" id="btns-wrapper"></div>
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
		<script src="/js/jquery.showmore.js"></script>

		<?php include('modal_info_log.php'); ?>
		<?php include('registos_novo.php'); ?>
		<!-- //ADDED SCRIPTS -->

		<script>
			$(".navbar-nav li.artigos").addClass("active");
			$(".navbar-nav li.artigos li.artigos_artigos").addClass("active");
		</script>
		<script type="text/javascript">
			var table;

			$(document).ajaxStart(function() {
				$(".fullscreen").show();
			});
			$(document).ajaxComplete(function() {
				if ($.active == 1) {
					$(".fullscreen").fadeOut();
				}
				//init elements
				$(".money").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : ' €',
					pSign : 's'
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
				//init elements
				$(".qtd").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '',
					pSign : 's',
					mDec : 3
				});
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

				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});
				//init elements
				$(".qtd").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '',
					pSign : 's',
					mDec : 3
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

				$(".percentage").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '  %',
					vMax : '100',
					mDec : 2,
					vMin:'0',
					pSign : 's'
				});
				//init elements
				$(".qtd").autoNumeric("init", {
					aSep : '.',
					aDec : ',',
					aSign : '',
					pSign : 's',
					mDec : 3
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

			//load data article
			function fill_artigo(idArtigo) {
				$.ajax({
					type : 'POST',
					url : '/gesfaturacao/server/artigos/artigos_detalhes.php',
					dataType : 'json',
					data : { idArtigo : idArtigo },
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

									$("#codigo_artigo").html(dados.Codigo);
									$("#nome_artigo").html(dados.Nome);
									if(dados.Tipo != 'Serviços') $("#stock_artigo").html(dados.Stock);
									else  $("#stock_artigo").html('-');
									// $("#tipo_artigo").html(dados.Tipo);
									$("#codigobarras_artigo").html(dados.CodigoBarras);
									if(dados.SerialNumber != '') $("#numeroserie_artigo").html(dados.SerialNumber);
									else $("#numeroserie_artigo").html('-');
									// $("#unidade_artigo").html(dados.Unidade);
									
									$('#btns-wrapper').append('<a href="../artigos/detalhes?artigo='+idArtigo+'" class="btn btn-default" type="button"> Cancelar </a>');
								}
							}
						}
					},
					complete : function() {
					}
				});
			}
		</script>

		<script type="text/javascript">
			table = $('#table_id').dataTable({
				"dom" : '<lfrtip><"clear">',
				"sRowSelect" : "os",
				"sRowSelector" : 'td:first-child',
				"lengthMenu" : [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
				"aaSorting" : [[1, "desc"], [0, "desc"]],
				"bProcessing" : true,
				"bServerSide" : true,
				"sAjaxSource" : "/gesfaturacao/server/datatable/artigos_registos.php?artigo=<?php echo $_GET['artigo']; ?>",
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
					null, null, null, null, null,
					{ "sClass" : "text-right", }, 
					{ "sClass" : "text-right", }, 
					{ "sClass" : "text-right", }, 
					{ "bVisible" : true, "bSortable" : false, "bSearchable" : false, "sClass" : "text-center", }, 		 
					{ "bVisible" : false, "bSortable" : false, "bSearchable" : false, }
				],
				"aoColumnDefs" : [
					{
						"aTargets" : [1],
						"mRender" : function(data, type, full) {
							var element = '';
							var tmp = full[1].split(" ");
							var tmp2 = tmp[0].split("-");
							var tmpNew = tmp2[0]+'/'+tmp2[1]+'/'+tmp2[2]+' '+tmp[1];
							var tmpLBL = tmp2[2]+'/'+tmp2[1]+'/'+tmp2[0]+' '+tmp[1];
							element = '<span id="data_registo_'+full[8]+'" data-normalizeDate="'+tmpNew+'">'+tmpLBL+'</span>';
							//return html
							return element;
						}
					},
					{
						"aTargets" : [2],
						"mRender" : function(data, type, full) {
							//return html
							return '<span class="ellipsis" data-size="30">'+full[2]+'</span>';
						}
					},
					{
						"aTargets" : [3],
						"mRender" : function(data, type, full) {
							var element = '';
							if(full[3] == null) element = '-';
							else element = full[3];
							
							//return html
							return '<span class="ellipsis" data-size="18">'+element+'</span>';
						}
					},
					{
						"aTargets" : [4],
						"mRender" : function(data, type, full) {
							//return html
							return '<span class="ellipsis" data-size="18">'+full[4]+'</span>';
						}
					},
					{
						"aTargets" : [5],
						"mRender" : function(data, type, full) {
							var element = '-';
							element ='<span class="qtd">'+full[5]+'</span>';
							
							//init elements
							$(".qtd").autoNumeric("init", {
								aSep : '.',
								aDec : ',',
								aSign : '',
								pSign : 's',
								mDec : 3
							});

							//return html
							return element;
						}
					},
					{
						"aTargets" : [6],
						"mRender" : function(data, type, full) {
							var element = '-';
							element ='<span class="qtd">'+full[6]+'</span>';
							
							//init elements
							$(".qtd").autoNumeric("init", {
								aSep : '.',
								aDec : ',',
								aSign : '',
								pSign : 's',
								mDec : 3
							});

							//return html
							return element;
						}
					},
					{
						"aTargets" : [7],
						"mRender" : function(data, type, full) {
							var element = '-';
							var colorLbl = '';
							if(full[7] < 0) colorLbl = 'text-red';
							else colorLbl = 'text-green';

							element ='<span class="qtd '+colorLbl+'">'+full[7]+'</span>';
							
							//init elements
							$(".qtd").autoNumeric("init", {
								aSep : '.',
								aDec : ',',
								aSign : '',
								pSign : 's',
								mDec : 3
							});

							//return html
							return element;
						}
					},
					{
						"aTargets" : [8],
						"mRender" : function(data, type, full) {
							var processedName = full[2].replace(/'/gi, " "); processedName = processedName.replace(/"/gi, " ");
							var nome = "'" + processedName + "'";
							var html = '';

							var idArtigoReg = "'<?php echo $_GET['artigo']; ?>'";
							
							//show details
							// html += '<a href="detalhes?artigo=' + full[8] + '" class="options-link text-info"><i class="fa fa-eye" title="Ver"></i></a>';
							html += '<a onclick="infoRegisto('+ idArtigoReg +', '+full[8]+')" class="options-link text-info"><i class="fa fa-eye" title="Ver"></i></a>';

							//return all html composed
							return html;
						}
					}
				],

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
			
			/**
			 * Apagar acerto de stock manual
			 */
			function deleteRegisto(idArtigo, idRegisto){
				if (confirm("Tem a certeza que pretende remover este acerto manual de stock?") == true) {
					$.ajax({
						type : 'POST',
						url : '/gesfaturacao/server/artigos/artigos_registo_apagar.php',
						dataType : 'json',
						data : {
							idArtigo : idArtigo,
							idRegisto : idRegisto
						},
						success : function(resposta) {
							var resp = resposta;
							if (resposta == null)
								$.scojs_message("[FAT001] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
							else {
								if (resposta.errors) {
									$.scojs_message("[FAT002] Não foi possível processar os dados. Por favor tente novamente.", $.scojs_message.TYPE_ERROR);
								} else {
									$.scojs_message("Acerto manual eliminado com sucesso.", $.scojs_message.TYPE_OK);
								}
							}
						},
						complete : function(resposta) {
							table.fnReloadAjax();
						}
					});
				} else { return false; }
			}
		</script>
	</body>
</html>