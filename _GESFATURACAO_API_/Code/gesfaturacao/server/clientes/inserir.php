<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];
$idCliente = 0;

//VALIDATE NIF FUNCTION -------------------------------------------------
function validaNIF($nif, $ignoreFirst=true) {
	//Limpamos eventuais espaços a mais
	$nif=trim($nif);
	//Verificamos se é numérico e tem comprimento 9
	if (!is_numeric($nif) || strlen($nif)!=9) {
		return false;
	} else {
		$nifSplit=str_split($nif);
		//O primeiro digíto tem de ser 1, 2, 5, 6, 8 ou 9
		//Ou não, se optarmos por ignorar esta "regra"
		if ( in_array($nifSplit[0], array(1, 2, 3, 5, 6, 7, 8, 9))	||	$ignoreFirst ) {
			//Calculamos o dígito de controlo
			$checkDigit=0;
			for($i=0; $i<8; $i++) {
				$checkDigit+=$nifSplit[$i]*(10-$i-1);
			}
			$checkDigit=11-($checkDigit % 11);
			//Se der 10 então o dígito de controlo tem de ser 0
			if($checkDigit>=10) $checkDigit=0;
			//Comparamos com o último dígito
			if ($checkDigit==$nifSplit[8]) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

//GET POST VARS ---------------------------------------------------------
$nome_cliente = $_POST['nome_cliente'] != '' ? $_POST['nome_cliente'] : 'Consumidor Final';
$nif_cliente = $_POST['nif_cliente'];
$pais_cliente = $_POST['pais_cliente'];
$endereco_cliente = $_POST['endereco_cliente'];
$codigopostal_cliente = $_POST['codigopostal_cliente'];
$localidade_cliente = $_POST['localidade_cliente'];
$regiao_cliente = $_POST['regiao_cliente'];
$cidade_cliente = $_POST['cidade_cliente'];
// $grupo_cliente = $_POST['grupo_cliente'];
$grupo_cliente = 0;
$email_cliente = $_POST['email_cliente'];
$website_cliente = $_POST['website_cliente'];
$tlm_cliente = $_POST['tlm_cliente'];
$tlf_cliente = $_POST['tlf_cliente'];
$fax_cliente = $_POST['fax_cliente'];
$preferencial_nome_cliente = $_POST['preferencial_nome_cliente'];
$preferencial_email_cliente = $_POST['preferencial_email_cliente'];
$preferencial_tlm_cliente = $_POST['preferencial_tlm_cliente'];
$preferencial_tlf_cliente = $_POST['preferencial_tlf_cliente'];
$pagamento_cliente = $_POST['pagamento_cliente'];
$vencimento_Cliente = $_POST['vencimento_Cliente'];
$desconto_cliente = $_POST['desconto_cliente'];
$flagContaGeral = $_POST['flagContaGeral'];
$codigoInterno = $_POST['codigo_interno_cliente'];

$isento_iva = $_POST['isento_iva'] == "true" ? 1 : 0;
$motivo_isencao_iva = $_POST['motivo_isencao_iva'];
$fitofarmaceuticos_cliente = $_POST['fitofarmaceuticos_cliente'] != '' ? $_POST['fitofarmaceuticos_cliente'] : '';
$observacoes_cliente = $_POST['observacoes_cliente'] != '' ? $_POST['observacoes_cliente'] : '';

//VERIFICA SE HA NULOS ---------------------------------------------------
if ( /*$nome_cliente == '' ||*/ $pais_cliente == '' )
{
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000";
	die(json_encode($response));
}

try {
	// Turn off AUTOCOMMIT and begin Transaction
	mysqli_autocommit($sqli_connection, FALSE);
	$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

	//GET SNC TABLE IN USE --------------------------------------------------
	$snc_table = getSncBaseTable();
	$code = '';
	if($snc_table == 'faturacao_snc_base'){$code = '2111';}
	elseif($snc_table == 'faturacao_snc_micro'){$code = '211';}
	else{
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS000";
		$response["message"] = 'SNC - tabela invalida';
		$sqli_connection->rollback();
		die(json_encode($response));
	}

	//VALIDATE NIF -----------------------------------------------------------
	if($pais_cliente == 'PT' && !is_numeric($nif_cliente)) $nif_cliente = '999999990';
	if($pais_cliente == 'PT' && $nif_cliente > 0){
		$validNIF = validaNIF($nif_cliente, false);
		if($validNIF == false){
			$response["errors"] = true;
			$response["type"] = "var";
			$response["nif_error"] = true;
			$response["line"] = "FATS001";
			$sqli_connection->rollback();
			die(json_encode($response));
		}
	}

	if($nif_cliente == ''){
		$nif_cliente = '999999990';
	}

	 if($nif_cliente != '999999990' && $nif_cliente > 0){
	 	//CHECK IF NIF EXISTS
	 	$query = "SELECT COUNT(*) FROM faturacao_clientes WHERE Nif = ? AND Ativo = 1 AND ID_UserAtual IS NULL AND Esquecer = 0";
	 	if ( $stmt = $sqli_connection -> prepare($query) ) {
		    $stmt -> bind_param("s", $nif_cliente);
	 		//result
	 		$result = $stmt -> execute();
	 		if (false === $result) {
	 			$response["errors"] = true;
	 			$response["type"] = "FATS001A";
	 			$response["message"] = $stmt -> error;
	 			$sqli_connection->rollback();
	 			die(json_encode($response));
	 		}
	 		$stmt -> store_result();
	 		$stmt -> bind_result($counterNif);
	 		$stmt -> fetch();
	 		$stmt -> close();
	 	} else {
	 		$response["errors"] = true;
	 		$response["type"] = "FATS001B";
	 		$response["message"] = $sqli_connection -> error;
	 		$sqli_connection->rollback();
	 		die(json_encode($response));
	 	}
		 //IF NIF EXISTS
		 if($counterNif > 0){
			 $response["errors"] = true;
			 $response["type"] = "var";
			 $response["duplicated_nif_error"] = true;
			 $response["line"] = "FATS001C";
			 $sqli_connection->rollback();
			 die(json_encode($response));
		 }
	}

	//PROCESS CITY AND REGION -----------------------------------------------
	if($pais_cliente == 'PT'){
		$regiao_cliente = getRegiaoPortugal($regiao_cliente);
		$cidade_cliente = getCidadePortugal($cidade_cliente);
	}

	//GET ACCOUNT ID --------------------------------------------------------
	$idSncBase = 0;

	$idAccount = 0;

	//PROCESS FIELDS -------------------------------------------------------------
	$finalMetPagamento = $pagamento_cliente;
	if($pagamento_cliente == '-'){
		$finalMetPagamento = 1;
	}

	$finalVencimento = $vencimento_Cliente;
	if($vencimento_Cliente == '-'){
		$finalVencimento = 0;
	}
	//----------------------------------------------------------------------------

	//GET NEXT CODIGO CLIENTE ----------------------------------------------------
	$query = "SELECT MAX(CAST(Codigo AS UNSIGNED)) FROM faturacao_clientes";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HELP001";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> store_result();
		$stmt -> bind_result($nextID);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "HELP002";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//return next id
	$codigoCliente = $nextID+1;
	if($codigoInterno == '' || !$codigoInterno) $codigoInterno = $nextID+1;

	$timestampCliente = microtime(true);

	//INSERT DB ------------------------------------------------------------------
	$query = "INSERT INTO faturacao_clientes (
		Nome, 
		Nif, 
		Codigo, 
		CodigoInterno, 
		Endereco, 
		CodigoPostal, 
		Localidade, 
		Cidade, 
		Pais, 
		Regiao, 
		Email, 
		Telefone, 
		Telemovel, 
		Fax, 
		Website, 
		ID_Grupo, 
		MetPagamento, 
		Vencimento, 
		Desconto, 
		PreferenciaNome, 
		PreferenciaTelefone, 
		PreferenciaEmail, 
		PreferenciaTelemovel, 
		ID_Account,
		TimestampCliente,
		NumAtividadeFitoFarmac,
		ObservacoesCliente
		) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("ssdssssssssssssdsssssssdsss",
		    $nome_cliente,
			$nif_cliente,
			$codigoCliente,
			$codigoInterno,
			$endereco_cliente,
			$codigopostal_cliente,
			$localidade_cliente,
			$cidade_cliente,
			$pais_cliente,
			$regiao_cliente,
			$email_cliente,
			$tlf_cliente,
			$tlm_cliente,
			$fax_cliente,
			$website_cliente,
			$grupo_cliente,
			$finalMetPagamento,
			$finalVencimento,
			$desconto_cliente,
			$preferencial_nome_cliente,
			$preferencial_tlf_cliente,
			$preferencial_email_cliente,
			$preferencial_tlm_cliente,
			$idAccount,
			$timestampCliente ,
			$fitofarmaceuticos_cliente,
			$observacoes_cliente
		);
		$result = $stmt -> execute();
		$idCliente = $stmt->insert_id;
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS003";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS004";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//--------------------------------------------------------------------------

	//UPDATE DB ----------------------------------------------------------------
	$query = "UPDATE faturacao_clientes SET
		IsentoIVA=?, 
		MotivoIsencaoIVA=?
		WHERE ID_Cliente = ?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("ddd",
			$isento_iva,
			$motivo_isencao_iva,
			$idCliente
		);
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS005";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS006";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//--------------------------------------------------------------------------

	//log sistema
	$descricao_log ="Cliente: Criação ( cód. ".$codigoCliente." | nome: ".$nome_cliente.")";
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
$response["id_cliente"] = $idCliente;
die(json_encode($response));
?>
