<?php
//INCLUDE CONNECTION
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

$id_utilizador = $_SESSION['id_utilizador'];

//INIT VARS
$array_results = array();
$ano = isset($_POST['filterYear']) && intval($_POST['filterYear']) > 0 ? intval($_POST['filterYear']) : date("Y");
$series = isset($_POST["filterSerie"]) && $_POST["filterSerie"] && $_POST["filterSerie"] != 'null' ? $_POST["filterSerie"] : null;

/* ================================================= */
/* GET COMMUN DATA AND PREPARE THEM FOR THE FUNCTIONS */
/* VENDAS */
/* ================================================= */

//PREPARE CONDITIONS
$conditionsSeries = '';
$filterConditions = " ";

//PREPARE DATES
$data_inicio = $ano;
$data_fim = $ano;

//GET TOTALS
$resultsTotDocs = processTotalsAllDocs($data_inicio, $data_fim, $conditionsSeries, $filterConditions,'year');
// $resultsTotDocs = [];

/* ================================================= */

/* ================================================= */
/* GET COMMUN DATA AND PREPARE THEM FOR THE FUNCTIONS */
/* COMPRAS */
/* ================================================= */

//PREPARE CONDITIONS
$conditionsSeriesComp = '';
$filterConditionsComp = " ";

//PREPARE DATES
$data_inicioComp = $ano;
$data_fimComp = $ano;

//GET TOTALS
$resultsTotDocsComp = processTotalsAllDocsCompras($data_inicioComp, $data_fimComp, $conditionsSeriesComp, $filterConditionsComp,'year');
// $resultsTotDocsComp = [];

/* ================================================= */

/* Prepare return */
$response['errors'] = false;
$response['AnoTotalVendas'] = $resultsTotDocs["totalLinhasFinal"];
$response['IvaTotalVendas'] = abs($resultsTotDocs["totalFinal"]);
$response['AnoTotalCompras'] = $resultsTotDocsComp["totalLinhasFinal"];
$response['IvaTotalCompras'] = $resultsTotDocsComp["totalFinal"];
die(json_encode($response));


/**
 * Get Totals Docs For All Sales Docs
 * @param  [date string] $data_inicio
 * @param  [date string] $data_fim
 * @param  string $conditionsSeries
 * @param  string $filterConditions
 * @return Sum totals array
 */
function processTotalsAllDocs($data_inicio, $data_fim, $conditionsSeries = '', $filterConditions = '', $typeDate = 'year'){
	// return $objectData;
	global $sqli_connection;
	// var_dump($data_inicio, $data_fim, $conditionsSeries, $filterConditions);

	//INIT VARS
	$objectData = array(
		"totalLinhasSIVAFinal" => 1000, /* TotSIVA - Anual */
		"totalFinal" => 230, /* TotImposto - Anual */
		"totalLinhasFinal" => 1230, /* Total - Anual */
		"totalEmFaltaFinal" => 500, /* PorPagar - Anual */

		"faturado_hoje" => 100, /* Total_Faturado_Hoje */
		"faturado_mes" => 200, /* Total_Faturado_Mes */
		"iva_anterior" => 100, /* TotImposto_Anterior */
		"iva_mes" => 50, /* TotImposto_Mes */
	);

	//RETURN FINAL RESULTS
	return $objectData;
}

/**
 * Get Totals Docs For All Shop Docs
 * @param  [date string] $data_inicio
 * @param  [date string] $data_fim
 * @param  string $conditionsSeries
 * @param  string $filterConditions
 * @return Sum totals array
 */
function processTotalsAllDocsCompras($data_inicio, $data_fim, $conditionsSeries = '', $filterConditions = '', $typeDate = 'year'){
	global $sqli_connection;
	// var_dump($data_inicio, $data_fim, $conditionsSeries, $filterConditions);

	//INIT VARS
	$objectData = array(
		"totalLinhasSIVAFinal" => 2000, /* TotSIVA - Anual */
		"totalFinal" => 460, /* TotImposto - Anual */
		"totalLinhasFinal" => 2460, /* Total - Anual */
		"totalEmFaltaFinal" => 1000, /* PorPagar - Anual */
	);

	//RETURN FINAL RESULTS
	return $objectData;
}
?>
