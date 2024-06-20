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
$nif_cliente = $_POST['nif_cliente'];

//GET THE PROCESS --------------------------------------------------------
$query = "SELECT ID_Cliente,Nome,NIF FROM faturacao_clientes WHERE Nif=? AND Ativo = 1 LIMIT 1";
if ( $stmt = $sqli_connection -> prepare($query) ) {
	//bind params
	$stmt -> bind_param("s",$nif_cliente);
	//result single
	$result = $stmt -> execute();
	if (false === $result) {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS001";
		$response["message"] = $stmt -> error;
		die(json_encode($response));
	}
    $stmt -> bind_result($ID_Cliente,$Nome,$NIF);
    $stmt -> fetch();
    $stmt -> close();
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS002";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}

$response["errors"] = false;
$response["exists_client"] = $ID_Cliente && $ID_Cliente > 0 ? true : false;
$response["id_cliente"] = $ID_Cliente;
$response["nome"] = $Nome;
$response["nif"] = $NIF;

die(json_encode($response));

?>
