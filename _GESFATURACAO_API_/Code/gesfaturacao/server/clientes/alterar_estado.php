<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//GET POST VARS ---------------------------------------------------------
$idCliente = $_POST['idCliente'];
if ( $idCliente == '' ) 
{
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000";
	die(json_encode($response));
}

//VERIFICA SE É O CLIENTE GERAL ------------------------------------------
if ( $idCliente == 1 || $idCliente == "1") 
{
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000A";
	$response["cliente_sistema"] = true;
	$response["message"] = "Não é possível alterar o estado do cliente geral do sistema!";
	die(json_encode($response));
}

//-----------------------------------------------------------------------
try {
	// Turn off AUTOCOMMIT and begin Transaction
	mysqli_autocommit($sqli_connection, FALSE);
	$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

	//CHECK IF USED -----------------------------------------------------
	$query = "SELECT Ativo, Nome, Codigo FROM faturacao_clientes WHERE ID_Cliente = ?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("d", $idCliente);
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FTGA001";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> bind_result($estadoAtual, $nomecliente, $codigocliente);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FTGA002";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}

	//PREPARE VARS TO UPDATE --------------------------------------------
	$novoEstado = null;

	if($estadoAtual == 1) $novoEstado = 0;
	else $novoEstado = 1;

	//INSERT DB ---------------------------------------------------------
	$query = "UPDATE faturacao_clientes SET Ativo=? WHERE ID_Cliente = ?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("sd", 
			$novoEstado,
			$idCliente 
		);
		$result = $stmt -> execute();
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

	//log sistema -------------------------------------------------------
	$descricao_log ="Cliente: Alteração do Estado ( cód: ".$codigocliente." | nome: ".$nomecliente.")";
	insert_log(14,"Editar",$descricao_log,$sqli_connection);

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
die(json_encode($response));
?>