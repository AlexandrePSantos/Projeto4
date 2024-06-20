<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//VALIDATE NIF FUNCTION -------------------------------------------------
function validaNIF($nif, $ignoreFirst = true)
{
	//Limpamos eventuais espaços a mais
	$nif = trim($nif);
	//Verificamos se é numérico e tem comprimento 9
	if (!is_numeric($nif) || strlen($nif) != 9) {
		return false;
	} else {
		$nifSplit = str_split($nif);
		//O primeiro digíto tem de ser 1, 2, 5, 6, 8 ou 9
		//Ou não, se optarmos por ignorar esta "regra"
		if (in_array($nifSplit[0], array(1, 2, 3, 5, 6, 7, 8, 9)) || $ignoreFirst) {
			//Calculamos o dígito de controlo
			$checkDigit = 0;
			for ($i = 0; $i < 8; $i++) {
				$checkDigit += $nifSplit[$i] * (10 - $i - 1);
			}
			$checkDigit = 11 - ($checkDigit % 11);
			//Se der 10 então o dígito de controlo tem de ser 0
			if ($checkDigit >= 10) $checkDigit = 0;
			//Comparamos com o último dígito
			if ($checkDigit == $nifSplit[8]) {
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
$idCliente = $_POST['idCliente'];
$nome_cliente = $_POST['nome_cliente'] != '' ? $_POST['nome_cliente'] : 'Desconhecido';
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
$motivo_isencao_iva = $_POST['motivo_isencao_iva'] ? $_POST['motivo_isencao_iva'] : 0;
$fitofarmaceuticos_cliente = $_POST['fitofarmaceuticos_cliente'] != '' ? $_POST['fitofarmaceuticos_cliente'] : '';
$observacoes_cliente = $_POST['observacoes_cliente'] != '' ? $_POST['observacoes_cliente'] : '';

//VERIFICA SE HA NULOS ---------------------------------------------------
if ($idCliente == '' /*|| $nome_cliente == ''*/ || $pais_cliente == '') {
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000";
	die(json_encode($response));
}

//VERIFICA SE É O CLIENTE GERAL ------------------------------------------
if ($idCliente == 1 || $idCliente == "1") {
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000A";
	$response["cliente_sistema"] = true;
	$response["message"] = "Não é possível editar o cliente geral do sistema!";
	die(json_encode($response));
}

# PROCESS
try {
	// Turn off AUTOCOMMIT and begin Transaction
	mysqli_autocommit($sqli_connection, FALSE);
	$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

	//GET DADOS DB FOR LOGS PURPOSES --------------------------------------
	$query = "SELECT Codigo FROM faturacao_clientes WHERE ID_Cliente=?";
	if ($stmt = $sqli_connection->prepare($query)) {
		//bind params
		$stmt->bind_param("d", $idCliente);
		//result single
		$result = $stmt->execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "SPC0001";
			$response["message"] = $stmt->error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt->bind_result($CodClienteDB);
		$stmt->fetch();
		$stmt->close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "SPC0001";
		$response["message"] = $sqli_connection->error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//--------------------------------------------------------------------

	//GET SNC TABLE IN USE --------------------------------------------------
	$snc_table = getSncBaseTable();
	$code = '';
	if ($snc_table == 'faturacao_snc_base') {
		$code = '2111';
	} elseif ($snc_table == 'faturacao_snc_micro') {
		$code = '211';
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS000";
		$response["message"] = 'SNC - tabela invalida';
		$sqli_connection->rollback();
		die(json_encode($response));
	}

	//PROCESS CITY AND REGION -----------------------------------------------
	if ($pais_cliente == 'PT') {
		$regiao_cliente = getRegiaoPortugal($regiao_cliente);
		$cidade_cliente = getCidadePortugal($cidade_cliente);
	}

	//CHECK IF USED ----------------------------------------------------------
	$query = "SELECT ID_Account, Usado, 0, Esquecer, Codigo, CodigoInterno, Nome, Nif FROM faturacao_clientes WHERE ID_Cliente = ?";
	if ($stmt = $sqli_connection->prepare($query)) {
		$stmt->bind_param("d", $idCliente);
		$result = $stmt->execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "FTGA002";
			$response["line"] = "FTGA002";
			$response["message"] = $stmt->error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt->bind_result($idAccountAtual, $usadoCliente, $contaGeralCliente, $esquecer, $codCliente, $codInternoCliente, $nome_cliente_atual, $nif_cliente_atual);
		$stmt->fetch();
		$stmt->close();
	} else {
		$response["errors"] = true;
		$response["type"] = "FTGA003";
		$response["line"] = "FTGA003";
		$response["message"] = $sqli_connection->error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}

	if ($esquecer > 0) {
		$response["errors"] = true;
		$response["type"] = "FTGA008";
		$response["line"] = "FTGA008";
		$sqli_connection->rollback();
		die(json_encode($response));
	}

	//process codigo interno
	if ($codigoInterno == '' || !$codigoInterno) $codigoInterno = $codInternoCliente;


	//PROCESS FIELDS -------------------------------------------------------------
	$finalMetPagamento = $pagamento_cliente;
	if ($pagamento_cliente == '-') {
		$finalMetPagamento = 1;
	}

	$finalVencimento = $vencimento_Cliente;
	if ($vencimento_Cliente == '-') {
		$finalVencimento = 0;
	}
	//----------------------------------------------------------------------------

	//VALIDATE NIF -----------------------------------------------------------
	if ($pais_cliente == 'PT' && !is_numeric($nif_cliente)) $nif_cliente = '999999990';
	if ($pais_cliente == 'PT' && $nif_cliente > 0) {
		$validNIF = validaNIF($nif_cliente, false);
		if ($validNIF == false) {
			$response["errors"] = true;
			$response["type"] = "var";
			$response["nif_error"] = true;
			$response["line"] = "FATS001";
			$sqli_connection->rollback();
			die(json_encode($response));
		}
	}

	if ($nif_cliente == '') {
		$nif_cliente = '999999990';
	}

	//DECIDE HOW TO UPDATE ---------------------------------------------------
	if ($usadoCliente > 0) {

		if ($nome_cliente_atual != $nome_cliente || $nif_cliente_atual != $nif_cliente) {
			//CREATE NEW USER ----------------------------------------------------------

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
			$codigoCliente = $nextID + 1;
			$timestampCliente = microtime(true);
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
						ObservacoesCliente) 
					VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			if ($stmt = $sqli_connection->prepare($query)) {
				$stmt->bind_param("ssdssssssssssssdsssssssdsss",
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
					$idAccountAtual,
					$timestampCliente,
					$fitofarmaceuticos_cliente,
					$observacoes_cliente
				);
				$result = $stmt->execute();
				$idNovoCliente = $stmt->insert_id;
				if (false === $result) {
					$response["errors"] = true;
					$response["type"] = "query";
					$response["line"] = "FATS003";
					$response["message"] = $stmt->error;
					$sqli_connection->rollback();
					die(json_encode($response));
				}
				$stmt->close();
			} else {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS004";
				$response["message"] = $sqli_connection->error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$Ativo = 0;
			$query = "UPDATE faturacao_clientes SET ID_UserAtual=?, ID_Relacao=?, DataAtualizacao=?,Ativo=? WHERE ID_Cliente=?";
			if ($stmt = $sqli_connection->prepare($query)) {
				$stmt->bind_param("sssss",$idNovoCliente,$idNovoCliente,$timestampCliente,$Ativo,$idCliente);
				$result = $stmt->execute();
				if (false === $result) {
					$response["errors"] = true;
					$response["type"] = "query";
					$response["line"] = "FATU001";
					$response["message"] = $stmt->error;
					$sqli_connection->rollback();
					die(json_encode($response));
				}
				$stmt->close();
			} else {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATU002";
				$response["message"] = $sqli_connection->error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}

			$query = "UPDATE faturacao_clientes SET ID_UserAtual=? WHERE ID_UserAtual=?";
			if ($stmt = $sqli_connection->prepare($query)) {
				$stmt->bind_param("ss",$idNovoCliente,$idCliente);
				$result = $stmt->execute();
				if (false === $result) {
					$response["errors"] = true;
					$response["type"] = "query";
					$response["line"] = "FATU003";
					$response["message"] = $stmt->error;
					$sqli_connection->rollback();
					die(json_encode($response));
				}
				$stmt->close();
			} else {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATU004";
				$response["message"] = $sqli_connection->error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}

			//--------------------------------------------------------------------------
		} else {
			//UPDATE DB ----------------------------------------------------------
			$query = "UPDATE faturacao_clientes SET
			Endereco=?, 
			CodigoPostal=?, 
			Localidade=?, 
			Cidade=?, 
			Regiao=?, 
			Email=?, 
			Telefone=?, 
			Telemovel=?, 
			Fax=?, 
			Website=?, 
			ID_Grupo=?, 
			MetPagamento=?, 
			Vencimento=?, 
			Desconto=?, 
			PreferenciaNome=?, 
			PreferenciaTelefone=?, 
			PreferenciaEmail=?, 
			PreferenciaTelemovel=?,
			CodigoInterno=? 
			WHERE ID_Cliente = ?";
			if ($stmt = $sqli_connection->prepare($query)) {
				$stmt->bind_param("ssssssssssdssssssssd",
					$endereco_cliente,
					$codigopostal_cliente,
					$localidade_cliente,
					$cidade_cliente,
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
					$codigoInterno,
					$idCliente
				);
				$result = $stmt->execute();
				if (false === $result) {
					$response["errors"] = true;
					$response["type"] = "query";
					$response["line"] = "FATS003";
					$response["message"] = $stmt->error;
					$sqli_connection->rollback();
					die(json_encode($response));
				}
				$stmt->close();
			} else {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS004";
				$response["message"] = $sqli_connection->error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			//--------------------------------------------------------------------
		}

	} else {

		// if($nif_cliente != '999999990' && $nif_cliente > 0){
		// 	//CHECK IF NIF EXISTS
		// 	$query = "SELECT COUNT(*) FROM faturacao_clientes WHERE ID_Cliente <> ".$idCliente." AND Nif = ".$nif_cliente;
		// 	if ( $stmt = $sqli_connection -> prepare($query) ) {
		// 		//result
		// 		$result = $stmt -> execute();
		// 		if (false === $result) {
		// 			$response["errors"] = true;
		// 			$response["type"] = "FATS001A";
		// 			$response["message"] = $stmt -> error;
		// 			$sqli_connection->rollback();
		// 			die(json_encode($response));
		// 		}
		// 		$stmt -> store_result();
		// 		$stmt -> bind_result($counterNif);
		// 		$stmt -> fetch();
		// 		$stmt -> close();
		// 	} else {
		// 		$response["errors"] = true;
		// 		$response["type"] = "FATS001B";
		// 		$response["message"] = $sqli_connection -> error;
		// 		$sqli_connection->rollback();
		// 		die(json_encode($response));
		// 	}

		// 	if($counterNif > 0){
		// 		$response["errors"] = true;
		// 		$response["type"] = "var";
		// 		$response["nif_error"] = true;
		// 		$response["line"] = "FATS001C";
		// 		$sqli_connection->rollback();
		// 		die(json_encode($response));
		// 	}
		// }

		//GET ACCOUNT ID --------------------------------------------------------
		$idSncBase = 0;

		$idAccount = 0;

		//PROCESS FIELDS -------------------------------------------------------------
		//$finalMetPagamento = $pagamento_cliente;
		//$finalVencimento = $vencimento_Cliente;
		//----------------------------------------------------------------------------

		//INSERT DB ------------------------------------------------------------------
		$query = "UPDATE faturacao_clientes SET
			Nome=?, 
			Nif=?, 
			Endereco=?, 
			CodigoPostal=?, 
			Localidade=?, 
			Cidade=?, 
			Pais=?, 
			Regiao=?, 
			Email=?, 
			Telefone=?, 
			Telemovel=?, 
			Fax=?, 
			Website=?, 
			ID_Grupo=?, 
			MetPagamento=?, 
			Vencimento=?, 
			Desconto=?, 
			PreferenciaNome=?, 
			PreferenciaTelefone=?, 
			PreferenciaEmail=?, 
			PreferenciaTelemovel=?,
			CodigoInterno=?,
			ID_Account=?
			WHERE ID_Cliente = ?";
		if ($stmt = $sqli_connection->prepare($query)) {
			$stmt->bind_param("ssssssssssssssssssssssdd",
				$nome_cliente,
				$nif_cliente,
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
				$codigoInterno,
				$idAccount,
				$idCliente
			);
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "query";
				$response["line"] = "FATS003";
				$response["message"] = $stmt->error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS004";
			$response["message"] = $sqli_connection->error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		//--------------------------------------------------------------------------
	}
	//------------------------------------------------------------------------

	//UPDATE DB ----------------------------------------------------------------
	$query = "UPDATE faturacao_clientes SET
		IsentoIVA=?, 
		MotivoIsencaoIVA=?,
		NumAtividadeFitoFarmac=?,
		ObservacoesCliente=?
		WHERE ID_Cliente = ?";
	if ($stmt = $sqli_connection->prepare($query)) {
		$stmt->bind_param("ddssd",
			$isento_iva,
			$motivo_isencao_iva,
			$fitofarmaceuticos_cliente,
			$observacoes_cliente,
			$idCliente
		);
		$result = $stmt->execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS005";
			$response["message"] = $stmt->error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt->close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS006";
		$response["message"] = $sqli_connection->error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//--------------------------------------------------------------------------

	//log sistema
	$descricao_log = "Cliente: Edição ( cód: " . $CodClienteDB . " | nome: " . $nome_cliente . ")";
	insert_log(14, "Editar", $descricao_log, $sqli_connection);

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
$response['new_user'] = $idNovoCliente;
die(json_encode($response));
?>
