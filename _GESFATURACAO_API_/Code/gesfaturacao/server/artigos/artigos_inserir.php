<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//GET POST VARS ---------------------------------------------------------
$codigo_artigo = $_POST['codigo_artigo'];
$nome_artigo = $_POST['nome_artigo'];
$categoria_artigo = $_POST['categoria_artigo'];
$tipo_artigo = $_POST['tipo_artigo'];
$stock_artigo = $_POST['stock_artigo'];
$stock_minimo = $_POST['stock_minimo'];
$unidade_artigo = $_POST['unidade_artigo'];
$precoPVP_artigo = $_POST['precoPVP_artigo'];
$imposto_artigo = $_POST['imposto_artigo'];
$preco_artigo = $_POST['preco_artigo'];

$codigobarras_artigo = $_POST['codigo_artigo'];
$numeroserie_artigo = $_POST['numeroserie_artigo'];
$retencao_valor_artigo = ($_POST['retencao_valor_artigo']) ? $_POST['retencao_valor_artigo'] : 0;
$retencao_percenteagem_artigo = ($_POST['retencao_percenteagem_artigo']) ? $_POST['retencao_percenteagem_artigo'] : 0;

$motivo_isencao_artigo = $_POST['motivo_isencao_artigo'];
$observacoes_artigo = $_POST['observacoes_artigo'];
$label_artigo = $_POST['label_artigo'];
$encomendaaqui_artigo = $_POST['encomendaaqui_artigo'] > 0 ? 1 : 0;
$adicionar_posto = $_POST['adicionar_posto'];
$id_postos = $_POST['id_postos'];
$categoryInvalid = $_POST['categoryInvalid'];
$disponivelementa_artigo = $_POST['disponivelementa_artigo'] > 0 ? 1 : 0;
$alertaStockMin = $_POST['alertaStockMin'];
$autopreencher_comentario_artigo = isset($_POST['autopreencher_comentario_artigo']) ? intval($_POST['autopreencher_comentario_artigo']) : 0;

$calcular_margem_unitario_artigo = isset($_POST['calcular_margem_unitario_artigo']) ? $_POST['calcular_margem_unitario_artigo'] : 0;
$margemlucro_artigo = isset($_POST['margemlucro_artigo']) ? $_POST['margemlucro_artigo'] : 0;

$linhas = json_decode($_POST['codigobarras_artigo'], true);

if(!$label_artigo || $label_artigo == "") $label_artigo = $nome_artigo;

$fitofarmaceuticos_artigo = $_POST['fitofarmaceuticos_artigo'] != '' ? $_POST['fitofarmaceuticos_artigo'] : '';

$foto_artigo = $_POST['foto_artigo'];

if(!$foto_artigo) $foto_artigo = "default.png";

$precocusto = $_POST['precocustoinicial_artigo'] ? $_POST['precocustoinicial_artigo'] : 0;

$linhasPrices = json_decode($_POST['prices_lines'], true);
$linhasSuppliers = json_decode($_POST['supplier_lines'], true);

/* PrestaShop */
$id_prestashop = isset($_POST['id_prestashop']) ? intval($_POST['id_prestashop']) : 0;

//CHECK IF IS A SYSTEM CODE / INVALID CODE
if( strtolower($codigo_artigo) == 'acertos' || strtolower($codigobarras_artigo) == 'acertos' ){
	$response["errors"] = true;
	$response["codigo"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000xA";
	$response["message"] = "Reserved code.";
	die(json_encode($response));
}
if( stringCleanerLNS($codigo_artigo) == false ){
	$response["errors"] = true;
	$response["codigo"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000xB";
	$response["message"] = "Invalid code.";
	die(json_encode($response));
}
//------------------------------------------------------------------------

//VERIFICA SE HA NULOS ---------------------------------------------------
if ( $codigo_artigo == '' || $nome_artigo == '' || $tipo_artigo == '' || $unidade_artigo == '' || $precoPVP_artigo == '' || $imposto_artigo == '' )
{
	// var_dump($codigo_artigo == '' , $nome_artigo == '' , $tipo_artigo == '' , $unidade_artigo == '' , $precoPVP_artigo == '' , $imposto_artigo == '');
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS0000A";
	$response["codigo_artigo"] = $codigo_artigo;
	$response["nome_artigo"] = $nome_artigo;
	$response["tipo_artigo"] = $tipo_artigo;
	$response["unidade_artigo"] = $unidade_artigo;
	$response["precoPVP_artigo"] = $precoPVP_artigo;
	$response["imposto_artigo"] = $imposto_artigo;
	die(json_encode($response));
}
if($retencao_valor_artigo > $precoPVP_artigo){
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS0000B";
	die(json_encode($response));
}

try {
	// Turn off AUTOCOMMIT and begin Transaction
	mysqli_autocommit($sqli_connection, FALSE);
	$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

	//CHECK ID_PrestaShop
	$id_artigo_ps_db=0; $id_motivo_ps_db=0;
	if($id_prestashop > 0) {
		//Search on Products
		$query = "SELECT ID_Artigo, id_motivo_isencao FROM faturacao_artigos WHERE ID_Prestashop=?;";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//bind params
			$stmt -> bind_param("d", $id_prestashop);
			//result single
			$result = $stmt -> execute();
			if (false === $result) { }
			$stmt -> bind_result($id_artigo_ps_db, $id_motivo_ps_db);
			$stmt -> fetch();
			$stmt -> close();
		} else { }

		//If Not Found, Check Article Code On DB And Add It
		if(intval($id_artigo_ps_db) < 1){
			$query = "UPDATE faturacao_artigos SET ID_Prestashop=? WHERE Codigo=? AND (ID_Prestashop IS NULL OR ID_Prestashop=0) LIMIT 1";
			if ($stmt = $sqli_connection -> prepare($query)) {
				$stmt -> bind_param("ds", $id_prestashop, $codigo_artigo );
				$result = $stmt -> execute();
				if (false === $result) { }
				$stmt -> close();
			} else { }

			//Search on Products Again
			$query = "SELECT ID_Artigo, id_motivo_isencao FROM faturacao_artigos WHERE ID_Prestashop=?;";
			if ( $stmt = $sqli_connection -> prepare($query) ) {
				//bind params
				$stmt -> bind_param("d", $id_prestashop);
				//result single
				$result = $stmt -> execute();
				if (false === $result) { }
				$stmt -> bind_result($id_artigo_ps_db, $id_motivo_ps_db);
				$stmt -> fetch();
				$stmt -> close();
			} else { }
		}
	}

	if(intval($id_artigo_ps_db) > 0){
		//response
		$response["errors"] = false;
		$response['idArtigo'] = $id_artigo_ps_db;
		$response['idMotivoIsencao'] = $id_motivo_ps_db;
		$response['isPrestashop'] = true;
		die(json_encode($response));
	}
	//-----------------------------------------------------------------------

	//RECALCULATE THE PRICE -------------------------------------------------
	$query = "SELECT Valor FROM faturacao_impostos WHERE ID_Imposto=?";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//bind params
		$stmt -> bind_param("d", $imposto_artigo);
		//result single
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS001";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> bind_result($taxaImposto);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS002";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//calculo da taxa
	$taxa = ($taxaImposto * 0.01) + 1;
	//-----------------------------------------------------------------------

	//VERIFICAR SE CODIGO EXISTE --------------------------------------------
	$query = "SELECT COUNT(*) FROM faturacao_artigos WHERE Codigo=?";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//bind params
		$stmt -> bind_param("s", $codigo_artigo);
		//result single
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS003";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> bind_result($counterCodigo);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS004";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	if($counterCodigo > 0){
		$response["errors"] = true;
		$response["codigo"] = true;
		$response["type"] = "var";
		$response["line"] = "FATS005";
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//-----------------------------------------------------------------------

	//VERIFICAR SE CODIGO BARRAS EXISTE -------------------------------------
	if($codigobarras_artigo != ''){
		$query = "SELECT COUNT(*) FROM faturacao_artigos WHERE CodigoBarras=?";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//bind params
			$stmt -> bind_param("s", $codigobarras_artigo);
			//result single
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS006";
				$response["message"] = $stmt -> error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$stmt -> bind_result($counterCodigoBarras);
			$stmt -> fetch();
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS007";
			$response["message"] = $sqli_connection -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		if($counterCodigoBarras > 0){
			$response["errors"] = true;
			$response["codigobarras"] = true;
			$response["type"] = "var";
			$response["line"] = "FATS008";
			$sqli_connection->rollback();
			die(json_encode($response));
		}
	}
	//-----------------------------------------------------------------------

	//INSERT DB -------------------------------------------------------------
	$query = "INSERT INTO faturacao_artigos (Nome, Codigo, Tipo, CodigoBarras, SerialNumber,ID_Categoria, ID_Unidade, Preco, ID_Imposto, PrecoPVP, RetencaoValor, RetencaoPercentagem, Stock, id_motivo_isencao, DescricaoLonga, imagem, LabelEtiqueta, EncomendaAqui, NumAVAPVFitoFarmac, DisponivelEmenta, StockMin, AlertaStockMinimo, ProcessarPorMargemLucro, PercentagemMargemLucro,AutoPreencherComentario) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("sssssddsdssssdsssdsdddddd", $nome_artigo, $codigo_artigo, $tipo_artigo, $codigobarras_artigo, $numeroserie_artigo, $categoria_artigo, $unidade_artigo, $preco_artigo, $imposto_artigo, $precoPVP_artigo, $retencao_valor_artigo, $retencao_percenteagem_artigo, $stock_artigo, $motivo_isencao_artigo, $observacoes_artigo, $foto_artigo, $label_artigo, $encomendaaqui_artigo, $fitofarmaceuticos_artigo, $disponivelementa_artigo, $stock_minimo, $alertaStockMin, $calcular_margem_unitario_artigo, $margemlucro_artigo,$autopreencher_comentario_artigo);
		$result = $stmt -> execute();
		$idArtigo = $stmt->insert_id;
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS009.1";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS010";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//-----------------------------------------------------------------------

	//UPDATE DB -------------------------------------------------------------
	$query = "UPDATE faturacao_artigos SET PrecoCusto=?, ID_Prestashop=? WHERE ID_Artigo=?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("sdd", $precocusto, $id_prestashop, $idArtigo );
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS000A";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS000B";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//----------------------------------------------------------------------

	/* if not exists barcodes */
	if(sizeof($linhas) < 1){
		$counterCodigoBarras2 = 0;
		$query = "SELECT COUNT(*) FROM faturacao_artigos_codigo_barras WHERE CodigoBarras=?";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//bind params
			$stmt -> bind_param("s", $codigobarras_artigo);
			//result single
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS006";
				$response["message"] = $stmt -> error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$stmt -> bind_result($counterCodigoBarras2);
			$stmt -> fetch();
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS007";
			$response["message"] = $sqli_connection -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		if($counterCodigoBarras2 > 0){
			$codigobarras_artigo = $codigobarras_artigo.'_'.time();
		}

		$linhas[] = array(
			'codigo' => $codigobarras_artigo
		);
	}

	foreach ($linhas as $linha) {
		$cod_barras = $linha['codigo'];
		if($linha['codigo'] != ''){
			$query = "SELECT COUNT(*) FROM faturacao_artigos_codigo_barras WHERE CodigoBarras=?";
			if ( $stmt = $sqli_connection -> prepare($query) ) {
				//bind params
				$stmt -> bind_param("s", $cod_barras);
				//result single
				$result = $stmt -> execute();
				if (false === $result) {
					$response["errors"] = true;
					$response["type"] = "query";
					$response["line"] = "FATS006";
					$response["message"] = $stmt -> error;
					$sqli_connection->rollback();
					die(json_encode($response));
				}
				$stmt -> bind_result($counterCodigoBarras);
				$stmt -> fetch();
				$stmt -> close();
			} else {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS007";
				$response["message"] = $sqli_connection -> error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			if($counterCodigoBarras > 0){
				$response["errors"] = true;
				$response["codigobarras"] = true;
				$response["type"] = "var";
				$response["line"] = "FATS008";
				$sqli_connection->rollback();
				die(json_encode($response));
			}
		}

		$query = "INSERT INTO faturacao_artigos_codigo_barras (ID_Artigo,CodigoBarras) values (?,?) ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("ss",$idArtigo,$cod_barras);
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS00L1";
				$response["message"] = $stmt -> error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS00L2";
			$response["message"] = $sqli_connection -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
	}

	foreach ($linhasPrices as $linha) {
		$imposto = $linha['imposto'];
		$preco = floatval($linha['preco']);
		$precoPvp = floatval($linha['precoPvp']);

		$query = "INSERT INTO faturacao_artigos_precos(ID_Artigo, Preco, ID_Imposto, PrecoPVP) VALUES(?,?,?,?)";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("dsds", $idArtigo, $preco, $imposto, $precoPvp );
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS00L3";
				$response["message"] = $stmt -> error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS00L4";
			$response["message"] = $sqli_connection -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
	}

	foreach ($linhasSuppliers as $linha) {
		$fornecedor = $linha['fornecedor'];
		$referencia = $linha['referencia'];
	}
	//-----------------------------------------------------------------------

	//VERIFICAR SE IMPOSTO JÁ BLOQUEADO -------------------------------------
	$query = "SELECT COUNT(*) FROM faturacao_impostos_usados WHERE ID_Imposto=?";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//bind params
		$stmt -> bind_param("d", $imposto_artigo);
		//result single
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS011";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> bind_result($impostoUsed);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS012";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	if($impostoUsed < 1){
		//INSERT DB ---------------------------------------------------------
		$query = "INSERT INTO faturacao_impostos_usados(ID_Imposto) VALUES (?)";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("d", $imposto_artigo );
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS013";
				$response["message"] = $stmt -> error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS014";
			$response["message"] = $sqli_connection -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		//-------------------------------------------------------------------
	}
	//-----------------------------------------------------------------------

	//INSERT LOG ARTICLES ---------------------------------------------------
	$acaoDesc = 'Criação do artigo';
	insert_log_artigo($idArtigo, $acaoDesc, 0, null, 0, $stock_artigo, $sqli_connection);
	//-----------------------------------------------------------------------

	//log sistema
	$descricao_log ="Artigo: Criação (cód: ".$codigo_artigo.")";
	insert_log(14,"Inserir",$descricao_log,$sqli_connection);

	// Save all querys on DB
	$sqli_connection->commit();
} catch (Exception $e) {
	$sqli_connection->rollback();

	$response["errors"] = true;
	$response["type"] = "transaction";
	$response["line"] = "DB001";
	$response["message"] = $e->getMessage();
	die(json_encode($response));
}

//response
$response["errors"] = false;
$response['idArtigo'] = $idArtigo;
die(json_encode($response));
?>
