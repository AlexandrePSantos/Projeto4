<?php
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';
?>
<html>
	<title>Clientes: Novo Cliente | GESFaturação</title>
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
							<a class="text-red only-ic" href="../clientes"><i class="fa fa-times"></i></a>
						</div>
						<ol class="breadcrumb page-breadcrumb" style=" min-height: 35px; vertical-align: middle;">
							<li>
								<a href="../clientes">Clientes</a>
							</li>
							<li class="active">
								Novo Cliente
							</li>
						</ol>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<form id="form_new" class="form-validate">
									<div class="form-body">
										<div id="form_div">
											<h5 class="form-header">
												<legend class="form-legend">
													Dados do Cliente
												</legend>
											</h5>
											<div class="section-form">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Nif</label>
															<div class="input-group">
																<input type="text" class="form-control nif_field" id="nif_cliente" name="nif_cliente" placeholder="..." />
																<span class="input-group-btn">
																	<button type="button" class="btn btn-info" onclick="get_nif_details()">
																		<i class="fa fa-info"></i>&nbsp;Dados
																	</button>
																</span>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Nome Completo</label>
															<input type="text" class="form-control" id="nome_cliente" name="nome_cliente" placeholder="..." autofocus="true" />
														</div>
													</div>
													<div class="col-md-2 hide">
														<div class="form-group">
															<label class="control-label">Código<span class="require">*</span></label>
															<input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente" placeholder="..." disabled value="<?php echo getNextID('Codigo', 'faturacao_clientes') ?>" />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Cód. Interno</label>
															<input type="text" class="form-control" id="codigo_interno_cliente" name="codigo_interno_cliente" placeholder="..." value="<?php echo getNextID('CodigoInterno', 'faturacao_clientes') ?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Endereço</label>
															<input type="text" class="form-control" id="endereco_cliente" name="endereco_cliente" placeholder="..." />
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Código Postal</label>
															<input type="text" class="form-control cpostal_field" id="codigopostal_cliente" name="codigopostal_cliente" placeholder="____-___" />
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Localidade</label>
															<input type="text" class="form-control " id="localidade_cliente" name="localidade_cliente" placeholder="" />
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Distrito</label>
															<input type="text" class="form-control" id="regiao_cliente_estrang" name="regiao_cliente_estrang" placeholder="..." style="display: none;" />
															<div id="selectRegiaoWrapper">
																<select class="form-control select2 show-tick" data-live-search="true"  data-header="Selecionar opção" id="regiao_cliente" name="regiao_cliente">
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Cidade</label>
															<input type="text" class="form-control" id="cidade_cliente_estrang" name="cidade_cliente_estrang" placeholder="..." style="display: none;" />
															<div id="selectCidadeWrapper">
																<select class="form-control select2 show-tick" data-live-search="true"  data-header="Selecionar opção" id="cidade_cliente" name="cidade_cliente">
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">País<span class="require">*</span></label>
															<select class="form-control select2 show-tick" data-live-search="true"  data-header="Selecionar opção" id="pais_cliente" name="pais_cliente">
																<?php include('paises.php'); ?>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Autorização Fitofarmacêuticos</label>
															<input type="text" class="form-control" id="fitofarmaceuticos_cliente" name="fitofarmaceuticos_cliente" placeholder="..." />
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label">Observações</label>
															<textarea class="form-control" id="observacoes_cliente" name="observacoes_cliente" placeholder="..." rows="2"></textarea>
														</div>
													</div>
												</div>
											</div>

											<h5 class="form-header">
												<legend class="form-legend">
													Contactos
												</legend>
											</h5>
											<div class="section-form">
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Email</label>
															<input type="email" class="form-control" id="email_cliente" name="email_cliente" placeholder="..." />
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Website</label>
															<input type="text" class="form-control" id="website_cliente" name="website_cliente" placeholder="..." />
														</div>
													</div>

													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Telemóvel</label>
															<input type="text" class="form-control" id="tlm_cliente" name="tlm_cliente" placeholder="..." />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Telefone</label>
															<input type="text" class="form-control" id="tlf_cliente" name="tlf_cliente" placeholder="..." />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Fax</label>
															<input type="text" class="form-control" id="fax_cliente" name="fax_cliente" placeholder="..." />
														</div>
													</div>
												</div>
											</div>

											<h5 class="form-header">
												<legend class="form-legend">
													Contacto do Representante
												</legend>
											</h5>
											<div class="section-form">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Nome</label>
															<input type="text" class="form-control" id="preferencial_nome_cliente" name="preferencial_nome_cliente" placeholder="..." />
														</div>
													</div>

													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Email</label>
															<input type="email" class="form-control" id="preferencial_email_cliente" name="preferencial_email_cliente" placeholder="..." />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Telemóvel</label>
															<input type="text" class="form-control" id="preferencial_tlm_cliente" name="preferencial_tlm_cliente" placeholder="..." />
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Telefone</label>
															<input type="text" class="form-control" id="preferencial_tlf_cliente" name="preferencial_tlf_cliente" placeholder="..." />
														</div>
													</div>
												</div>
											</div>

											<h5 class="form-header">
												<legend class="form-legend">
													Tipo de Conta e Faturação
												</legend>
											</h5>
											<div class="section-form">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label">Tipo de Conta Corrente<span class="require">*</span></label>
															<div class="radio">
																<label class="radio-inline padding-left-radio">
																	<input id="conta_geral_cliente" type="radio" name="conta_cliente" value="geral" class="default_radio" checked="checked"/>
																	Conta Geral
																</label>
																<label class="radio-inline">
																	<input id="conta_propria_cliente" type="radio" name="conta_cliente" value="propria"/>
																	Conta Própria
																</label>
															</div>
														</div>
													</div>
												</div>

												<div class="row mtm">
													<div class="col-md-4">
														<div class="row">
															<div class="col-xs-4">
																<div class="form-group">
																	<label class="control-label">Isento de IVA?</label>
																	<div class="checkbox">
																		<label>
																			<input type="checkbox" class="iCheck" name="isento_iva" id="isento_iva"> Sim
																		</label>
																	</div>
																</div>
															</div>
															<div class="col-xs-8">
																<div class="form-group">
																	<label class="control-label">Motivo de Isenção (IVA)</label>
																	<select class="form-control select2 show-tick" data-live-search="true"  data-header="Selecionar opção" id="motivo_isencao_iva" name="motivo_isencao_iva"  >
																		<option value="" data-hidden="true">Selecionar</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Método Pagamento</label>
															<select class="form-control select2 show-tick" data-live-search="true"  data-header="Selecionar opção" id="pagamento_cliente" name="pagamento_cliente"  >
																<option value="" data-hidden="true">Selecionar</option>
															</select>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label class="control-label">Condições de Pagamento</label>
															<select class="form-control select2 show-tick" data-live-search="true"  data-header="Selecionar opção" id="vencimento_Cliente" name="vencimento_Cliente"  >
																<option value="" data-hidden="true">Selecionar</option>
																<option value="-" selected>Condições Padrão</option>
																<option value="0">Pronto Pagamento</option>
																<option value="10">10 dias após emissão</option>
																<option value="20">20 dias após emissão</option>
																<option value="30">30 dias após emissão</option>
																<option value="60">60 dias após emissão</option>
																<option value="75">75 dias após emissão</option>
																<option value="90">90 dias após emissão</option>
																<option value="120">120 dias após emissão</option>
																<option value="180">180 dias após emissão</option>
															</select>
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="control-label">Desconto (%)</label>
															<input type="text" class="form-control percentage" id="desconto_cliente" name="desconto_cliente" placeholder="0 %" value="0"/>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-footer">
										<div class="mtxl pull-right">
											<button class="btn btn-yellow submit_button" type="submit">
												<i class="fa fa-floppy-o"></i> Gravar
											</button>
											<a  href="../clientes" class="btn btn-default" type="button"> Cancelar </a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include '../footer.php'; ?>
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

		<?php include('novo_scripts.php');  ?>
		<!-- //ADDED SCRIPTS -->

		<script>
			$(".navbar-nav li.clientes").addClass("active");
			$(".navbar-nav li.clientes li.clientes_clientes").addClass("active");
		</script>
		<script type="text/javascript">
			var flagContaGeral = 1;

			$(document).ajaxStart(function() {
				$(".fullscreen").show();
			});
			$(document).ajaxComplete(function() {
				if ($.active == 1) {
					$(".fullscreen").fadeOut();
				}
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

				/* INPUT CHECKBOX */
				$('input:checkbox').removeAttr("checked");
				$(".default_checked").attr("checked", true);
				$('input[type=checkbox]').iCheck({
					checkboxClass : 'icheckbox_flat-orange',
					increaseArea : '20%' // optional
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

				$('.cpostal_field').mask('0000-000');
				$('.nif_field').mask('000000000');

				// iCheck ------------------------
				$('input[type="radio"]:not(".switch")').iCheck({
					radioClass : 'iradio_square-yellow',
					increaseArea : '20%' // optional
				});

				/* INPUT CHECKBOX */
				$('input:checkbox').removeAttr("checked");
				$(".default_checked").attr("checked", true);
				$('input[type=checkbox]').iCheck({
					checkboxClass : 'icheckbox_flat-orange',
					increaseArea : '20%' // optional
				});

				//init Select2
				// $("select#regiao_cliente").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});
				$("select#cidade_cliente").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});
				$("select#pais_cliente").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});
				$("select#motivo_isencao_iva").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});
				$("select#pagamento_cliente").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});
				$("select#vencimento_Cliente").select2({escapeMarkup: function(m) { return m; }, language: "pt", placeholder: "Selecionar opção"});

				//fill necessary data
				fill_regions();
				fill_cities();
				fill_metodos();
				fill_motivos();
			});

			//City and Region Fields
			function changeAddressFieldsByLanguage(){
				if( $('#pais_cliente').val() != 'PT' ){
					$('.cpostal_field').unmask();
					$('.nif_field').unmask();
					//city
					$("#selectCidadeWrapper").hide();
					$("#cidade_cliente_estrang").show();
					$("#cidade_cliente_estrang").val('');
					// $("select#cidade_cliente").val( $("select#cidade_cliente option:eq(1)").val() );
					//region
					$("#selectRegiaoWrapper").hide();
					$("#regiao_cliente_estrang").show();
					$("#regiao_cliente_estrang").val('');
					// $("select#regiao_cliente").val( $("select#regiao_cliente option:eq(1)").val() );
				}else{
					$('.cpostal_field').mask('0000-000');
					$('.nif_field').mask('000000000');
					//city
					$("#selectCidadeWrapper").show();
					$("#cidade_cliente_estrang").hide();
					$("#cidade_cliente_estrang").val('');
					//region
					$("#selectRegiaoWrapper").show();
					$("#regiao_cliente_estrang").hide();
					$("#regiao_cliente_estrang").val('');
				}
				// $("select#cidade_cliente").trigger('change');
				// $("select#regiao_cliente").trigger('change');
			}

			/* ----------- LISTNERS ----------- */
			$('input#conta_geral_cliente').on('ifChecked', function (event) {
				flagContaGeral = 1;
			});
			$('input#conta_propria_cliente').on('ifChecked', function (event) {
				flagContaGeral = 0;
			});

			//change country
			$("select#pais_cliente").on('change', function(event){
				/*if( $(this).val() != 'PT' ){
					$('#nif_cliente').prop('disabled', true);
				}else{
					$('#nif_cliente').prop('disabled', false);
				}*/
				$('#nif_cliente').val('');
				changeAddressFieldsByLanguage();
			});

			//change region
			$("select#regiao_cliente").on('change', function(event){
				changeAddressFieldsByLanguage();
				fill_cities( $(this).val() );
			});

			/**
			 * ----------------------------------------------------
			 * ----------------- FORM PROCESSING ------------------
			 * ----------------------------------------------------
			 */
			/**
			 * Validate Percentage
			 */
			$.validator.addMethod("percentageValidation", function (value, element) {
				var valorInput = $(element).autoNumeric('get');
				if(valorInput >= 0 && valorInput != '') return true;
				else return false;
			}, "Por favor introduza uma percentagem válida.");
			val_form_new = $("#form_new").validate({
				ignore : "",
				rules : {
					/*nome_cliente : {
						required : true,
					},*/
					pais_cliente : {
						required : true,
					},
				},
				messages : {
					/*nome_cliente : {
						required : "Este campo é obrigatório"
					},*/
					pais_cliente : {
						required : "Este campo é obrigatório"
					},
					email_cliente : {
						email : "Digite um e-mail válido"
					},
					preferencial_email_cliente : {
						email : "Digite um e-mail válido"
					},
				},
				highlight : function(element, errorClass, validClass) {
					$(element).addClass(errorClass).removeClass(validClass);
				},
				unhighlight : function(element, errorClass, validClass) {
					$(element).removeClass(errorClass).addClass(validClass);
				},
				errorPlacement : function(error, element) {
					if (element.hasClass('select2')) {
						if (element.parent().hasClass("input-group"))
							error.insertAfter(element.parent());
						else
							error.insertAfter(element.next("div"));
					} else {
						error.insertAfter(element);
					}
				}
			});

			//check validation and upload foto
			$("#form_new").submit(function(e) {
				e.preventDefault();

				var valid = $("#form_new").valid();
				if (valid == false) {
					$.scojs_message("Preencha todos os campos", $.scojs_message.TYPE_ERROR);
				} else {

					$("#form_new").find('.submit_button').attr("disabled", true);
					$("#form_new").find('.submit_button').html('<i class="fa fa-circle-o-notch fa-spin  fa-fw "></i> A Carregar...');

					var regianProcessada = '';
					var cidadeProcessada = '';

					//process region and city
					if( $("#pais_cliente").val() != 'PT' ){
						regianProcessada = $("#regiao_cliente_estrang").val();
						cidadeProcessada = $("#cidade_cliente_estrang").val();
					}
					else{
						regianProcessada = $("#regiao_cliente").val();
						cidadeProcessada = $("#cidade_cliente").val();
					}

					//submite the form
					$.ajax({
						type : 'POST',
						url : '/gesfaturacao/server/clientes/inserir.php',
						dataType : 'json',
						data : {
							nome_cliente : $("#nome_cliente").val(),
							nif_cliente : $("#nif_cliente").val(),
							pais_cliente : $("#pais_cliente").val(),
							endereco_cliente : $("#endereco_cliente").val(),
							codigopostal_cliente : $("#codigopostal_cliente").val(),
							localidade_cliente : $("#localidade_cliente").val(),
							regiao_cliente : regianProcessada,
							cidade_cliente : cidadeProcessada,
							// grupo_cliente : $("#grupo_cliente").val(),
							email_cliente : $("#email_cliente").val(),
							website_cliente : $("#website_cliente").val(),
							tlm_cliente : $("#tlm_cliente").val(),
							tlf_cliente : $("#tlf_cliente").val(),
							fax_cliente : $("#fax_cliente").val(),
							preferencial_nome_cliente : $("#preferencial_nome_cliente").val(),
							preferencial_email_cliente : $("#preferencial_email_cliente").val(),
							preferencial_tlm_cliente : $("#preferencial_tlm_cliente").val(),
							preferencial_tlf_cliente : $("#preferencial_tlf_cliente").val(),
							pagamento_cliente : $("#pagamento_cliente").val(),
							vencimento_Cliente : $("#vencimento_Cliente").val(),
							desconto_cliente : $("#desconto_cliente").autoNumeric('get'),
							flagContaGeral : flagContaGeral,

							codigo_interno_cliente : $("#codigo_interno_cliente").val(),
							isento_iva : $("#isento_iva").is(":checked"),
							motivo_isencao_iva : $("#motivo_isencao_iva").val(),

							fitofarmaceuticos_cliente : $("#fitofarmaceuticos_cliente").val(),
							observacoes_cliente : $("#observacoes_cliente").val(),
						},
						success : function(resposta) {
							var resp = resposta;
							if (resposta == null)
								$.scojs_message("[FAT001] Ocorreu um erro ao inserir os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
							else {
								if (resposta.errors) {
									$.scojs_message("[FAT002] Ocorreu um erro ao inserir os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
								} else {
									$.scojs_message("Dados inseridos com sucesso.", $.scojs_message.TYPE_OK);
								}
							}
						},
						complete : function(resposta) {
							var resp = resposta;
							if (resp.responseJSON.errors) {
								if (resp.responseJSON.nif_error) {
									$.scojs_message("[FAT002] Contribuinte inválido. Por favor introduza um contribuinte válido.", $.scojs_message.TYPE_ERROR);
								} else {
									if (resp.responseJSON.duplicated_nif_error) {
										$.scojs_message("[FAT004] O Contribuinte indicado já existe.", $.scojs_message.TYPE_ERROR);
									} else {
										if (resp.responseJSON.forgoten_client) {
											$.scojs_message("[FAT005] O Contribuinte indicado usou o direito ao esquecimento.", $.scojs_message.TYPE_ERROR);
										} else {
											$.scojs_message("[FAT003] Ocorreu um erro ao inserir os dados. Contacte o administrador", $.scojs_message.TYPE_ERROR);
										}
									}
								}
							} else {
								$.scojs_message("Dados inseridos com sucesso.", $.scojs_message.TYPE_OK);
								//reload
								setTimeout(function() {
									window.location.href = "../clientes/detalhes?cliente="+resp.responseJSON.id_cliente;
								}, 1000);
							}
							$("#form_new").find('.submit_button').attr("disabled", false);
							$("#form_new").find('.submit_button').html('<i class="fa fa-floppy-o"></i> Gravar');
						}
					});
				}
			});
		</script>
	</body>
</html>
