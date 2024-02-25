<?php
//INCLUDES

include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/webservices_vies_nif/resources/vatValidation.class.php";


//SoapClient Override Class
use vatValidation;
//-------------------------------------------------

//GET POST VARS -----------------------------------
$pais = $_POST['isoCountry'];
$nif = $_POST['vatNumber'];
//-------------------------------------------------

//VALIDATE VARS
if ( !$pais || $pais == '' || !$nif || $nif == '' )
{
    try{
        $data = json_decode(file_get_contents("php://input"),true);
    }catch(Exception $e){
        $data = null;
    }
    if($data){
       /* die(json_encode($data));*/
        $nif = $data['vatNumber'];
        $pais =  $data['isoCountry'];
    }else{
        header('Content-Type: application/json; charset=UTF-8');
        header('HTTP/1.1 400 Bad Request.');
        $response["errors"] = true;
        $response["type"] = "var";
        $response["line"] = "FATS0000A";
        $response["required_fields"] = true;
        $response["message"] = "Campos obrigatórios em falta.";
        die(json_encode($response));
    }
}
//-------------------------------------------------

//INIT VARS
$wsdlViesUE = "http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl";
$urlViesUE = "http://ec.europa.eu/taxation_customs/vies";
$denominationReceived = null;
$nameReceived = null;
$addressReceived = null;
//-------------------------------------------------

//DEFINE SOAPCLIENT OPTIONS
$soap_client_options = array(
	'trace' => 1,
	'debug' => 0,
);
//-------------------------------------------------
//SOAP CLIENT INIT

$soap_client_VIES = new vatValidation($wsdlViesUE, $soap_client_options);
//-------------------------------------------------

//INIT SOAP CLIENT AND PROCESS REQUEST
try {
	// Turn off AUTOCOMMIT and begin Transaction
	mysqli_autocommit($sqli_connection, FALSE);
	$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

	//CALL SERVICE TO CREATE DOCUMENT
	$serverResponse = $soap_client_VIES->checkVatNumber( $pais, $nif );
	// var_dump( $serverResponse );die();
	//-------------------------------------------------

	//PROCESS RECEIVED RESPONSE
	if( isset($serverResponse) && $soap_client_VIES->isValid() === true){
		# PROCESS INCOME RESPONSE
		$denominationReceived = $soap_client_VIES->getDenomination();
		$nameReceived = $soap_client_VIES->getName();
		$addressReceived = $soap_client_VIES->getAddress();
		$response["nameReceived"] = $nameReceived;
		$response["addressReceived"] = $addressReceived;
		//-------------------------------------------------
	}elseif( isset($serverResponse) && $soap_client_VIES->isValid() === false){
		$sqli_connection->rollback();
		header('Content-Type: application/json; charset=UTF-8');
		header('HTTP/1.1 400 Bad Request.');
		$response["errors"] = true;
		$response["type"] = "connection";
		$response["line"] = "WSCONN001";
		$response["message"] = "O nif é inválido.";
		$response["invalid_nif"] = true;
		die(json_encode($response));
	}else{
		$sqli_connection->rollback();
		header('Content-Type: application/json; charset=UTF-8');
		header('HTTP/1.1 400 Bad Request.');
		$response["errors"] = true;
		$response["type"] = "connection";
		$response["line"] = "WSCONN002";
		$response["message"] = $serverResponse;
		$response["failed_request"] = true;
		die(json_encode($response));
	}
	//-------------------------------------------------

	//log sistema
	$descricao_log ="Comunicação com Webservice da VIES: Obtenção de dados sobre o NIF - ".$nif."";
	insert_log(14,"Editar",$descricao_log,$sqli_connection);
	$sqli_connection->commit();
} catch (Exception $e) {
	$sqli_connection->rollback();
	header('Content-Type: application/json; charset=UTF-8');
	header('HTTP/1.1 400 Bad Request.');
	$response["errors"] = true;
	$response["type"] = "connection";
	$response["line"] = "CONN001";
	$response["failed_request"] = true;
	$response["soap_response"] = $e;
	$response["soap_error"] = $e->getMessage();
	die(json_encode($response));
}
//-------------------------------------------------


// PREPARE FINAL DATA ARRAY
$dataFinalArr = array();
$dataFinalArr["nif"] = $nif;
$dataFinalArr["denomination"] = cleanNewLines($denominationReceived);
$dataFinalArr["name"] = cleanNewLines($nameReceived);
$dataFinalArr["full_name"] = cleanNewLines($denominationReceived." ".$nameReceived);
$dataFinalArr["full_address"] = cleanNewLines($addressReceived);
$dataFinalArr["address"] = processPostalCode($addressReceived, "\n", 3);
$dataFinalArr["postalcode"] = processPostalCode($addressReceived, "\n", 1);
$dataFinalArr["city"] = processPostalCode($addressReceived, "\n", 2);
$dataFinalArr["cityID"] = 0;
$dataFinalArr["regionID"] = 0;
$dataFinalArr["localeID"] = 0;
$dataFinalArr["locale"] = '';
if($pais == 'PT'){
	$dadosPT = getCityAndRegionIds( $dataFinalArr["city"] );
	$dataFinalArr["cityID"] = $dadosPT["cityID"];
	$dataFinalArr["regionID"] = $dadosPT["regionID"];
	$dataFinalArr["localeID"] = $dadosPT["localeID"];
	$dataFinalArr["locale"] = $dadosPT["locale"];
}
/*die(json_encode('PREPARE 5'));*/
header('Content-Type: application/json; charset=UTF-8');
/*header('HTTP/1.1 200 Ok.');*/

$response["errors"] = false;
$response["data"] = $dataFinalArr;
die(json_encode($response));


# =================================================
# HELPERS
# =================================================

# PROCESS POSTAL CODE FROM ADDRESS
function processPostalCode($stringToCheck, $delimiter = "\n", $option = 1){
	# INIT VARS
	$finalElement = "";

	# PROCESS OPTION
	switch ($option) {
		//POSTAL CODE
		case 1:
			$auxArr = explode($delimiter, $stringToCheck);
			$lastElement = end($auxArr);
			$finalElement = explode(" ", $lastElement)[0];
			break;
		//CITY
		case 2:
			$auxArr = explode($delimiter, $stringToCheck);
			$lastElement = end($auxArr);
			$searchElement = explode(" ", $lastElement)[0];
			$finalElement = str_replace($searchElement, "", $lastElement);
			break;
		//ADDRESS ONLY
		case 3:
			$auxArr = explode($delimiter, $stringToCheck);
			$lastElement = end($auxArr);
			$searchElement = explode(" ", $lastElement)[0];
			$posLimit = stripos($stringToCheck, $searchElement);
			if($posLimit > 0) $finalElement = substr($stringToCheck, 0, $posLimit);
			else $stringToCheck;
			break;

		default: break;
	}

	# RESPONSE
	return cleanNewLines($finalElement);
}

# CLEAN "\n" FROM STRING
function cleanNewLines($stringToClean){
	$cleanedString = str_replace("\n"," ",$stringToClean);
	$cleanedString = mb_strtolower($cleanedString,'UTF-8');
	$cleanedString = ucwords($cleanedString);
	$cleanedString = trim($cleanedString);

	return $cleanedString;
}

# GET CITY_ID AND REGION_ID IF AVAILABLE
function getCityAndRegionIds($cityLabel){
	global $sqli_connection;

	# INIT VARS
	$objectArray = array("cityID" => 0, "regionID" => 0, "localeID" => 0, "locale" => '');
	$cityLabelPrepared = "".strtolower($cityLabel)."";
	// var_dump($cityLabelPrepared);

	# PROCESS QUERY
	$query = "SELECT ID_Concelho, ID_Distrito FROM concelho WHERE LCASE( Nome ) LIKE ? LIMIT 1";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$stmt -> bind_param("s", $cityLabelPrepared);
		$result = $stmt -> execute();
		if (false === $result) { }
		$stmt -> store_result();
		$stmt -> bind_result(
			$objectArray["cityID"],
			$objectArray["regionID"]
		);
		$stmt -> fetch();
		$stmt -> close();
	} else { }
	# ---------------------------------------------------

	# PROCESS QUERY
	$cityLabelPrepared = "%".strtolower($cityLabel)."%";
	$query = "SELECT ID_Freguesia, Nome FROM freguesia WHERE LCASE( Nome ) LIKE ? AND ID_Concelho=? LIMIT 1";
	if ( $stmt = $sqli_connection -> prepare($query) ) {
		//result
		$stmt -> bind_param("sd", $cityLabelPrepared, $objectArray["cityID"]);
		$result = $stmt -> execute();
		if (false === $result) { }
		$stmt -> store_result();
		$stmt -> bind_result(
			$objectArray["localeID"],
			$objectArray["locale"]
		);
		$stmt -> fetch();
		$stmt -> close();
	} else { }
	# ---------------------------------------------------

	# Return response
	return $objectArray;
}
