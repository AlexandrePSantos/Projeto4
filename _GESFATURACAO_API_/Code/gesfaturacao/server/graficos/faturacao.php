<?php
//INCLUDE CONNECTION
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

$id_utilizador = $_SESSION['id_utilizador'];

//INIT VARS
$array_results = array();
$dia = date("d/m/Y");
$mes = date("m/Y");
$ano = date("Y");

/* ================================================= */
/* GET COMMUN DATA AND PREPARE THEM FOR THE FUNCTIONS */
/* VENDAS */
/* ================================================= */

//PREPARE CONDITIONS
$conditionsSeries = '';
$filterConditions = " ";

//PREPARE DATES
$data_inicio = date("Y");
$data_fim = date("Y");

//GET TOTALS
$resultsTotDocs = processTotalsAllDocs($data_inicio, $data_fim, $conditionsSeries, $filterConditions, 'year');

//PREPARE DATES
$data_inicio_hoje = date("d/m/Y");
$data_fim_hoje = date("d/m/Y");

//GET TOTALS
$resultsTotDocsHoje = processTotalsAllDocs($data_inicio_hoje, $data_fim_hoje, $conditionsSeries, $filterConditions, 'day');

//PREPARE DATES
$mesAtualTmp = new DateTime("last day of this month");
$data_inicio_mes = "01/".date("m/Y");
$data_fim_mes = $mesAtualTmp->format("d")."/".date("m/Y");

//GET TOTALS
$resultsTotDocsMes = processTotalsAllDocs($data_inicio_mes, $data_fim_mes, $conditionsSeries, $filterConditions, 'month');

//PREPARE DATES
$mesAnteriorTmp = new DateTime("last day of last month");
$data_inicio_ant = "01/".$mesAnteriorTmp->format("m/Y");
$data_fim_ant = $mesAnteriorTmp->format("d/m/Y");

//GET TOTALS
$resultsTotDocsAnterior = processTotalsAllDocs($data_inicio_ant, $data_fim_ant, $conditionsSeries, $filterConditions, 'month');

/* ================================================= */

$totalHoje = getFaturadoHoje();
$totalMes = getFaturadoMes();
$totalAno = getFaturadoAno();

// $mesanteriorTmp = new DateTime("first day of last month"); //because of february 
// $mesanterior = $mesanteriorTmp->format('Y-m');
// $mesatual = date("Y-m");
// $ivaano = date("Y");
$totalIAnterior = getIVAAnterior();
$totalIAtual = getIVAAtual();
$totalIAnual = getIVAAno();

/* ============================== */

//Put values on array and return it
$array_results = array(
	'Hoje' => $totalHoje,
	'Mes' => $totalMes,
	'Ano' => $totalAno,
	'IAnterior' => $totalIAnterior,
	'IAtual' => $totalIAtual,
	'IAnual' => $totalIAnual,
);
/* ============================== */

die(json_encode($array_results));


/* ============================== */

/**
 * Get Total Faturado Today
 * @return total
 */
function getFaturadoHoje(){
	global $sqli_connection;
	global $resultsTotDocsHoje;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocsHoje["totalLinhasFinal"])) $totalReturn = $resultsTotDocsHoje["totalLinhasFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get Total Faturado Today
 * @return total
 */
function getFaturadoMes(){
	global $sqli_connection;
	global $resultsTotDocsMes;
	
	//INIT VARS
	$totalReturn = 0;
	
	//PROCESS TOTALS
	if(isset($resultsTotDocsMes["totalLinhasFinal"])) $totalReturn = $resultsTotDocsMes["totalLinhasFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get Total Faturado Today
 * @return total
 */
function getFaturadoAno(){
	global $sqli_connection;
	global $resultsTotDocs;
	
	//INIT VARS
	$totalReturn = 0;
	
	//PROCESS TOTALS
	if(isset($resultsTotDocs["totalLinhasFinal"])) $totalReturn = $resultsTotDocs["totalLinhasFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get IVA MES Atual
 * @return total
 */
function getIVAAtual($Atual=0){
	global $sqli_connection;
	global $resultsTotDocsMes;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocsMes["totalFinal"])) $totalReturn = $resultsTotDocsMes["totalFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get IVA MES Anterior
 * @return total
 */
function getIVAAnterior($Anterior=0){
	global $sqli_connection;
	global $resultsTotDocsAnterior;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocsAnterior["totalFinal"])) $totalReturn = $resultsTotDocsAnterior["totalFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get IVA MES Ano
 * @return total
 */
function getIVAAno(){
	global $sqli_connection;
	global $resultsTotDocs;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocs["totalFinal"])) $totalReturn = $resultsTotDocs["totalFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

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
?>
