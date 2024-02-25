		<!-- MAIN JS -->
		<script src="/js/jquery-1.11.3.min.js"></script>
		<script src="/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<!--AXIOS-->
		<script src="/js/axios.min.js"></script>

		<!-- PLUGINS JS -->
		<script src="/js/vendors/jquery-validate/jquery.validate.min.js"></script>
		<script src="/js/vendors/sco.message/sco.message.js"></script>
		<script src="/js/toastr/toastr.min.js"></script>

		<script src="/js/vendors/iCheck/icheck.min.js"></script>
		<script src="/js/vendors/iCheck/custom.min.js"></script>
		<script src="/js/vendors/jquery-validate/jquery.validate.min.js"></script>

		<script src="/js/vendors/jquery-maskedinput/jquery-maskedinput.js"></script>

		<script type="text/javascript">
			$(".navbar-gesfaturacao li a.mnitemlnk").on('click', function(){
				$(".fullscreen").fadeIn();
				setTimeout(function(){
					$(".fullscreen").fadeOut();
				}, 3000);
			});
		</script>

		<!-- SELECT2 FORMAT -->
		<script src="/js/vendors/select2/js/select2.min.js"></script>
		<script src="/js/vendors/select2/js/i18n/pt.js"></script>
		<script type="text/javascript">
			//articles select box
			function articlesTemplate (article, container) {
				// console.log(article, article.data);
				var $articleElement = '';

				//if exists process it
				if (article && typeof(article.data) !== 'undefined' && article.data != null){
					var articleData = article.data;

					var html = "<span><b>"+articleData.Codigo+"</b> - "+articleData.Nome+"</span>";

					html += "<br><small>";

					if(articleData.Tipo == 'P') html += "<em>Produto</em> ";
					else html += "<em>Serviço</em> ";

					if(articleData.CodigoBarras && articleData.SerialNumber){
						html += "| <em>"+articleData.CodigoBarras+"</em> | <em>S/N: "+articleData.SerialNumber+"</em> ";
					}else if(articleData.CodigoBarras) {
						html += "| <em>"+articleData.CodigoBarras+"</em> ";
					}else if(articleData.SerialNumber) {
						html += "| <em>S/N: "+articleData.SerialNumber+"</em> ";
					}

					if(articleData.Categoria) html += "| <em>"+articleData.Categoria+"</em> ";

					if(articleData.Stock) html += "| <em>Stock Global: "+articleData.Stock+"</em> ";

					html += "<br></small>";

					var $articleElement = html;
				}else{
					$articleElement = article.text;
				}

				return $articleElement;
			};
			//articles select box label
			function articlesTemplateLabel (article) {
				// console.log(article.text);
				var $articleElement = article.text;
				return $articleElement;
			};

			//compras select box
			function comprasTemplate (compra, container) {
				//console.log(compra, compra.data);
				var $compraElement = '';

				//if exists process it
				if (compra && typeof(compra.data) !== 'undefined' && compra.data != null){

					var compraData = compra.data;

					if(compraData.ID_Compra == 0){
						var html = "<span><b>"+compraData.Numero+"</b></span>";
						container.classList.add('rappel-container');
					}else{
						var html = "<span><b>"+compraData.Numero+"</b> - "+compraData.Data+"</span>";
						html += "<br><small>";
						html += "<em>Total: "+compraData.GrossTotal+" €</em> ";
						html += "<br></small>";
					}

					var $compraElement = html;
				}else{
					$compraElement = compra.text;
				}

				return $compraElement;
			};
			//compras select box label
			function comprasTemplateLabel (compra) {
				// console.log(compra.text);
				var $compraElement = compra.text;
				return $compraElement;
			};

			//fornecedores select box
			function fornecedoresTemplate (fornecedor, container) {
				// console.log(fornecedor, fornecedor.data);
				var $fornecedorElement = '';

				//if exists process it
				if (fornecedor && typeof(fornecedor.data) !== 'undefined' && fornecedor.data != null){
					var fornecedorData = fornecedor.data;

					var html = "<span><b>"+fornecedorData.Nome+"</b> - "+fornecedorData.Nif+"</span>";

					html += "<br><small>";

					html += "<b>Cód: "+fornecedorData.Codigo+"</b> ";

					if(fornecedorData.PreferenciaNome) html += "| <em>"+fornecedorData.PreferenciaNome+"</em> ";

					html += "<br></small>";

					var $fornecedorElement = html;
				}else{
					$fornecedorElement = fornecedor.text;
				}

				return $fornecedorElement;
			};
			//fornecedores select box label
			function fornecedoresTemplateLabel (fornecedor) {
				// console.log(fornecedor.text);
				var $fornecedorElement = fornecedor.text;
				return $fornecedorElement;
			};

			//ivas select box label
			function ivasTemplateLabel(iva) {
				if(iva.element){
					var value = iva.element.dataset.valor;
					if(value) return value +"%" ;
				}
				return iva.text;
			}

			//motivos select box label
			function motivosTemplateLabel(motivo) {
				if(motivo.element){
					var codigo = motivo.element.dataset.codigo;
					if(codigo) return codigo;
				}
				return motivo.text;
			}

			//motivos select box
			function motivosTemplate(motivo) {
				if (motivo && typeof(motivo.element) !== 'undefined' && motivo.element != null){
					return `
					<span>
						<b>${motivo.element.dataset.codigo}</b> : ${motivo.element.dataset.desc}
						<br/>
						<small>
							<em>${motivo.element.dataset.info ? motivo.element.dataset.info : ''}</em>
						</small>
					</span>`
				} else {
					return motivo.text
				}
			}


			//centers select box
			function centersTemplate (centers, container) {
				// console.log(centers, centers.data);
				var $centerElement = '';

				//if exists process it
				if (centers && typeof(centers.data) !== 'undefined' && centers.data != null){
					var centerData = centers.data;

					var html = "<span>"+centerData.Nome+"</span>";

					if(centerData.Descricao) {
						html += "<br><small>";

						html += "<em>"+centerData.Descricao+"</em> ";

						html += "<br></small>";
					}

					var $centerElement = html;
				}else{
					$centerElement = centers.text;
				}

				return $centerElement;
			};
			//centers select box label
			function centersTemplateLabel (centers) {
				if(centers.id == 0){
					return '---';
				}
				var $centerElement = centers.text;
				return $centerElement;
			};


			//clientes select box
			function clientesTemplate (cliente, container) {
				// console.log(cliente, cliente.data);
				var $clienteElement = '';

				//if exists process it
				if (cliente && typeof(cliente.data) !== 'undefined' && cliente.data != null){
					var clienteData = cliente.data;

					var html = "<span><b>"+clienteData.Nome+"</b> - "+clienteData.Nif+"</span>";

					html += "<br><small>";

					html += "<b>Cód: "+clienteData.Codigo+"</b> ";

					if(clienteData.CodigoInterno) html += "| <b>Cód. Interno: "+clienteData.CodigoInterno+"</b> ";

					if(clienteData.PreferenciaNome) html += "| <em>"+clienteData.PreferenciaNome+"</em> ";

					html += "<br></small>";

					var $clienteElement = html;
				}else{
					$clienteElement = cliente.text;
				}

				return $clienteElement;
			};

			//clientes select box label
			function clientesTemplateLabel (cliente) {
				// console.log(cliente.text);
				var $clienteElement = cliente.text;
				return $clienteElement;
			};

			//categoria select box label
			function categoriesTemplateLabel (category) {
				// console.log(cliente.text);
				var $categoryElement = category.text;
				return $categoryElement;
			};

			//categoria select box
			function categoriesTemplate (category, container) {
				var $categoryElement = '';

				//if exists process it
				if (category && typeof(category.data) !== 'undefined' && category.data != null){
					var categoryData = category.data;
					var html = "<span><b>"+categoryData.Nome+"</b></span>";
					html += "<br><small>";
					html += "<b>Cód: "+categoryData.ID_Categoria+"</b> ";
					html += "<br></small>";
					var $categoryElement = html;
				}else{
					$categoryElement = category.text;
				}

				return $categoryElement;
			};


			//avencas select box
			function avencasTemplate (avenca, container) {
				// console.log(avenca, avenca.data);
				var $avencaElement = '';

				//if exists process it
				if (avenca && typeof(avenca.data) !== 'undefined' && avenca.data != null){
					var avencaData = avenca.data;

					var html = "<span><b>"+avencaData.DescricaoAvenca+"</b> | "+avencaData.Data+"</span>";

					html += "<br><small>";

					html += "<b>"+avencaData.NomeCliente+"</b> - "+avencaData.NifCliente+"</b>";

					html += "<br>";

					html += "<b>"+avencaData.PeriodicidadeLabel+"</b> | <b>Finalizar: "+avencaData.FinalizarAvencaLabel+"</b> | <b>Valor: "+avencaData.ValorLabel+"</b>";

					html += "<br></small>";

					var $avencaElement = html;
				}else{
					$avencaElement = avenca.text;
				}

				return $avencaElement;
			};
			//avencas select box label
			function avencasTemplateLabel (avenca) {
				// console.log(avenca.text);
				var $avencaElement = avenca.text;
				return $avencaElement;
			};

			//clientes select box
			function medicoTemplate (medico, container) {
				// console.log(cliente, cliente.data);
				var $medicoElement = '';

				//if exists process it
				if (medico && typeof(medico.data) !== 'undefined' && medico.data != null){
					var medicoData = medico.data;

					var html = "<span><b>"+medicoData.Nome+"</b> - "+medicoData.NCelula+"</span>";

					var $medicoElement = html;
				}else{
					$medicoElement = medico.text;
				}

				return $medicoElement;
			};

			//utilizadores select box
			function utilizadoresTemplate (utilizador, container) {
				// console.log(utilizador, utilizador.data);
				var $utilizadorElement = '';

				//if exists process it
				if (utilizador && typeof(utilizador.data) !== 'undefined' && utilizador.data != null){
					var utilizadorData = utilizador.data;

					var html = "<span><b>"+utilizadorData.nome+"</b></span>";

					html += "<br><small>";

					html += "<b>Email: "+utilizadorData.email+"</b> ";

					if(utilizadorData.num_toc_contabilista) html += "| <b>Num. TOC: "+utilizadorData.num_toc_contabilista+"</b> ";

					html += "</small>";

					var $utilizadorElement = html;
				}else{
					$utilizadorElement = utilizador.text;
				}

				return $utilizadorElement;
			};
			//utilizadores select box label
			function utilizadoresTemplateLabel (utilizador) {
				// console.log(utilizador.text);
				var $utilizadorElement = utilizador.text;
				return $utilizadorElement;
			};
		</script>

		<script type="text/javascript">
			/* CHECK MOBILE DEVICE (SMARTPHONES ONLY) */
			window.mobileCheck = function() {
				let check = false;
				(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
				return check;
			};

			/* CHECK MOBILE DEVICE (SMARTPHONES AND TABLETS) */
			window.mobileAndTabletCheck = function() {
				let check = false;
				(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
				return check;
			};
		</script>

		<script>
			function displayPermissionMissingError(permission){
				$.scojs_message(`[${permission}] Não tem as premissões necessárias para poder realizar esta ação.`, $.scojs_message.TYPE_ERROR);
			}
		</script>
