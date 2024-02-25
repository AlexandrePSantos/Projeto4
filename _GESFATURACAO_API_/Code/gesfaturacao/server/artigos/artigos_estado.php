<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";

$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//GET POST VARS ---------------------------------------------------------
$idDados = $_POST['idArtigo'];

try {
	// Turn off AUTOCOMMIT and begin Transaction
	mysqli_autocommit($sqli_connection, FALSE);
	$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

	//SELECT ITEM (REMOVE ALL PREDEFINIDAS) ---------------------------------
	$query = "SELECT Ativo, Codigo FROM faturacao_artigos WHERE ID_Artigo=?";
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
		$stmt -> bind_result($estadoArtigo, $codigo_artigo);
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
	if($estadoArtigo == 1) $novoEstado = 0;
	else $novoEstado = 1;
	//-----------------------------------------------------------------------

	//UPDATE DB -------------------------------------------------------------
	$query = "UPDATE faturacao_artigos SET Ativo=? WHERE ID_Artigo=?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("dd", $novoEstado, $idDados );
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
	//----------------------------------------------------------------------

	//log sistema
	$descricao_log ="Artigo: Atualização Estado (cód: ".$codigo_artigo.")";
	insert_log(14,"Editar",$descricao_log,$sqli_connection);

	// Save all querys on DB
	$sqli_connection->commit();
} catch (Exception $e) {
	$response["errors"] = true;
	$response["type"] = "transaction";
	$response["line"] = "DB001";
	$response["message"] = $e->getMessage();

	$sqli_connection->rollback();
	die(json_encode($response));
}

//response
$response["errors"] = false;
die(json_encode($response));
?>