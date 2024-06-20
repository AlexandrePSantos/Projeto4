<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//VERIFICA SE É O CLIENTE GERAL ------------------------------------------
if ( $_POST['idCliente'] == 1 || $_POST['idCliente'] == "1") 
{
	$response["errors"] = true;
	$response["type"] = "var";
	$response["line"] = "FATS000A";
	$response["cliente_sistema"] = true;
	$response["message"] = "Não é possível apagar o cliente geral do sistema!";
	die(json_encode($response));
}

# PROCESS
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

	//GET POST VARS ---------------------------------------------------------
	$idDados = $_POST['idCliente'];

	//CHECK IF USED (REMOVE ALL PREDEFINIDAS) -------------------------------
	$query = "SELECT ID_Account, Usado, Nome, Esquecer, Codigo FROM faturacao_clientes WHERE ID_Cliente=?";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//bind params
		$stmt -> bind_param("d", $idDados);
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
		$stmt -> bind_result( $idAccount, $usado, $nome_cliente, $esquecer, $CodClienteDB );
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
	//add info to main array
	if($usado > 0) {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS003";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//add info to main array
	if($esquecer > 0) {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS008";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//-----------------------------------------------------------------------

	//CHECK IF GENERAL ACCOUNT ----------------------------------------------
	$idSncBase = 0;
	//-----------------------------------------------------------------------

	//DELETE DB -------------------------------------------------------------
	$query = "DELETE FROM faturacao_clientes WHERE ID_Cliente=?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("d", $idDados );
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS006";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS007";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//----------------------------------------------------------------------

	//log sistema
	$descricao_log ="Cliente: Eliminação ( cód. ".$CodClienteDB." | nome: ".$nome_cliente.")";
	insert_log(14,"Apagar",$descricao_log,$sqli_connection);

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