<?php 
// $helpersFile = true;

/**
 * |-----------------------------------------------------------------------
 * |
 * |						Helper Functions
 * |
 * | Functions to be used anytime, anywhere. Just like a service provider.
 * |
 * |-----------------------------------------------------------------------
 */

/* ================================================= */
/* GET COMMUN DATA AND PREPARE THEM FOR THE FUNCTIONS */
/* VENDAS */
/* ================================================= */

//PREPARE CONDITIONS
$conditionsSeries = '';
$idsSeries = array();
$idsSeries = getAvailableSeries(true);

$filterConditions = " ";

//PREPARE DATES
$data_inicio = date("Y");
$data_fim = date("Y");

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
$data_inicioComp = date("Y");
$data_fimComp = date("Y");

//GET TOTALS
$resultsTotDocsComp = processTotalsAllDocsCompras($data_inicioComp, $data_fimComp, $conditionsSeriesComp, $filterConditionsComp,'year');
// $resultsTotDocsComp = [];

/* ================================================= */

// --------- VENDAS ---------

/**
 * Get Total Faturado
 * @return total
 */
function getQD_Faturado(){
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
 * Get Total Régler
 * @return total
 */
function getQD_FatPorLiquidar(){
	global $sqli_connection;
	global $resultsTotDocs;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocs["totalEmFaltaFinal"])) $totalReturn = abs($resultsTotDocs["totalEmFaltaFinal"]);

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get Total Liquidado
 * @return total
 */
function getQD_FatLiquidado(){
	global $sqli_connection;
	global $resultsTotDocs;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocs["totalEmFaltaFinal"]) && isset($resultsTotDocs["totalLinhasFinal"])) {
		$totalReturn =$resultsTotDocs["totalLinhasFinal"] - (abs($resultsTotDocs["totalEmFaltaFinal"]));
	}

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get Total IVA
 * @return total
 */
function getQD_FatIVA(){
	global $sqli_connection;
	global $resultsTotDocs;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocs["totalFinal"])) $totalReturn = abs($resultsTotDocs["totalFinal"]);

	//RETURN TOTAL
	return $totalReturn;
}
/* ================================================= */

// --------- COMPRAS ---------

/**
 * Get Total Faturado
 * @return total
 */
function getQD_Comprado(){
	global $sqli_connection;
	global $resultsTotDocsComp;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocsComp["totalLinhasFinal"])) $totalReturn = $resultsTotDocsComp["totalLinhasFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get Total Régler
 * @return total
 */
function getQD_CompPorLiquidar(){
	global $sqli_connection;
	global $resultsTotDocsComp;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocsComp["totalEmFaltaFinal"])) $totalReturn = abs($resultsTotDocsComp["totalEmFaltaFinal"]);

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get Total Liquidado
 * @return total
 */
function getQD_CompLiquidado(){
	global $sqli_connection;
	global $resultsTotDocsComp;
	
	//INIT VARS
	$totalReturn = 0;

	//PROCESS TOTALS
	if(isset($resultsTotDocsComp["totalEmFaltaFinal"]) && isset($resultsTotDocsComp["totalLinhasFinal"])) {
		$totalReturn =$resultsTotDocsComp["totalLinhasFinal"] - (abs($resultsTotDocsComp["totalEmFaltaFinal"]));
	}

	//RETURN TOTAL
	return $totalReturn;
}

/**
 * Get Total IVA
 * @return total
 */
function getQD_CompIVA(){
	global $sqli_connection;
	global $resultsTotDocsComp;
	
	//INIT VARS
	$totalReturn = 0;
	
	//PROCESS TOTALS
	if(isset($resultsTotDocsComp["totalFinal"])) $totalReturn = $resultsTotDocsComp["totalFinal"];

	//RETURN TOTAL
	return $totalReturn;
}

// ------- Outras -------

/**
 * Get Total Clients
 * @return total
 */
function getQD_TotClients(){
	global $sqli_connection;
	
	//process
	$query = "SELECT COUNT(*) FROM faturacao_clientes WHERE Esquecer=0";
	// var_dump($query);
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "QHELP016";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> store_result();
		$stmt -> bind_result($total);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "QHELP017";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}

	return $total;
}

/**
 * Get Total Fornecedores
 * @return total
 */
function getQD_TotFornecedores(){
	global $sqli_connection;
	
	//process
	$query = "SELECT COUNT(*) FROM faturacao_clientes";
	// var_dump($query);
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["type"] = "QHELP017";
			$response["message"] = $stmt -> error;
			die(json_encode($response));
		}
		$stmt -> store_result();
		$stmt -> bind_result($total);
		$stmt -> fetch();
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["type"] = "QHELP018";
		$response["message"] = $sqli_connection -> error;
		die(json_encode($response));
	}
	return $total;
}

/**
 * Get Total Guias
 * @return total
 */
function getQD_TotGuias(){
	global $sqli_connection;

	//INIT VARS
	$ano = date("Y");

	$totalAll = 0; $totalGT = 1; $totalGR = 2; $totalGD = 3; $totalGC = 4; $totalGA = 5;

	//FILTERS
	$conditionsSeries = '';

	//CALC ALL
	$totalAll = $totalGT+$totalGR+$totalGD+$totalGC+$totalGA;

	//RESPONSE
	return $totalAll;
}

/**
 * Get Total Guias
 * @return total
 */
function getQD_TotFaturas(){
	global $sqli_connection;

	//INIT VARS
	$ano = date("Y");

	$totalAll = 0; $totalFT = 10; $totalFS = 20; $totalFR = 30;

	//FILTERS
	$conditionsSeries = '';

	//CALC ALL
	$totalAll = $totalFT+$totalFS+$totalFR;

	//RESPONSE
	return $totalAll;
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