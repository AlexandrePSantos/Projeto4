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
$acumulado = isset($_POST['filterTypeGraph']) && $_POST['filterTypeGraph'] == "true" ? 0 : 1;

$series = isset( $_POST["filterSerie"]) && $_POST["filterSerie"] && $_POST["filterSerie"] != 'null' ? $_POST["filterSerie"] : null;
/* ================================================= */
/* GET COMMUN DATA AND PREPARE THEM FOR THE FUNCTIONS */
/* VENDAS */
/* ================================================= */

//PREPARE CONDITIONS
$conditionsSeries = '';
$filterConditions = " ";

//PREPARE DATES
$data_inicio = $ano != null ? $ano : date("Y");
$data_fim = $ano != null ? $ano : date("Y");

//GET TOTALS
$resultsTotDocs = array();
// $resultsTotDocs = processTotalsAllDocsCompras($data_inicio, $data_fim, $conditionsSeries, $filterConditions);

// for($ind=1; $ind<13; $ind++){
// 	$prefixMonth = $ind < 10 ? "0".$ind : $ind;
// 	$resultsTotDocs[$ind] = processTotalsAllDocsCompras($prefixMonth."/".$data_inicio, $prefixMonth."/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// }
// var_dump($resultsTotDocs);die();

$valorAcumFaturado = 0;
$valorAcumPago = 0;
$resultsTotDocs[1] = processTotalsAllDocsCompras("01/".$data_inicio, "01/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[1]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[1]["totalPagoFinal"];
}

$resultsTotDocs[2] = processTotalsAllDocsCompras("02/".$data_inicio, "02/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[2]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[2]["totalPagoFinal"];
	$resultsTotDocs[2]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[2]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[3] = processTotalsAllDocsCompras("03/".$data_inicio, "03/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[3]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[3]["totalPagoFinal"];
	$resultsTotDocs[3]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[3]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[4] = processTotalsAllDocsCompras("04/".$data_inicio, "04/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[4]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[4]["totalPagoFinal"];
	$resultsTotDocs[4]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[4]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[5] = processTotalsAllDocsCompras("05/".$data_inicio, "05/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[5]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[5]["totalPagoFinal"];
	$resultsTotDocs[5]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[5]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[6] = processTotalsAllDocsCompras("06/".$data_inicio, "06/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[6]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[6]["totalPagoFinal"];
	$resultsTotDocs[6]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[6]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[7] = processTotalsAllDocsCompras("07/".$data_inicio, "07/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[7]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[7]["totalPagoFinal"];
	$resultsTotDocs[7]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[7]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[8] = processTotalsAllDocsCompras("08/".$data_inicio, "08/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[8]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[8]["totalPagoFinal"];
	$resultsTotDocs[8]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[8]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[9] = processTotalsAllDocsCompras("09/".$data_inicio, "09/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[9]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[9]["totalPagoFinal"];
	$resultsTotDocs[9]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[9]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[10] = processTotalsAllDocsCompras("10/".$data_inicio, "10/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[10]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[10]["totalPagoFinal"];
	$resultsTotDocs[10]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[10]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[11] = processTotalsAllDocsCompras("11/".$data_inicio, "11/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[11]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[11]["totalPagoFinal"];
	$resultsTotDocs[11]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[11]["totalPagoFinal"] = $valorAcumPago;
}

$resultsTotDocs[12] = processTotalsAllDocsCompras("12/".$data_inicio, "12/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
if($acumulado) {
	$valorAcumFaturado += $resultsTotDocs[12]["totalLinhasFinal"];
	$valorAcumPago += $resultsTotDocs[12]["totalPagoFinal"];
	$resultsTotDocs[12]["totalLinhasFinal"] = $valorAcumFaturado;
	$resultsTotDocs[12]["totalPagoFinal"] = $valorAcumPago;
}

// $resultsTotDocs[1] = processTotalsAllDocsCompras("01/".$data_inicio, "01/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[2] = processTotalsAllDocsCompras("02/".$data_inicio, "02/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[3] = processTotalsAllDocsCompras("03/".$data_inicio, "03/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[4] = processTotalsAllDocsCompras("04/".$data_inicio, "04/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[5] = processTotalsAllDocsCompras("05/".$data_inicio, "05/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[6] = processTotalsAllDocsCompras("06/".$data_inicio, "06/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[7] = processTotalsAllDocsCompras("07/".$data_inicio, "07/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[8] = processTotalsAllDocsCompras("08/".$data_inicio, "08/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[9] = processTotalsAllDocsCompras("09/".$data_inicio, "09/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[10] = processTotalsAllDocsCompras("10/".$data_inicio, "10/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[11] = processTotalsAllDocsCompras("11/".$data_inicio, "11/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
// $resultsTotDocs[12] = processTotalsAllDocsCompras("12/".$data_inicio, "12/".$data_fim, $conditionsSeries, $filterConditions, 'single_month');
/* ================================================= */

//TOTAL INVOICED INIT VARS
$janTotal = 0;
$fevTotal = 0;
$marTotal = 0;
$abrTotal = 0;
$maiTotal = 0;
$junTotal = 0;
$julTotal = 0;
$agoTotal = 0;
$setTotal = 0;
$outTotal = 0;
$novTotal = 0;
$dezTotal = 0;
//=======================================================

//TOTALS PAYED
$janTotalReceived = 0;
$fevTotalReceived = 0;
$marTotalReceived = 0;
$abrTotalReceived = 0;
$maiTotalReceived = 0;
$junTotalReceived = 0;
$julTotalReceived = 0;
$agoTotalReceived = 0;
$setTotalReceived = 0;
$outTotalReceived = 0;
$novTotalReceived = 0;
$dezTotalReceived = 0;
//=======================================================

//FILL VALUES
$janTotal = $resultsTotDocs[1]["totalLinhasFinal"];
$janTotalReceived = $resultsTotDocs[1]["totalPagoFinal"];
$fevTotal = $resultsTotDocs[2]["totalLinhasFinal"];
$fevTotalReceived = $resultsTotDocs[2]["totalPagoFinal"];
$marTotal = $resultsTotDocs[3]["totalLinhasFinal"];
$marTotalReceived = $resultsTotDocs[3]["totalPagoFinal"];
$abrTotal = $resultsTotDocs[4]["totalLinhasFinal"];
$abrTotalReceived = $resultsTotDocs[4]["totalPagoFinal"];
$maiTotal = $resultsTotDocs[5]["totalLinhasFinal"];
$maiTotalReceived = $resultsTotDocs[5]["totalPagoFinal"];
$junTotal = $resultsTotDocs[6]["totalLinhasFinal"];
$junTotalReceived = $resultsTotDocs[6]["totalPagoFinal"];
$julTotal = $resultsTotDocs[7]["totalLinhasFinal"];
$julTotalReceived = $resultsTotDocs[7]["totalPagoFinal"];
$agoTotal = $resultsTotDocs[8]["totalLinhasFinal"];
$agoTotalReceived = $resultsTotDocs[8]["totalPagoFinal"];
$setTotal = $resultsTotDocs[9]["totalLinhasFinal"];
$setTotalReceived = $resultsTotDocs[9]["totalPagoFinal"];
$outTotal = $resultsTotDocs[10]["totalLinhasFinal"];
$outTotalReceived = $resultsTotDocs[10]["totalPagoFinal"];
$novTotal = $resultsTotDocs[11]["totalLinhasFinal"];
$novTotalReceived = $resultsTotDocs[11]["totalPagoFinal"];
$dezTotal = $resultsTotDocs[12]["totalLinhasFinal"];
$dezTotalReceived = $resultsTotDocs[12]["totalPagoFinal"];
// var_dump($resultsTotDocs);die();
//=======================================================

//Print final totals
$array_results = array(
	array("Meses", "Comprado (€)", "Pago (€)"),
	array("Jan", $janTotal, $janTotalReceived),
	array("Fev", $fevTotal, $fevTotalReceived),
	array("Mar", $marTotal, $marTotalReceived),
	array("Abr", $abrTotal, $abrTotalReceived),
	array("Mai", $maiTotal, $maiTotalReceived),
	array("Jun", $junTotal, $junTotalReceived),
	array("Jul", $julTotal, $julTotalReceived),
	array("Ago", $agoTotal, $agoTotalReceived),
	array("Set", $setTotal, $setTotalReceived),
	array("Out", $outTotal, $outTotalReceived),
	array("Nov", $novTotal, $novTotalReceived),
	array("Dez", $dezTotal, $dezTotalReceived)
);
//=======================================================

//RETURN DATA FOR GRAPH
die(json_encode($array_results));

//=======================================================

/**
 * HELPERS FUNCS
 */

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

	$aux = intval(substr($data_inicio, 0, 2) ) ? intval(substr($data_inicio, 0, 2) ) : 1;

	//INIT VARS
	$objectData = array(
		"totalLinhasSIVAFinal" => 2000 * $aux, /* TotSIVA - Anual */
		"totalFinal" => 460 * $aux, /* TotImposto - Anual */
		"totalLinhasFinal" => 2460 * $aux, /* Total - Anual */
		"totalEmFaltaFinal" => 460 * $aux, /* PorPagar - Anual */
		"totalPagoFinal" => 2000 * $aux, /* Pago - Anual */
	);
	//---------------------------------------

	//RETURN FINAL RESULTS
	return $objectData;
}
?>
