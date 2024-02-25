<?php
// $helpersFile = true;

/**
 * |-----------------------------------------------------------------------
 * |
 * |					Helper Functions POS
 * |
 * | Functions to be used anytime, anywhere. Just like a service provider.
 * |
 * |-----------------------------------------------------------------------
 */

/**
 * Check if user is POS
 * @param  [no params]
 * @return bool
 */
function isPosUser(){
	global $sqli_connection;
	$isPos = false;

	//process
	$query = "SELECT UtilizadorPOS FROM utilizador WHERE ID_Utilizador = ".$_SESSION['id_utilizador']." LIMIT 1";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS001";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> store_result();
		$stmt -> bind_result($valPOS);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "HPOS002";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}

	if( $valPOS == 1 ) $isPos = true;
	else $isPos = false;

	return $isPos;
}

/**
 * Check if posto is open
 * @param  $idPosto
 * @return bool
 */
function checkIfOpenPOS($idPosto = null){
	global $sqli_connection;
	$isOpen = false;

	//process
	$query = "SELECT Estado FROM faturacao_postos WHERE ID_Posto = ".$idPosto."";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS003";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> store_result();
		$stmt -> bind_result($estadoPOS);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "HPOS004";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}

	if( $estadoPOS == 'Aberto') $isOpen = true;
	else $isOpen = false;

	return $isOpen;
}

/**
 * Check if posto is active
 * @param  $idPosto
 * @return bool
 */
function checkIfActivePOS($idPosto = null){
	global $sqli_connection;
	$isActive = false;

	//process
	$query = "SELECT Ativo FROM faturacao_postos WHERE ID_Posto = ".$idPosto."";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS005";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> store_result();
		$stmt -> bind_result($ativoPOS);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "HPOS006";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}

	if( $ativoPOS == 1) $isActive = true;
	else $isActive = false;

	return $isActive;
}

/**
 * Check if POS is locked
 * @return state
 */
function isLockedPOS(){
	global $sqli_connection;
	$isLocked = 'logout';

	//process
	if (isset($_SESSION['BLOCK_POS'])) {
		if ($_SESSION['BLOCK_POS'] == true) {
			$isLocked = 'true';
		}else{
			$isLocked = 'false';
		}
	}else{
		$isLocked = 'logout';
	}

	return $isLocked;
}

/**
 * LOCK POS
 * @return bool
 */
function lock_POS(){
	global $sqli_connection;
	$success = true;

	//process
	$_SESSION['BLOCK_POS'] = true;

	return $success;
}

/**
 * Inserir abertura de caixa > TipoMovimento: 1
 * @param  $idPosto
 * @param  $acao > [ Abertura | Entrada | Saída | Fecho | Documento | Outro ]
 * @param  $valorDin
 * @param  $valorMB
 * @param  $valorCC
 * @param  $valorCH
 * @param  $valorPD
 * @param  $valorCO
 * @param  $valorVR
 * @param  $valorTotal
 * @return bool
 */
function inserirAberturaPOS($idPosto, $acao, $valorDin = 0, $valorMB = 0, $valorCC = 0, $valorCH = 0, $valorPD = 0, $valorCO = 0, $valorVR = 0, $valorTotal = 0){
	global $sqli_connection;
	$resultado = true;
	$idMovimento = 0;

	//prepare remaining vars
	$idUtilizador = $_SESSION['id_utilizador'];
	$username = $_SESSION['username'];
	// $data = date("d/m/Y H:i:s");
	// $tmpDT = DateTime::createFromFormat('d/m/Y', $DataMovimento);
	$data = date('d/m/Y H:i:s');
	$timestamp = microtime(true);

	//PREPARE SOME VARS
	$randomSalt = generateRandString(2);
	$codeInternal = str_replace(".", $randomSalt, $timestamp);
	$tipoMovimento = 1;

	//INSERT RECORD
	$query = "INSERT INTO faturacao_postos_movimentos_caixa 
				(ID_Posto, ID_Utilizador, Username, Acao, ValorDinheiro, ValorMB, ValorCC, ValorCH, ValorPD, ValorCO, ValorVR, ValorTotal, DataOperacao, TimestampMov, CodAbertura, TipoMovimento ) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("ssssssssssssssss",
		                    $idPosto,
		                    $idUtilizador,
		                    $username,
		                    $acao,
		                    $valorDin,
		                    $valorMB,
		                    $valorCC,
		                    $valorCH,
		                    $valorPD,
		                    $valorCO,
		                    $valorVR,
		                    $valorTotal,
		                    $data,
		                    $timestamp,
		                    $codeInternal,
		                    $tipoMovimento
		        );
		$result = $stmt -> execute();
		$idMovimento = $stmt -> insert_id;
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "HPOS007";
			$response["message"] = $stmt -> error;

			$resultado = false;
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "HPOS008";
		$response["message"] = $sqli_connection -> error;

		$resultado = false;
		die(json_encode($response));
	}

	//return result
	return $resultado;
}

/**
 * Inserir fecho de caixa > TipoMovimento: 2
 * @param  $idPosto
 * @param  $acao > [ Abertura | Entrada | Saída | Fecho | Documento | Outro ]
 * @param  $valorDin
 * @param  $valorMB
 * @param  $valorCC
 * @param  $valorCH
 * @param  $valorPD
 * @param  $valorCO
 * @param  $valorVR
 * @param  $valorTotal
 * @param  $codAbertura
 * @return bool
 */
function inserirFechoPOS($idPosto, $acao, $valorDin = 0, $valorMB = 0, $valorCC = 0, $valorCH = 0, $valorPD = 0, $valorCO = 0, $valorVR = 0, $valorTotal = 0, $codAbertura = null){
	global $sqli_connection;
	$resultado = true;
	$idMovimento = 0;
	$countClose = 0;

	//prepare remaining vars
	$idUtilizador = $_SESSION['id_utilizador'];
	$username = $_SESSION['username'];
	// $data = date("d/m/Y H:i:s");
	// $tmpDT = DateTime::createFromFormat('d/m/Y', $DataMovimento);
	$data = date('d/m/Y H:i:s');
	$timestamp = microtime(true);

	//PREPARE SOME VARS
	$codeInternal = $codAbertura;
	$tipoMovimento = 2;

	//CHECK IF IS VALID
	$query2 = "SELECT COUNT(*) FROM faturacao_postos_movimentos_caixa WHERE ID_Posto=? AND CodAbertura=? AND TipoMovimento=2 ORDER BY ID_Movimento DESC LIMIT 1";
	if ($stmt2 = $sqli_connection -> prepare($query2)) {
		//bind params
		$stmt2 -> bind_param('ds', $idPosto,$codInterno);
		//result
		$result = $stmt2 -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS006A";
			$response["message"] = $stmt2 -> error;
			die(json_encode($response));
		}
		$stmt2 -> bind_result($countClose);
		$stmt2 -> fetch();
		$stmt2 -> close();
	} else {
		$response["errors"] = true;
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}
	if($countClose > 0){
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "HPOS006B";
		$response["message"] = $sqli_connection -> error;

		$resultado = false;
		die(json_encode($response));
	}

	//INSERT RECORD
	$query = "INSERT INTO faturacao_postos_movimentos_caixa 
				(ID_Posto, ID_Utilizador, Username, Acao, ValorDinheiro, ValorMB, ValorCC, ValorCH, ValorPD, ValorCO, ValorVR, ValorTotal, DataOperacao, TimestampMov, CodAbertura, TipoMovimento ) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("ssssssssssssssss",
		                    $idPosto,
		                    $idUtilizador,
		                    $username,
		                    $acao,
		                    $valorDin,
		                    $valorMB,
		                    $valorCC,
		                    $valorCH,
		                    $valorPD,
		                    $valorCO,
		                    $valorVR,
		                    $valorTotal,
		                    $data,
		                    $timestamp,
		                    $codeInternal,
		                    $tipoMovimento
		        );
		$result = $stmt -> execute();
		$idMovimento = $stmt -> insert_id;
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "HPOS007A";
			$response["message"] = $stmt -> error;

			$resultado = false;
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "HPOS008A";
		$response["message"] = $sqli_connection -> error;

		$resultado = false;
		die(json_encode($response));
	}

	//return result
	return $resultado;
}

/**
 * Inserir movimento caixa - positivo
 * @param  $idPosto
 * @param  $acao > [ Abertura | Entrada | Saída | Fecho | Documento | Outro ]
 * @param  $valorDin
 * @param  $valorMB
 * @param  $valorCC
 * @param  $valorCH
 * @param  $valorPD
 * @param  $valorCO
 * @param  $valorVR
 * @param  $valorTotal
 * @param  $codAbertura
 * @param  $tipoMovimento > [ 1 - Abertura | 2 - Fecho | 3 - Entrada/Saída | 4 - Documento | 5 - Outros	]
 * @param  $idDocumento
 * @param  $tipoDocumento
 * @param  $refDocumento
 * @param  $descAdicional
 * @return bool
 */
function inserirMovimentoPositivoPOS($idPosto, $acao, $valorDin = 0, $valorMB = 0, $valorCC = 0, $valorCH = 0, $valorPD = 0, $valorCO = 0, $valorVR = 0, $valorTotal = 0, $codAbertura = null, $tipoMovimento = null, $idDocumento = null, $tipoDocumento = null, $refDocumento = null, $descAdicional = null,$troco = 0, $metodoExcelente = null,$id_mesa = 0){
	global $sqli_connection;
	$resultado = true;

	//prepare remaining vars
	$idUtilizador = $_SESSION['id_utilizador'];
	$username = $_SESSION['username'];
	// $data = date("d/m/Y H:i:s");
	// $tmpDT = DateTime::createFromFormat('d/m/Y', $DataMovimento);
	$data = date('d/m/Y H:i:s');
	$timestamp = microtime(true);

	//CHECK IF IS VALID
	$countClose = 0;
	$query2 = "SELECT COUNT(*) FROM faturacao_postos_movimentos_caixa WHERE ID_Posto=? AND CodAbertura=? AND TipoMovimento=2 ORDER BY ID_Movimento DESC LIMIT 1";
	if ($stmt2 = $sqli_connection -> prepare($query2)) {
		//bind params
		$stmt2 -> bind_param('ds', $idPosto,$codAbertura);
		//result
		$result = $stmt2 -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS007BA";
			$response["message"] = $stmt2 -> error;
			die(json_encode($response));
		}
		$stmt2 -> bind_result($countClose);
		$stmt2 -> fetch();
		$stmt2 -> close();
	} else {
		$response["errors"] = true;
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}
	if($countClose > 0){
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "HPOS007BB";
		$response["message"] = $sqli_connection -> error;

		$resultado = false;
		die(json_encode($response));
	}

	//INSERT RECORD
	$query = "INSERT INTO faturacao_postos_movimentos_caixa 
				(ID_Posto, ID_Utilizador, Username, Acao, ValorDinheiro, ValorMB, ValorCC, ValorCH, ValorPD, ValorCO, ValorVR, ValorTotal, DataOperacao, TimestampMov, CodAbertura, TipoMovimento, ID_Documento, Tipo_Documento, Ref_Documento, DescricaoAdicional,Troco,MetodoExcedente,ID_Mesa ) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("sssssssssssssssssssssss",
		                    $idPosto,
		                    $idUtilizador,
		                    $username,
		                    $acao,
		                    $valorDin,
		                    $valorMB,
		                    $valorCC,
		                    $valorCH,
		                    $valorPD,
		                    $valorCO,
		                    $valorVR,
		                    $valorTotal,
		                    $data,
		                    $timestamp,
		                    $codAbertura,
		                    $tipoMovimento,
		                    $idDocumento,
		                    $tipoDocumento,
		                    $refDocumento,
		                    $descAdicional,
							$troco,
							$metodoExcelente,
							$id_mesa
		        );
		$result = $stmt -> execute();
		$idMovimento = $stmt -> insert_id;
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "HPOS007B";
			$response["message"] = $stmt -> error;

			$resultado = false;
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "HPOS008B";
		$response["message"] = $sqli_connection -> error;

		$resultado = false;
		die(json_encode($response));
	}

	//return result
	return $resultado;
}

/**
 * Inserir movimento caixa - positivo
 * @param  $idPosto
 * @param  $acao > [ Abertura | Entrada | Saída | Fecho | Documento | Outro ]
 * @param  $valorDin
 * @param  $valorMB
 * @param  $valorCC
 * @param  $valorCH
 * @param  $valorPD
 * @param  $valorCO
 * @param  $valorVR
 * @param  $valorTotal
 * @param  $codAbertura
 * @param  $tipoMovimento > [ 1 - Abertura | 2 - Fecho | 3 - Entrada/Saída | 4 - Documento | 5 - Outros	]
 * @param  $idDocumento
 * @param  $tipoDocumento
 * @param  $refDocumento
 * @param  $descAdicional
 * @return bool
 */
function inserirMovimentoNegativoPOS($idPosto, $acao, $valorDin = 0, $valorMB = 0, $valorCC = 0, $valorCH = 0, $valorPD = 0, $valorCO = 0, $valorVR = 0, $valorTotal = 0, $codAbertura = null, $tipoMovimento = null, $idDocumento = null, $tipoDocumento = null, $refDocumento = null, $descAdicional = null){
	global $sqli_connection;
	$resultado = true;

	//prepare remaining vars
	$idUtilizador = $_SESSION['id_utilizador'];
	$username = $_SESSION['username'];
	// $data = date("d/m/Y H:i:s");
	// $tmpDT = DateTime::createFromFormat('d/m/Y', $DataMovimento);
	$data = date('d/m/Y H:i:s');
	$timestamp = microtime(true);

	//convert values to negative
	$valorDin = $valorDin * (-1);
    $valorMB = $valorMB * (-1);
    $valorCC = $valorCC * (-1);
    $valorCH = $valorCH * (-1);
    $valorPD = $valorPD * (-1);
    $valorCO = $valorCO * (-1);
    $valorVR = $valorVR * (-1);
    $valorTotal = $valorTotal * (-1);

	//CHECK IF IS VALID
	$countClose = 0;
	$query2 = "SELECT COUNT(*) FROM faturacao_postos_movimentos_caixa WHERE ID_Posto=? AND CodAbertura=? AND TipoMovimento=2 ORDER BY ID_Movimento DESC LIMIT 1";
	if ($stmt2 = $sqli_connection -> prepare($query2)) {
		//bind params
		$stmt2 -> bind_param('ds', $idPosto,$codAbertura);
		//result
		$result = $stmt2 -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS008BA";
			$response["message"] = $stmt2 -> error;
			die(json_encode($response));
		}
		$stmt2 -> bind_result($countClose);
		$stmt2 -> fetch();
		$stmt2 -> close();
	} else {
		$response["errors"] = true;
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}
	if($countClose > 0){
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "HPOS008BB";
		$response["message"] = $sqli_connection -> error;

		$resultado = false;
		die(json_encode($response));
	}

	//INSERT RECORD
	$query = "INSERT INTO faturacao_postos_movimentos_caixa 
				(ID_Posto, ID_Utilizador, Username, Acao, ValorDinheiro, ValorMB, ValorCC, ValorCH, ValorPD, ValorCO, ValorVR, ValorTotal, DataOperacao, TimestampMov, CodAbertura, TipoMovimento, ID_Documento, Tipo_Documento, Ref_Documento, DescricaoAdicional ) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("ssssssssssssssssssss",
		                    $idPosto,
		                    $idUtilizador,
		                    $username,
		                    $acao,
		                    $valorDin,
		                    $valorMB,
		                    $valorCC,
		                    $valorCH,
		                    $valorPD,
		                    $valorCO,
		                    $valorVR,
		                    $valorTotal,
		                    $data,
		                    $timestamp,
		                    $codAbertura,
		                    $tipoMovimento,
		                    $idDocumento,
		                    $tipoDocumento,
		                    $refDocumento,
		                    $descAdicional
		        );
		$result = $stmt -> execute();
		$idMovimento = $stmt -> insert_id;
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "HPOS009";
			$response["message"] = $stmt -> error;

			$resultado = false;
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "HPOS0010";
		$response["message"] = $sqli_connection -> error;

		$resultado = false;
		die(json_encode($response));
	}

	//return result
	return $resultado;
}

/**
 * Validar consultas
 */
function verificarExisteConsulta($codAbertura,$idMesa,$idPosto){
	global $sqli_connection;
	$query2 = "SELECT COUNT(*) FROM faturacao_consultas_mesa WHERE ID_Posto=? AND CodAbertura=? AND ID_Mesa=?";
	if ($stmt2 = $sqli_connection -> prepare($query2)) {
		//bind params
		$stmt2 -> bind_param('dss', $idPosto,$codAbertura,$idMesa);
		//result
		$result = $stmt2 -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS008BC";
			$response["message"] = $stmt2 -> error;
			die(json_encode($response));
		}
		$stmt2 -> bind_result($countClose);
		$stmt2 -> fetch();
		$stmt2 -> close();
	} else {
		$response["errors"] = true;
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}

	return $countClose > 0;
}

/**
 * Obter movimentos da mesa
 */

function detalhesMovimentoMesa($codAbertura,$mesa)
{
	global $sqli_connection;
	$data = [];
	$query = "SELECT ID_Posto, ID_Utilizador, Username, Acao, ValorDinheiro, ValorMB, ValorCC, ValorCH, ValorPD, ValorCO, ValorVR, ValorTotal, DataOperacao, TimestampMov, CodAbertura, TipoMovimento, ID_Documento, Tipo_Documento, Ref_Documento, DescricaoAdicional,Troco,MetodoExcedente,ID_Mesa FROM faturacao_postos_movimentos_caixa where CodAbertura = ? AND ID_Mesa = ? AND Acao = 'Documento' ORDER BY ID_Movimento desc ";
	if ($stmt = $sqli_connection->prepare($query)) {
		//result
		$stmt -> bind_param("ss",$codAbertura,$mesa);
		$result = $stmt->execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS0011";
			$response["message"] = $stmt->error;
			die(json_encode($response));
		}
		$stmt->bind_result(
			$idPosto,
			$idUtilizador,
			$username,
			$acao,
			$valorDin,
			$valorMB,
			$valorCC,
			$valorCH,
			$valorPD,
			$valorCO,
			$valorVR,
			$valorTotal,
			$dataOperacao,
			$timestamp,
			$codAbertura,
			$tipoMovimento,
			$idDocumento,
			$tipoDocumento,
			$refDocumento,
			$descAdicional,
			$troco,
			$metodoExcelente,
			$id_mesa
		);
		while ($stmt->fetch()) {
			$data[] = array(
				"Username" => $username,
				"Acao" =>$acao,
				"Total" => number_format($valorTotal, 2, ',', '.'). ' €',
				"DataOperacao" =>$dataOperacao,
				"Timestamp" =>$timestamp,
				"CodAbertura" =>$codAbertura,
				"IdDocumento" =>$idDocumento,
				"TipoDocumento" =>$tipoDocumento,
				"RefDocumento" =>$refDocumento,
			);
		}
		$stmt->close();
	}else {
		$response["errors"] = true;
		$response["type"] = "HPOS0012";
		$response["message"] = $sqli_connection->error;
		die(json_encode($response));
	}
	$response["errors"] = false;
	$response["codAbertura"] = $codAbertura;
	$response["mesa"] = $mesa;
	$response["data"] = $data;
	die(json_encode($response));
}


/**
 * [insert_log description]
 * @param  [int] $idposto
 * @param  [string] $accao [ Abertura | Entrada | Saída | Fecho | Documento | Outro ]
 * @param  [string] $descricao
 * @param  [mysql connection] $sqli_connection
 * @return bool
 */
function inserirLogPOS($idPosto,$accao, $descricao, $sqli_connection) {
	if ($_SESSION['username'] != "ADMIN_FTKODE") {
		$id_utilizador = $_SESSION['id_utilizador'];
		$nome_utilizador = $_SESSION['nome_utilizador'];
		$data = date('d/m/Y H:i:s');
		$timestamp = microtime(true);

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$query = "INSERT INTO faturacao_postos_logs (ID_Posto, ID_User, Username, DataHora, TimeStamp, Acao, Descricao, IP) values(?,?,?,?,?,?,?,?)";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("dsssdsss", $idPosto, $id_utilizador, $nome_utilizador, $data, $timestamp, $accao, $descricao, $ip);
			$stmt -> execute();
			$stmt -> close();
		}
		return true;
	}else{
		return true;
	}
}

/**
 * Generate string based on lenght
 * @param  $length
 * @return random string
 */
function generateRandString($length) {
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function getMovimentoCaixa($idDocumento,$tipoDocumento) {

	global $sqli_connection;

	/*$query = "SELECT ID_Posto, ID_Utilizador, Username, Acao, ValorDinheiro, ValorMB, ValorCC, ValorCH, ValorPD, ValorCO, ValorVR, ValorTotal, DataOperacao, TimestampMov, CodAbertura, TipoMovimento, ID_Documento, Tipo_Documento, Ref_Documento
				FROM faturacao_postos_movimentos_caixa
				WHERE ID_Documento=? AND Tipo_Documento=? ORDER BY ID_Movimento ASC LIMIT 1";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		$stmt -> bind_param("ss",$idDocumento,$tipoMovimento);
		//result
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "HPOS003";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> bind_result(
			$idPosto,
			$idUtilizador,
			$username,
			$acao,
			$valorDin,
			$valorMB,
			$valorCC,
			$valorCH,
			$valorPD,
			$valorCO,
			$valorVR,
			$valorTotal,
			$data,
			$timestamp,
			$codAbertura,
			$tipoMovimento,
			$idDocumento,
			$tipoDocumento,
			$refDocumento
		);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "HPOS004";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}*/

	$query = "SELECT ID_Posto, ID_Utilizador, Username, Acao, ValorDinheiro, ValorMB, ValorCC, ValorCH, ValorPD, ValorCO, ValorVR, ValorTotal, DataOperacao, TimestampMov, CodAbertura, TipoMovimento, ID_Documento, Tipo_Documento, Ref_Documento 
				FROM faturacao_postos_movimentos_caixa 
				WHERE ID_Documento=? AND Tipo_Documento=?";
	if ( $stmt = $sqli_connection->prepare($query) ) {
		//bind params
		$stmt->bind_param("ds", $idDocumento, $tipoDocumento);
		//result single
		$result = $stmt->execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS003";
			$response["message"] = $stmt->error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt->bind_result($idPosto, $idUtilizador, $username, $acao, $valorDin, $valorMB, $valorCC, $valorCH, $valorPD, $valorCO, $valorVR, $valorTotal, $data, $timestamp, $codAbertura, $tipoMovimento, $idDocumento, $tipoDocumento, $refDocumento);
		$stmt->fetch();
		$stmt->close();
	}

	$response["id_posto"] = $idPosto;
	$response["idUtilizador"] = $idUtilizador;
	$response["username"] = $username;
	$response["acao"] = $acao;
	$response["valorDin"] = $valorDin;
	$response["valorMB"] = $valorMB;
	$response["valorCC"] = $valorCC;
	$response["valorCH"] = $valorCH;
	$response["valorPD"] = $valorPD;
	$response["valorCO"] = $valorCO;
	$response["valorVR"] = $valorVR;
	$response["valorTotal"] = $valorTotal;
	$response["data"] = $data;
	$response["timestamp"] = $timestamp;
	$response["codAbertura"] = $codAbertura;
	$response["tipoMovimento"] = $tipoMovimento;
	$response["idDocumento"] = $idDocumento;
	$response["tipoDocumento"] = $tipoDocumento;
	$response["refDocumento"] = $refDocumento;

	return $response;
}
?>
