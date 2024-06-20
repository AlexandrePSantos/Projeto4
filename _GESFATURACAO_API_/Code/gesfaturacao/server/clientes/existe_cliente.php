<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

// GET NECESSARY DATA ----------------------------------------------------
$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//GET $_GET VARS ---------------------------------------------------------
$nome_cliente = $_POST['nome_cliente'] ? mb_strtolower($_POST['nome_cliente']) : $_POST['nome_cliente'];
$nif_cliente = $_POST['nif_cliente'];

//DEFINE VARS ------------------------------------------------------------
$dataIds = array();
$lastID = 0;

//GET THE PROCESS --------------------------------------------------------
$query = "SELECT ID_Cliente
	FROM faturacao_clientes WHERE LOWER(Nome) = ? AND Nif=? ORDER BY ID_Cliente DESC;";
if ( $stmt = $sqli_connection -> prepare($query) ) {
	//bind params
	$stmt -> bind_param("ss", $nome_cliente,$nif_cliente);
	//result single
	$result = $stmt -> execute();
	if (false === $result) {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS001";
		$response["message"] = $stmt -> error;
		die(json_encode($response));
	}
	$stmt -> bind_result( $idcliente );
	while($stmt -> fetch()){
		$dataIds[] = $idcliente;
	}
	$stmt -> close();
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS002";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}

//Most Recent
$lastID = $dataIds[0];

// var_dump($dataIds);die();
$response["errors"] = false;
$response["exists_client"] = $lastID && $lastID > 0 ? true : false;
$response["id_cliente"] = $lastID;
$response["matched_ids"] = $dataIds;
// $response["nome_cliente"] = $nome_cliente;
// $response["nif_cliente"] = $nif_cliente;
die(json_encode($response));

?>