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
$idArtigo = $_POST['idArtigo'];
$idRegisto = $_POST['idRegisto'];

//DEFINE VARS ------------------------------------------------------------
$objectData = array();

//GET THE PROCESS --------------------------------------------------------
$query = "SELECT ID_Artigo,
	Codigo, 
	CodigoBarras, 
	SerialNumber, 
	Nome, 
	(SELECT Descricao as Unidade FROM faturacao_unidades WHERE faturacao_unidades.ID_Unidade=faturacao_artigos.ID_Unidade) AS Unidade,
	Ativo,
	Stock
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
	$stmt -> bind_result(
	    $objectData['ID_Artigo'],
	    $objectData['Codigo'],
	    $objectData['CodigoBarras'],
	    $objectData['SerialNumber'],
	    $objectData['Nome'],
	    $objectData['Unidade'],
	    $objectData['Ativo'],
	    $objectData['Stock']
	);
	$stmt -> fetch();
	$stmt -> close();
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS002";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}

//GET THE RECORD --------------------------------------------------------
$query = "SELECT ID_Registo,
	ID_Artigo, 
	Data, 
	DataSistema, 
	Acao, 
	ID_Doc_Associado, 
	Tipo_Doc_Associado, 
	Ref_Doc_Associado, 
	StockAnterior, 
	StockPosterior, 
	(StockPosterior - StockAnterior) AS DiferencaRegisto,
	ArticleDeleted, 
	AcertoStock, 
	DataAcertoStock, 
	NomeUtilizador, 
	IP 
	FROM faturacao_artigos_registos WHERE ID_Registo=? AND ID_Artigo=?";

if ( $stmt = $sqli_connection -> prepare($query) ) {
	//bind params
	$stmt -> bind_param("dd", $idRegisto, $idArtigo);
	//result single
	$result = $stmt -> execute();
	if (false === $result) {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS002";
		$response["message"] = $stmt -> error;
		die(json_encode($response));
	}
	$stmt -> bind_result(
	    $objectData['ID_Registo'],
	    $objectData['ID_Artigo_Registo'],
	    $objectData['DataRegisto'],
	    $objectData['DataSistemaRegisto'],
	    $objectData['Acao'],
	    $objectData['ID_Doc_Associado'],
	    $objectData['Tipo_Doc_Associado'],
	    $objectData['Ref_Doc_Associado'],
	    $objectData['StockAnterior'],
	    $objectData['StockPosterior'],
	    $objectData['DiferencaRegisto'],
	    $objectData['ArticleDeleted'],
	    $objectData['AcertoStock'],
	    $objectData['DataAcertoStock'],
	    $objectData['NomeUtilizador'],
	    $objectData['IP']
	);
	$stmt -> fetch();
	$stmt -> close();
	
	//process text
	$objectData['Acao'] = nl2br($objectData['Acao']);
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS003";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}

// var_dump($objectData);die();
$response["errors"] = false;
$response["data"] = $objectData;
die(json_encode($response));

?>