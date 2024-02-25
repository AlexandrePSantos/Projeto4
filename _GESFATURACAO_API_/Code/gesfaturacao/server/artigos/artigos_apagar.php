<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";

$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//GET POST VARS ---------------------------------------------------------
$idArtigo = $_POST['idArtigo'];

//VERIFICA SE HA NULOS --------------------------------------------------
if ( $idArtigo == '' ) 
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

	//VERIFICA SE PODE SER ALTERADO -----------------------------------------
	$query = "SELECT Usado, Codigo, imagem, UsadoEupago,
		0 AS TotPortes,
		0 AS TotAssociados,
		0 AS TotAssociacoes,
		0 AS TotAssociadosDocs,
		0 AS TotAssociacoesDocs,

		0 AS TotalCarrinho,
		0 AS TotalEncomendas,
		0 AS TotalPrecos
		FROM faturacao_artigos WHERE ID_Artigo=?";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//bind params
		$stmt -> bind_param("d", $idArtigo);
		//result single
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS001";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> bind_result($usado,$codigo_artigo,$fotoDB,$usado_eupago,$usado_portes,$totassociados,$totassociacoes,$totassociadosDocs,$totassociacoesDocs,$totcarrinhos,$totencomendas,$totprecos);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS002";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}
	if($usado > 0 || $usado_eupago > 0 || $usado_portes > 0 || $totassociados > 0 || $totassociacoes > 0 || $totassociadosDocs > 0 || $totassociacoesDocs > 0 || $totcarrinhos > 0 || $totencomendas > 0 || $totprecos > 0) {
		$response["errors"] = true;
		$response["type"] = "Usado";
		$response["line"] = "FATS003";
		$response["utilizado"] = true;
		$response["message"] = "Artigo já utilizado!";
		die(json_encode($response));
	}
	//-----------------------------------------------------------------------

	//DELETE DB -------------------------------------------------------------
	$query = "DELETE FROM faturacao_artigos WHERE ID_Artigo=?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("d", $idArtigo );
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS004";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS005";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}
	if($fotoDB && $fotoDB != "default.png"){
		unlink($_SERVER["DOCUMENT_ROOT"] . "/uploads/faturacao/artigos/" . $fotoDB);
	}
	//----------------------------------------------------------------------
	
	//DELETE RECORDS -------------------------------------------------------
	$query = "DELETE FROM faturacao_artigos_precos WHERE ID_Artigo=?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("s", $idArtigo );
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS0L3";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS0L4";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//----------------------------------------------------------------------

	//DELETE Codigo Barras -------------------------------------------------
	$query = "DELETE FROM faturacao_artigos_codigo_barras WHERE ID_Artigo=?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("s", $idArtigo );
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS0L1";
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS0L2";
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}
	//----------------------------------------------------------------------

	//UPDATE DB ------------------------------------------------------------
	$query = "UPDATE faturacao_artigos_registos SET ArticleDeleted=1 WHERE ID_Artigo=?";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$stmt -> bind_param("d", $idArtigo );
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS008";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS009";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}
	//---------------------------------------------------------------------

	//log sistema
	$descricao_log ="Artigo: Eliminação (cód: ".$codigo_artigo.")";
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