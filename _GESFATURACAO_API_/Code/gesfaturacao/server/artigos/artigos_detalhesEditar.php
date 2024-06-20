<?php
//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";

// GET NECESSARY DATA ----------------------------------------------------
$ano = $_SESSION['ano'];
$id_utilizador = $_SESSION['id_utilizador'];

//GET $_GET VARS ---------------------------------------------------------
$idArtigo = $_POST['idArtigo'];

//DEFINE VARS ------------------------------------------------------------
$objectData = array();

//GET THE PROCESS --------------------------------------------------------
$query = "SELECT ID_Artigo,
	Codigo, 
	CodigoBarras, 
	SerialNumber, 
	Nome, 
	ID_Categoria, 
	Tipo,
	PrecoPVP,
	Preco,
	ID_Imposto,
	ID_Unidade,
	RetencaoPercentagem,
	RetencaoValor,
	Stock,
	Ativo,
	PlanoContas,
	PlanoContasCompras,
	Usado,
	id_motivo_isencao,
	DescricaoLonga,
	imagem,
	LabelEtiqueta,
	EncomendaAqui,
	0 AS PrecoCustoCompras,
	PrecoCusto AS PrecoCustoInicial,
	NumAVAPVFitoFarmac,
	DisponivelEmenta,
	StockMin,
	AlertaStockMinimo,
	ProcessarPorMargemLucro,
	PercentagemMargemLucro,
	AutoPreencherComentario
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
		$objectData['Categoria'],
		$objectData['Tipo'],
		$objectData['PrecoPVP'],
		$objectData['Preco'],
		$objectData['IVA'],
		$objectData['Unidade'],
		$objectData['RetencaoPercentagem'],
		$objectData['RetencaoValor'],
		$objectData['Stock'],
		$objectData['Ativo'],
		$objectData['PlanoContas'],
		$objectData['PlanoContasCompras'],
		$objectData['Usado'],
		$objectData['MotivoIsencao'],
		$objectData['DescricaoLonga'],
		$objectData['imagem'],
		$objectData['LabelEtiqueta'],
		$objectData['EncomendaAqui'],
		$objectData['PrecoCusto'],
		$objectData['PrecoCustoInicial'],
		$objectData['NumAVAPVFitoFarmac'],
		$objectData['DisponivelEmenta'],
		$objectData['StockMin'],
		$objectData['AlertaStockMinimo'],
		$objectData['ProcessarPorMargemLucro'],
		$objectData['PercentagemMargemLucro'],
		$objectData['AutoPreencherComentario']
	);
	$stmt -> fetch();
	$stmt -> close();

	//confirm price if null
	if(!$objectData['PrecoCusto']) $objectData['PrecoCusto'] = $objectData['PrecoCustoInicial'] > 0 ? $objectData['PrecoCustoInicial'] : 0;
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS002";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}
//------------------------------------------------------------------------

//GET BARCODES ------------------------------------------------
$codigosbarras = array();
$query = "SELECT ID_Codigo,CodigoBarras FROM faturacao_artigos_codigo_barras WHERE ID_Artigo =?";
if ( $stmt = $sqli_connection -> prepare($query) ) {
	//bind params
	$stmt -> bind_param("d", $idArtigo);
	//result single
	$result = $stmt -> execute();
	if (false === $result) {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS00L1";
		$response["message"] = $stmt -> error;
		die(json_encode($response));
	}
	$stmt -> bind_result( $ID_Codigo,$CodigoBarras );
	while( $stmt -> fetch() ){
		$codigosbarras[] = array(
			"ID_Codigo" => $ID_Codigo,
			"CodigoBarras" => $CodigoBarras,
		);
	}
	$stmt -> close();
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS00L2";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}
//add lines to final var
$objectData['codigosbarras'] = $codigosbarras;
//------------------------------------------------------------------------

//GET PRICE LINES ------------------------------------------------
$pricesLines = array();
$query = "SELECT ID_Artigo_Preco, Preco, ID_Imposto, PrecoPVP FROM faturacao_artigos_precos WHERE ID_Artigo=?";
if ( $stmt = $sqli_connection -> prepare($query) ) {
	//bind params
	$stmt -> bind_param("d", $idArtigo);
	//result single
	$result = $stmt -> execute();
	if (false === $result) {
		$response["errors"] = true;
		$response["type"] = "query";
		$response["line"] = "FATS00L3";
		$response["message"] = $stmt -> error;
		die(json_encode($response));
	}
	$stmt -> bind_result($ID_Artigo_Preco, $Preco, $ID_Imposto, $PrecoPVP);
	while ($stmt -> fetch()) {
		$pricesLines[] = array("id" => $ID_Artigo_Preco, "preco" => $Preco, "id_imposto" => $ID_Imposto, "precoPVP" => $PrecoPVP);
	}
	$stmt -> close();
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS00L4";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}
//add lines to final var
$objectData['pricesLines'] = $pricesLines;
//------------------------------------------------------------------------
//GET PRICE LINES ------------------------------------------------
$suppliersLines = array();

//add lines to final var
$objectData['suppliersLines'] = $suppliersLines;
//------------------------------------------------------------------------

// var_dump($objectData);die();
$response["errors"] = false;
$response["data"] = $objectData;
die(json_encode($response));

?>
