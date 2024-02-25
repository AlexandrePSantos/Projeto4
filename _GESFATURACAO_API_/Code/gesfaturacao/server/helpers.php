<?php
include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/rolesPermsFunctions.php';

$helpersFile = true;

/**
 * |-----------------------------------------------------------------------
 * |
 * |						Helper Functions
 * |
 * | Functions to be used anytime, anywhere. Just like a service provider.
 * |
 * |-----------------------------------------------------------------------
 */

/**
 * INIT FUNCTIONS FOR DB COMMON UPDATES
 */
if(!function_exists('updateCurrencyTable')){
	function updateCurrencyTable(){
		global $sqli_connection;

		return true;
	}
}
# ----------------------------------------------------------------------- #
# ----------------------------------------------------------------------- #

/**
 * |-----------------------------------------------------------------------
 * |			Special Profiles Functions (Modules Permissions)
 * |-----------------------------------------------------------------------
 */

/**
 * CHECK IF GIVEN MODULE HAS PERMISSION FOR CURRENT USER
 * @param  $ColPermission - Name Col DB
 * @return response (value)
 */
if(!function_exists('checkProfilePermission')){
	function checkProfilePermission($ColPermission){
		global $sqli_connection;

		//INIT VARS
		$ProfilePerm = 1;

		//response
		return $ProfilePerm;
	}
}
# ----------------------------------------------------------------------- #
# ----------------------------------------------------------------------- #

/**
 * Check if the user is account accountant or not
 * @param  $userID
 * @return bool
 */
if(!function_exists('encomendaAquiUser')){
	function encomendaAquiUser(){
		global $sqli_connection;

		return false;
	}
}

/**
 * Check if the user is account accountant or not
 * @param  $userID
 * @return bool
 */
if(!function_exists('efetuaPedidosUser')){
	function efetuaPedidosUser(){
		global $sqli_connection;

		return false;
	}
}

/**
 * Check if the user is account accountant or not
 * @param  $userID
 * @return bool
 */
if(!function_exists('contabilistaCheck')){
	function contabilistaCheck(){
		global $sqli_connection;

		return false;
	}
}

/**
 * Check if the user is account from system
 * @param  $userID
 * @return bool
 */
if(!function_exists('systemUserCheck')){
	function systemUserCheck(){
		global $sqli_connection;

		//return
		return true;
	}
}

/**
 * Check if the user is admin
 * @param  $userID
 * @return bool
 */
if(!function_exists('adminCheck')){
	function adminCheck(){
		global $sqli_connection;

		//return
		return true;
	}
}

/**
 * Check if the normal user has admin rights
 * @param  $userID
 * @return bool
 */
if(!function_exists('adminUserCheck')){
	function adminUserCheck(){
		global $sqli_connection;

		//return
		return true;
	}
}

/**
 * Validate Serie de Integração
 * @param $idSerie
 * @param $integration
 */
if(!function_exists('validateSerieIntegracao')){
	function validateSerieIntegracao($idSerie){
		global $sqli_connection;

		$result = false;
	}
}

/**
 * Validate Serie
 * @param $idSerie
 * @param $integration
 */
if(!function_exists('validateSerie')){
	function validateSerie($idSerie, $integration = false){
		global $sqli_connection;

		$response["errors"] = false;
		return json_encode($response);
	}
}

/**
 * Validate Serie - ATCUD
 * @param $idSerie
 * @param $typeDocument
 * @param $integration
 */
if(!function_exists('validateSerieAtcud')){
	function validateSerieAtcud($idSerie, $typeDocument, $dateDocument, $integration = false){
		global $sqli_connection;

		$response["errors"] = false;
		return json_encode($response);
	}
}

/**
 * Get the available series for current user
 * @return string $ids
 */
if(!function_exists('getAvailableSeries')){
	function getAvailableSeries($listagens=false){
		global $sqli_connection;

		//return
		return "1";
	}
}

/**
 * Get the Next ID for table
 * @param  $fieldName
 * @param  $tableName
 * @return next id
 */
if(!function_exists('getNextID')){
	function getNextID($fieldName,$tableName){
		global $sqli_connection;

		//process
		$query = "SELECT MAX(CAST(".$fieldName." AS UNSIGNED)) FROM ".$tableName."";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//result
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP001";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> store_result();
			$stmt -> bind_result($nextID);
			$stmt -> fetch();
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP002";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		//return next id
		return $nextID+1;
	}
}

/**
 * Get The base table
 * @return return base table string
 */
if(!function_exists('getSncBaseTable')){
	function getSncBaseTable(){
		global $sqli_connection;
		//GET SNC TABLE IN USE --------------------------------------------------
		$snc_table = '';

		return "faturacao_snc_base";
	}
}

/**
 * Get Valores Padrão
 * @return padrão
 */
if(!function_exists('getValorPadrao')){
	function getValorPadrao($fieldName, $tableName){
		global $sqli_connection;
		$padrao = '';

		//process
		$query = "SELECT ".$fieldName." FROM ".$tableName." LIMIT 1";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//result
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP005";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> store_result();
			$stmt -> bind_result($padrao);
			$stmt -> fetch();
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP006";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		return $padrao;
	}
}

/**
 * Get Valores Padrão
 * @return padrão
 */
if(!function_exists('checkHasGatewayActive')){
	function checkHasGatewayActive(){
		global $sqli_connection;
		$padrao = 0;
		return $padrao;
	}
}

/**
 * Check if document can be edited
 * @param  $idObject
 * @param  $statusFieldName
 * @param  $statusString
 * @param  $tableName
 * @return bool
 */
if(!function_exists('checkIfCanBeEdit')){
	function checkIfCanBeEdit($idObject, $idFieldName, $statusFieldName, $statusString, $tableName){
		global $sqli_connection;
		$canEdit = false;

		//process
		$query = "SELECT ".$statusFieldName." FROM ".$tableName." WHERE ".$idFieldName." = ".$idObject." LIMIT 1";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//result
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP007";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> store_result();
			$stmt -> bind_result($statusDB);
			$stmt -> fetch();
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP008";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		if( $statusDB != $statusString ) $canEdit = false;
		else $canEdit = true;

		return $canEdit;
	}
}

/**
 * Reset Payment Line totals (ND and NC doc. types)
 * @param  $objectLine [Document payment line]
 * @return response
 */
if(!function_exists('resetDocumentLineTotals')){
	function resetDocumentLineTotals($objectLine){
		global $sqli_connection;
		$resultChecker = true;

		return true;
	}
}

/**
 * Check payment values
 * @param  $idObject
 * @param  $statusFieldName
 * @param  $statusString
 * @param  $tableName
 * @return bool
 */
if(!function_exists('resetDocumentPaymentTotals')){
	function resetDocumentPaymentTotals($idDocument, $type){
		global $sqli_connection;
		return true;
	}
}

/**
 * Increase the stock levels for the articles present on the document
 * @param  $idDocument
 * @param  $tableName
 * @param  $fieldName
 * @return bool
 */
if(!function_exists('increaseArticlesStock')){
	function increaseArticlesStock($idDocument, $tableName, $fieldName){
		global $sqli_connection;
		$result = true;

		//return
		return $result;
	}
}

/**
 * Check if stock has at least stockMin value - Before Confirm Docs
 * @param  $articlesLines
 * @return bool
 */
if(!function_exists('checkMinStockBeforeConfirm')){
	function checkMinStockBeforeConfirm($articlesLines){
		global $sqli_connection;

		//return
		return [];
	}
}

/**
 * Check if stock has at least stockMin value
 * @param  $idDocument
 * @param  $tableName
 * @param  $fieldName
 * @return bool
 */
if(!function_exists('checkMinStock')){
	function checkMinStock($idDocument, $tableName, $fieldName){
		global $sqli_connection;

		//return
		return [];
	}
}

/**
 * Decrease the stock levels for the articles present on the document
 * @param  $idDocument
 * @param  $tableName
 * @param  $fieldName
 * @return bool
 */
if(!function_exists('decreaseArticlesStock')){
	function decreaseArticlesStock($idDocument, $tableName, $fieldName){
		global $sqli_connection;
		$result = true;

		//return
		return $result;
	}
}

/**
 * GET ALL CHILDREN FROM ARTICLE ID
 * @param  $articleID
 * @param  $qtdParentCalc
 * @return Array of Children
 */
if(!function_exists('getChildsFromArticle')){
	function getChildsFromArticle($articleID, $qtdParentCalc = 1){
		global $sqli_connection;

		//INIT VARS
		$childsList = array();

		//RETURN THE FINAL ARRAY
		return $childsList;
	}
}

/**
 * GET ALL CHILDREN FROM ARTICLE ID
 * @param  $originLine
 * @param  $originDoc
 * @param  $originType
 * @param  $newQtdLine
 * @return Array of Children
 */
if(!function_exists('getChildsFromArticleNCs')){
	function getChildsFromArticleNCs($originDoc, $originType, $originLine, $QtdTotalLineOrigin, $newQtdLine){
		global $sqli_connection;

		//INIT VARS
		$childsListOrigin = array();

		//RETURN THE FINAL ARRAY
		return $childsListOrigin;
	}
}

/**
 * GET COMPOSED ARTICLES LINES USING LINE ID
 * @param  $idDocumento
 * @param  $tipoDocumento
 * @param  $linhaDocumento
 * @return array
 */
if(!function_exists('getArtigosCompostosByLinha')){
	function getArtigosCompostosByLinha($idDocumento, $tipoDocumento, $linhaDocumento){
		global $sqli_connection;

		//init some vars
		$articlesComposed = array();

		//return
		return $articlesComposed;
	}
}

/**
 * Block Articles directly (used in composed)
 * @param  $idArticle
 * @return response
 */
if(!function_exists('blockArticleById')){
	function blockArticleById($idArticle){
		global $sqli_connection;

		//response
		return true;
	}
}

/**
 * GET ALL CHILDREN FROM ARTICLE ID
 * @param  $articleID
 * @param  $qtdParentCalc
 * @return Array of Children
 */
if(!function_exists('getChildsFromArticleCostPrice')){
	function getChildsFromArticleCostPrice($articleID, $qtdParentCalc = 1){
		global $sqli_connection;

		//INIT VARS
		$childsList = array();

		//RETURN THE FINAL ARRAY
		return $childsList;
	}
}

/**
 * GET ALL CHILDREN FROM ARTICLE ID
 * @param  $articleID
 * @param  $qtdParentCalc
 * @return Array of Children
 */
if(!function_exists('getChildsFromArticleCostPriceDocs')){
	function getChildsFromArticleCostPriceDocs($idDoc, $typeDoc, $lineDoc, $useInitCosts = 0, $limitDate = ''){
		global $sqli_connection;

		//INIT VARS
		$childsList = array();

		//RETURN THE FINAL ARRAY
		return $childsList;
	}
}

/**
 * Update Document Status
 * @param  $idObject
 * @param  $statusFieldName
 * @param  $statusString
 * @param  $tableName
 * @return bool
 */
if(!function_exists('updateEstadoDocumento')){
	function updateEstadoDocumento($idObject, $idFieldName, $statusFieldName, $statusString, $tableName){
		global $sqli_connection;
		$result = true;

		//process
		$query = "UPDATE ".$tableName." SET ".$statusFieldName." = ? WHERE ".$idFieldName." = ".$idObject." ";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//bind params
			$stmt -> bind_param("s", $statusString);
			//result
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP060";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP061";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		return $result;
	}
}

/**
 * Get City Name - Portugal Only
 * @return name
 */
if(!function_exists('getCidadePortugal')){
	function getCidadePortugal($ID_Cidade=0, $StringName = ''){
		global $sqli_connection;
		$cidade = '';
		$usedField = $ID_Cidade;

		//process
		if($ID_Cidade > 0){
			$query = "SELECT Nome FROM concelho WHERE ID_Concelho = ?";
			$usedField = $ID_Cidade;
		}else{
			$query = "SELECT ID_Concelho FROM concelho WHERE Nome LIKE ?";
			$usedField = $StringName;
		}
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//bind param
			$stmt -> bind_param("s", $usedField);
			//result
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP062";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> store_result();
			$stmt -> bind_result($cidade);
			$stmt -> fetch();
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP063";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		if($cidade)
			return $cidade;
		else
			return '';
	}
}

/**
 * Get Region Name - Portugal Only
 * @return name
 */
if(!function_exists('getRegiaoPortugal')){
	function getRegiaoPortugal($ID_Regiao=0, $StringName = 0){
		global $sqli_connection;
		$regiao = '';
		$usedField = $ID_Regiao;

		//process
		if($ID_Regiao > 0){
			$query = "SELECT Nome FROM distrito WHERE ID_Distrito = ?";
			$usedField = $ID_Regiao;
		}else{
			$query = "SELECT ID_Distrito FROM distrito WHERE Nome LIKE ?";
			$usedField = $StringName;
		}
		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//bind param
			$stmt -> bind_param("s", $usedField);
			//result
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP062";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> store_result();
			$stmt -> bind_result($regiao);
			$stmt -> fetch();
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP063";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		if($regiao)
			return $regiao;
		else
			return '';
	}
}

/**
 * Check if the year in given date exists in Anos Fiscais table
 * @return boolean
 */
if(!function_exists('validateAnoFiscal')){
	function validateAnoFiscal($dataDoc){
		global $sqli_connection;

		return true;
	}
}

/**
 * Block Documents with date bigger than 30 days before.
 * @return boolean
 */
if(!function_exists('validate5days')){
	function validate5days($dataDoc, $formato = 'd/m/Y'){
		global $sqli_connection;

		return true;
	}
}

/**
 * Get last .
 * @return boolean
 */
if(!function_exists('getLastDateSaft')){
	function getLastDateSaft(){
		global $sqli_connection;

		$lastDate = '2018-01-01';

		return $lastDate;
	}
}

/**
 * Block Documents with date bigger than 30 days before.
 * @return boolean
 */
if(!function_exists('validateExportado')){
	function validateExportado($dataDoc, $formato = 'd/m/Y'){
		global $sqli_connection;

		return true;
	}
}

/**
 * Get Hash of previous document of same type
 * @return string
 */
if(!function_exists('get_hash')){
	function get_hash($type, $idSerie, $numero) {
		global $sqli_connection;
		$result = 'ZPzTZPfNHDNajoOmQG+M43f5DR2tfQW+rOh3Jc6xdccNQltFJt7C2K0awWrqLaQJpmd+F06jfcaF6uCBseec962MJNmmDpfpqzwMmEp3ykF0yaPwHSTSN/LHlR2YhqWMDtPitqlGe9KaKc8tZFiKTCBMOBxoLyigynZgfmRVd3o=';
		return $result[0].$result[10].$result[20].$result[30];
	}
}

/**
 * Get column value of first element in a given table meeting given condition (optional)
 * @param  string $tableName
 * @param  string $fieldName
 * @param  array  $conditions optional
 * @param  int	$limit 	  optional
 * @return string
 */
if(!function_exists('get_field')){
	function get_field($tableName, $fieldName, $conditions = null, $limit = 1){
		global $sqli_connection;
		$campo = null;
		$campos = array();

		$query = "SELECT ".$fieldName." FROM ".$tableName;
		if(!empty($conditions)){
			$query .= " WHERE ";
			foreach ($conditions as $columnName => $valueFilter) {
				$query .= $columnName."='".$valueFilter."'";
				$query .= " AND ";
			}
			$query = substr($query, 0, -5);
		}

		if($limit != 0)	$query .= " LIMIT ".$limit;

		if ( $stmt = $sqli_connection -> prepare($query) ) {
			//result
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP005";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> store_result();
			$stmt -> bind_result($campo);
			if($limit == 0){
				while( $stmt -> fetch() ){
					$campos[] = $campo;
				}
			} else {
				$stmt -> fetch();
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP006.2";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}
		if($limit == 0){
			return $campos;
		} else {
			return $campo;
		}
	}
}

/**
 * Generate a new hash
 * @return string
 */
if(!function_exists('gen_hash')){
	function gen_hash($invoice_date, $system_entry_date, $doc_type, $id_serie, $numero, $gross_total) {
		$result = 'ZPzTZPfNHDNajoOmQG+M43f5DR2tfQW+rOh3Jc6xdccNQltFJt7C2K0awWrqLaQJpmd+F06jfcaF6uCBseec962MJNmmDpfpqzwMmEp3ykF0yaPwHSTSN/LHlR2YhqWMDtPitqlGe9KaKc8tZFiKTCBMOBxoLyigynZgfmRVd3o=';
		$data = array ("hash" => $result, "hash_print" => $result[0].$result[10].$result[20].$result[30]);
		return $data;
	}
}

/**
 * Generate a new hash for online integration modules
 * @return string
 */
if(!function_exists('gen_hash_integracao')){
	function gen_hash_integracao($invoice_date, $system_entry_date, $doc_type, $id_serie, $numero, $gross_total) {
		$result = 'ZPzTZPfNHDNajoOmQG+M43f5DR2tfQW+rOh3Jc6xdccNQltFJt7C2K0awWrqLaQJpmd+F06jfcaF6uCBseec962MJNmmDpfpqzwMmEp3ykF0yaPwHSTSN/LHlR2YhqWMDtPitqlGe9KaKc8tZFiKTCBMOBxoLyigynZgfmRVd3o=';
		$data = array ("hash" => $result, "hash_print" => $result[0].$result[10].$result[20].$result[30]);
		return $data;
	}
}

/**
 * Check the usage of specific plan comptable
 * @param  $idPlano
 * @return bool
 */
if(!function_exists('checkPlanoContasUsage')){
	function checkPlanoContasUsage($codePlano){
		global $sqli_connection;

		//returner flag
		$checker = false;

		return $checker;
	}
}

/**
 * Get Plano Code
 * @return code
 */
if(!function_exists('getPlanoCode')){
	function getPlanoCode($fieldName, $tableName, $fieldObject, $idObject){
		global $sqli_connection;
		$code = '';

		//return
		return $code;
	}
}

/**
 * Inserir Novo Movimento Contabilistico
 * @param  $PlanoContas
 * @param  $Descricao
 * @param  $TotalPVP
 * @param  $TotalUnit
 * @param  $TotalIVA
 * @param  $TipoMovimento
 * @return result (bool)
 */
if(!function_exists('insertMovimentoContabilistico')){
	function insertMovimentoContabilistico($PlanoContas, $Descricao, $TotalPVP, $TotalUnit, $TotalIVA, $TipoMovimento, $id_cliente){
		global $sqli_connection;
		$result = true;

		//return result
		return $result;
	}
}

/**
 * Inserir Novo Movimento Contabilistico (Manual)
 * @param  $PlanoContas
 * @param  $Descricao
 * @param  $TotalPVP
 * @param  $TotalUnit
 * @param  $TotalIVA
 * @param  $TipoMovimento
 * @param  $DataMovimento
 * @return result (bool)
 */
if(!function_exists('insertMovimentoContabilisticoManual')){
	function insertMovimentoContabilisticoManual($PlanoContas, $Descricao, $TotalPVP, $TotalUnit, $TotalIVA, $TipoMovimento, $DataMovimento){
		global $sqli_connection;
		$result = true;

		//return result
		return $result;
	}
}

/**
 * Sum 1 print to a document
 * @return void
 */
if(!function_exists('count_print')){
	function count_print($tipoDoc, $idDocumento) {
		global $sqli_connection;
		return true;
	}
}

/**
 * Inserir registo de exportação de um documento
 * @param  $tipoDoc
 * @param  $dataInicio
 * @param  $dataFim
 * @param  $sqli_connection
 * @return success state (boolean)
 */
if(!function_exists('insertDocumentoExportado')){
	function insertDocumentoExportado($tipoDoc, $dataInicio, $dataFim, $sqli_connection) {
		$data_registo = date('Y-m-d');
		return true;
	}
}

/**
 * Inserir registo de exportação de SAFT
 * @param  $filepath
 * @param  $dataInicio
 * @param  $dataFim
 * @param  $typeExport
 * @param  $email_destino
 * @param  $sqli_connection
 * @return [response id or bool]
 */
if(!function_exists('insertExportacaoSAFT')){
	function insertExportacaoSAFT($filepath, $dataInicio, $dataFim, $typeExport, $email_destino, $sqli_connection) {
		return 1;
	}
}

/**
 * Update registo de exportação de SAFT
 * @param  $id_exportacao
 * @param  $filepath
 * @param  $sqli_connection
 * @return [bool]
 */
if(!function_exists('updateExportacaoSAFT')){
	function updateExportacaoSAFT($id_exportacao, $filepath, $sqli_connection) {
		return true;
	}
}

/**
 * Generate EAN (Barcode) for products
 * @param  $number [description]
 * @return barcodestring
 */
if(!function_exists('generateEAN')){
	function generateEAN($number, $prefix = null) {
		//init vars
		$finPrefix = '560';
		if($prefix && $prefix > 0) $finPrefix = 560;

		//processed new barcode (EAN)
		$code = $finPrefix . str_pad($number, 9, '0');
		$weightflag = true;
		$sum = 0;

		// Weight for a digit in the checksum is 3, 1, 3.. starting from the last digit.
		// loop backwards to make the loop length-agnostic. The same basic functionality
		// will work for codes of different lengths.
		for ($i = strlen($code) - 1; $i >= 0; $i--)
		{
			$sum += (int)$code[$i] * ($weightflag?3:1);
			$weightflag = !$weightflag;
		}

		//final code
		$code .= (10 - ($sum % 10)) % 10;

		//result response
		return $code;
	}
}

/**
 * Generate Random Number
 * @param  $length [description]
 * @return randomString
 */
if(!function_exists('generateRandomNumber')){
	function generateRandomNumber($length = 9) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

/**
 * Generate EAN (Barcode) for products
 * @return barcodestring
 */
if(!function_exists('generateEANRandom')){
	function generateEANRandom() {
		global $sqli_connection;
		$code = generateEAN(generateRandomNumber(9));
		return $code;
	}
}

/**
 * Check and Validate Barcode (13 digits long - EAN13Barcode)
 * @param  $barcode
 * @return boolean
 */
if(!function_exists('validate_EAN13Barcode')){
	function validate_EAN13Barcode($barcode) {
		// check to see if barcode is 13 digits long
		if (!preg_match("/^[0-9]{13}$/", $barcode)) {
			return false;
		}

		$digits = $barcode;

		// 1. Add the values of the digits in the
		// even-numbered positions: 2, 4, 6, etc.
		$even_sum = $digits[1] + $digits[3] + $digits[5] + $digits[7] + $digits[9] + $digits[11];

		// 2. Multiply this result by 3.
		$even_sum_three = $even_sum * 3;

		// 3. Add the values of the digits in the
		// odd-numbered positions: 1, 3, 5, etc.
		$odd_sum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8] + $digits[10];

		// 4. Sum the results of steps 2 and 3.
		$total_sum = $even_sum_three + $odd_sum;

		// 5. The check character is the smallest number which,
		// when added to the result in step 4, produces a multiple of 10.
		$next_ten = (ceil($total_sum / 10)) * 10;
		$check_digit = $next_ten - $total_sum;

		// if the check digit and the last digit of the
		// barcode are OK return true;
		if ($check_digit == $digits[12]) {
			return true;
		}

		return false;
	}
}

/**
 * Get Default CentroCusto
 * @return html
 */
if(!function_exists('getDefaultCentroCusto')){
	function getDefaultCentroCusto() {
		global $sqli_connection;

		//init vars
		$objectLine = array();

		//return
		return $objectLine;
	}
}

/**
 * Get Ref Document
 * @param $idDoc
 * @param $tipoDoc
 * @return void
 */
if(!function_exists('getReferenciaDocumento')){
	function getReferenciaDocumento($idDoc, $tipoDoc) {
		//init vars
		global $sqli_connection;
		$composeFieldSel = '';
		$refDocumento = '';

		//return reference
		return $refDocumento;
	}
}

/**
 * Get Ref Document
 * @param $idDoc
 * @param $tableName
 * @param $fieldName
 * @return void
 */
if(!function_exists('getReferenciaDocumentoTable')){
	function getReferenciaDocumentoTable($idDoc, $tableName, $fieldName) {
		//init vars
		global $sqli_connection;
		$composeFieldSel = '';
		$refDocumento = '';
		$estadoDocumento = '';
		$tipoDoc = '';
		$tipoDocExtenso = '';

		$objectFinal = array("ID_Documento" => null, "Tipo_Documento" => null, "Tipo_Documento_Extenso" => null,"Ref_Documento" => null, "Estado_Documento" => null );

		//return reference
		return $objectFinal;
	}
}

/**
 * Inserir registo de logs de artigos
 * @param  $idArtigo
 * @param  $acao
 * @param  $idDocAssociado
 * @param  $tipoDocAssociado
 * @param  $stockAnterior
 * @param  $stockPosterior
 * @return success state (boolean)
 */
if(!function_exists('insert_log_artigo')){
	function insert_log_artigo($idArtigo, $acao, $idDocAssociado = 0, $tipoDocAssociado = null, $stockAnterior = 0, $stockPosterior = 0, $sqli_connection = null) {
		//init vars
		$data_registo_human = date('d/m/Y H:i:s');
		$data_registo = date('Y-m-d H:i:s');

		//process user of creation
		$id_utilizador = $_SESSION['id_utilizador'];
		$criador = $_SESSION['nome_utilizador'];

		if(!$id_utilizador) $id_utilizador = 0;
		if(!$criador) $criador = 'Sistema';

		//process origin document
		$refDocAssociado = '-';
		if($idDocAssociado > 0 && $tipoDocAssociado != null) $refDocAssociado = getReferenciaDocumento($idDocAssociado, $tipoDocAssociado);

		//process IP
		$ip = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		//process
		$query = "INSERT INTO faturacao_artigos_registos
		(ID_Artigo, Data, DataSistema, Acao, ID_Doc_Associado, Tipo_Doc_Associado, Ref_Doc_Associado, StockAnterior, StockPosterior, ID_Utilizador, NomeUtilizador, IP) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("ssssssssssss", $idArtigo, $data_registo_human, $data_registo, $acao, $idDocAssociado, $tipoDocAssociado, $refDocAssociado, $stockAnterior, $stockPosterior, $id_utilizador, $criador, $ip);
			$result = $stmt -> execute();
			if (false === $result) {
				return false;
			}
			$stmt -> close();
		} else {
			return false;
		}

		return true;
	}
}

/* ===================================
 * ---------- API - Pagamentos Gateway -----------
 * =================================== */

/**
 * Get the config data for active gateway API
 * @return data array
 */
if(!function_exists('getGatewayConfig')){
	function getGatewayConfig(): array{
		global $sqli_connection;
		//init vars
		$objectData = array();
		return $objectData;
	}
}

/* ===================================
 * ---------- API - EuPago -----------
 * =================================== */

/**
 * Get the config data for EuPago API
 * @return data array
 */
if(!function_exists('getEupagoApiConfigs')){
	function getEupagoApiConfigs() {
		global $sqli_connection;
		//init vars
		$objectData = array();
		//return
		return $objectData;
	}
}

/**
 * ===================================
 * REST API - EuPago
 *
 * SANDBOX (TESTES)
 * https://sandbox.eupago.pt/clientes/rest_api
 *
 * PRODUÇÃO
 * https://clientes.eupago.pt/clientes/rest_api
 * ===================================
 */

/**
 * Get Info From Ref MB
 * @param $urlConnection
 * @param $chave
 * @param $referencia
 * @param $entidade
 * @return data array
 */
if(!function_exists('getRefMBInfo')){
	function getRefMBInfo($urlConnection, $chave, $referencia, $entidade = null) {
		global $sqli_connection;

		//init vars
		$objectData = array();

		//return
		return $objectData;
	}
}

/**
 * Get Info From Payshop
 * @param $urlConnection
 * @param $chave
 * @param $referencia
 * @param null
 * @return data array
 */
if(!function_exists('getPayshopInfo')){
	function getPayshopInfo($urlConnection, $chave, $referencia, $entidade = null) {
		global $sqli_connection;

		//init vars
		$objectData = array();

		//return
		return $objectData;
	}
}

/**
 * Generate New Ref MB
 * @param $urlConnection
 * @param $chave
 * @param $referenciaInterna
 * @param $valorPagar
 * @param $dataInicio
 * @param $dataFim
 * @param $perDup
 * @return data array
 */
if(!function_exists('generateRefMB')){
	function generateRefMB($urlConnection, $chave, $referenciaInterna, $valorPagar, $dataInicio, $dataFim, $perDup = 0) {
		global $sqli_connection;

		//init vars
		$objectData = array();
		$urlCallback = "https://".$_SERVER['HTTP_HOST']."/gesfaturacao/server/payments_callback/callback.php";

		//return
		return $objectData;
	}
}

/**
 * Generate New Payshop
 * @param $urlConnection
 * @param $chave
 * @param $referenciaInterna
 * @param $valorPagar
 * @param $dataInicio
 * @param $dataFim
 * @param $perDup
 * @return data array
 */
if(!function_exists('generatePayshop')){
	function generatePayshop($urlConnection, $chave, $referenciaInterna, $valorPagar) {
		global $sqli_connection;

		//init vars
		$objectData = array();
		$urlCallback = "https://".$_SERVER['HTTP_HOST']."/gesfaturacao/server/payments_callback/callback.php";

		//return
		return $objectData;
	}
}

/**
 * ===================================
 * SOAP API - EuPago
 *
 * SANDBOX (TESTES)
 * https://sandbox.eupago.pt/replica.eupagov14.wsdl
 *
 * PRODUÇÃO
 * https://clientes.eupago.pt/eupagov16.wsdl
 * ===================================
 */

/**
 * Get Info From Ref MB
 * @param $urlConnection
 * @param $chave
 * @param $referencia
 * @param $entidade
 * @return data array
 */
if(!function_exists('getRefMBInfoSOAP')){
	function getRefMBInfoSOAP($urlConnection, $chave, $referencia, $entidade = null) {
		global $sqli_connection;

		//init vars
		$objectData = array();

		//return
		return $objectData;
	}
}

/**
 * Get Info From Payshop
 * @param $urlConnection
 * @param $chave
 * @param $referencia
 * @param $entidade
 * @return data array
 */
if(!function_exists('getPayshopInfoSOAP')){
	function getPayshopInfoSOAP($urlConnection, $chave, $referencia, $entidade = null) {
		global $sqli_connection;

		//init vars
		$objectData = array();

		//return
		return $objectData;
	}
}

/**
 * Generate New Ref MB
 * @param $urlConnection
 * @param $chave
 * @param $referenciaInterna
 * @param $valorPagar
 * @param $dataInicio
 * @param $dataFim
 * @param $perDup
 * @return data array
 */
if(!function_exists('generateRefMBSOAP')){
	function generateRefMBSOAP($urlConnection, $chave, $referenciaInterna, $valorPagar, $dataInicio, $dataFim, $perDup = 0) {
		global $sqli_connection;

		//init vars
		$objectData = array();
		$urlCallback = "https://".$_SERVER['HTTP_HOST']."/gesfaturacao/server/payments_callback/callback.php";

		//return
		return $objectData;
	}
}

/**
 * Generate New Payshop
 * @param $urlConnection
 * @param $chave
 * @param $referenciaInterna
 * @param $valorPagar
 * @param $dataInicio
 * @param $dataFim
 * @param $perDup
 * @return data array
 */
if(!function_exists('generatePayshopSOAP')){
	function generatePayshopSOAP($urlConnection, $chave, $referenciaInterna, $valorPagar) {
		global $sqli_connection;

		//init vars
		$objectData = array();
		$urlCallback = "https://".$_SERVER['HTTP_HOST']."/gesfaturacao/server/payments_callback/callback.php";

		//return
		return $objectData;
	}
}


/**
 * Generate New Ref MB
 */
if(!function_exists('generatePaymentSIBS')) {
	function generatePaymentSIBS($urlTransaction,$bearerToken, $clientID, $terminalID, $entity, $paymentID, $value, $days, $method,$phone = null) {
		return;
	}
}

/**
 * Cancel transaction
 */

if(!function_exists('cancelPaymentSIBS')){
	function cancelPaymentSIBS($urlTransaction,$bearerToken, $clientID,$transactionID) {
		return;
	}
}

/**
 * Get QRCode String
 * @return string
 */
if(!function_exists('get_qrcode')){
	function get_qrcode($type, $idDocument) {
		global $sqli_connection;
		$str_qrcode = '123*456*789';
		$response["errors"] = false;
		$response["qrcode"] = $str_qrcode;
		return $response;
	}
}

/**
 * Get fields of doc table by doc type
 * @param  $tipo_documento
 * @return array with fields
 */
if(!function_exists('getDocumentDBFieldsByType')){
	function getDocumentDBFieldsByType($tipo_documento) {
		//init vars
		$objectDataArray = array();

		//response
		return $objectDataArray;
	}
}

/**
 * Check if Payment Method needs Bank ID
 * @param  $paymentMethod
 * @return bool
 */
if(!function_exists('checkIfNeedsBank')){
	function checkIfNeedsBank($paymentMethod) {
		global $sqli_connection;

		//init some vars
		$needsBank = false;

		//return response
		return $needsBank;
	}
}

/**
 * Get list of <options/> with available years for history select box
 * @return $listYears [array of years]
 */
if(!function_exists('getYearsHistoryOtps')){
	function getYearsHistoryOtps() {
		global $sqli_connection;

		//init vars
		$currentYear = intval($_SESSION['ano']);
		$listYearsStrs = array();
		$listYears = array(
			array(
				"ano_val" => $currentYear,
				"ano_label" => $currentYear,
			)
		);

		//generate <options/>
		foreach ($listYears as $yearItem) {
			$selectedAttr = intval($yearItem['ano_val']) == $currentYear ? 'selected="selected"' : '';

			array_push($listYearsStrs, '<option value="'.$yearItem['ano_val'].'" '.$selectedAttr.'>'.$yearItem['ano_label'].'</option>');
		}

		//response
		return $listYearsStrs;
	}
}

/**
 * Get list of <options/> with available series for history select box
 * @return $listSeries [array of series]
 */
if(!function_exists('getSeriesHistoryOtps')){
	function getSeriesHistoryOtps() {
		global $sqli_connection;

		$listSeriesStrs = array();

		//response
		return $listSeriesStrs;
	}
}

/**
 * Get All Ids Associated to the Current ClientID
 * @param $clientID
 * @return array $previousIds
 */
if(!function_exists('getUserIdsHistory')){
	function getUserIdsHistory($clientID){
		global $sqli_connection;

		//Init Some Vars
		$previousIDS = [];

		return $previousIDS;
	}
}

/**
 * Get Current CAE from Selected Serie
 * @param $idSerie
 * @return string $cae_code
*/
if (!function_exists('getCaeFromSerie')) {
	function getCaeFromSerie($idSerie){
		global $sqli_connection;

		//init vars
		$cae_code = '';

		//return response
		return $cae_code;
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// 								LOW PRIORITY RESOURCES
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
/**
 * Get The country full name
 * @param  [string] $iso2Code
 * @return response
 */
if(!function_exists('getCountryByISO2')){
	function getCountryByISO2($iso2Code) {
		$fullname = '';
		switch ($iso2Code) {
			case "AF": $fullname = 'Afeganistão';										break;
			case "ZA": $fullname = 'África do Sul';										break;
			case "AX": $fullname = 'Åland, Ilhas';										break;
			case "AL": $fullname = 'Albânia';											break;
			case "DE": $fullname = 'Alemanha';											break;
			case "AD": $fullname = 'Andorra';											break;
			case "AO": $fullname = 'Angola';											break;
			case "AI": $fullname = 'Anguilla';											break;
			case "AQ": $fullname = 'Antártida';											break;
			case "AG": $fullname = 'Antígua e Barbuda';									break;
			case "SA": $fullname = 'Arábia Saudita';									break;
			case "DZ": $fullname = 'Argélia';											break;
			case "AR": $fullname = 'Argentina';											break;
			case "AM": $fullname = 'Armênia';											break;
			case "AW": $fullname = 'Aruba';												break;
			case "AU": $fullname = 'Austrália';											break;
			case "AT": $fullname = 'Áustria';											break;
			case "AZ": $fullname = 'Azerbaijão';										break;
			case "BS": $fullname = 'Bahamas';											break;
			case "BH": $fullname = 'Bahrain';											break;
			case "BD": $fullname = 'Bangladesh';										break;
			case "BB": $fullname = 'Barbados';											break;
			case "BE": $fullname = 'Bélgica';											break;
			case "BZ": $fullname = 'Belize';											break;
			case "BJ": $fullname = 'Benim';												break;
			case "BM": $fullname = 'Bermudas';											break;
			case "BY": $fullname = 'Bielorrússia';										break;
			case "BO": $fullname = 'Bolívia';											break;
			case "BQ": $fullname = 'Bonaire, Santo Eustáquio e Saba';					break;
			case "BA": $fullname = 'Bósnia e Herzegovina';								break;
			case "BW": $fullname = 'Botswana';											break;
			case "BV": $fullname = 'Bouvet, Ilha';										break;
			case "BR": $fullname = 'Brasil';											break;
			case "BN": $fullname = 'Brunei';											break;
			case "BG": $fullname = 'Bulgária';											break;
			case "BF": $fullname = 'Burkina Faso';										break;
			case "BI": $fullname = 'Burundi';											break;
			case "BT": $fullname = 'Butão';												break;
			case "CV": $fullname = 'Cabo Verde';										break;
			case "KH": $fullname = 'Cambodja';											break;
			case "CM": $fullname = 'Camarões';											break;
			case "CA": $fullname = 'Canadá';											break;
			case "KY": $fullname = 'Cayman, Ilhas';										break;
			case "KZ": $fullname = 'Cazaquistão';										break;
			case "CF": $fullname = 'Centro-Africana, República';						break;
			case "TD": $fullname = 'Chade';												break;
			case "CZ": $fullname = 'Checa, República';									break;
			case "CL": $fullname = 'Chile';												break;
			case "CN": $fullname = 'China';												break;
			case "CY": $fullname = 'Chipre';											break;
			case "CX": $fullname = 'Christmas, Ilha';									break;
			case "CC": $fullname = 'Cocos, Ilhas';										break;
			case "CO": $fullname = 'Colômbia';											break;
			case "KM": $fullname = 'Comores';											break;
			case "CG": $fullname = 'Congo, República do';								break;
			case "CD": $fullname = 'Congo, República Democrática do';					break;
			case "CK": $fullname = 'Cook, Ilhas';										break;
			case "KR": $fullname = 'Coreia do Sul';										break;
			case "KP": $fullname = 'Coreia, República Democrática da';					break;
			case "CI": $fullname = 'Costa do Marfim';									break;
			case "CR": $fullname = 'Costa Rica';										break;
			case "HR": $fullname = 'Croácia';											break;
			case "CU": $fullname = 'Cuba';												break;
			case "CW": $fullname = 'Curaçao';											break;
			case "DK": $fullname = 'Dinamarca';											break;
			case "DJ": $fullname = 'Djibouti';											break;
			case "DM": $fullname = 'Dominica';											break;
			case "DO": $fullname = 'Dominicana, República';								break;
			case "EG": $fullname = 'Egito';												break;
			case "SV": $fullname = 'El Salvador';										break;
			case "AE": $fullname = 'Emirados Árabes Unidos';							break;
			case "EC": $fullname = 'Equador';											break;
			case "ER": $fullname = 'Eritreia';											break;
			case "SK": $fullname = 'Eslováquia';										break;
			case "SI": $fullname = 'Eslovênia';											break;
			case "ES": $fullname = 'Espanha';											break;
			case "US": $fullname = 'Estados Unidos';									break;
			case "EE": $fullname = 'Estónia';											break;
			case "ET": $fullname = 'Etiópia';											break;
			case "FO": $fullname = 'Feroé, Ilhas';										break;
			case "FJ": $fullname = 'Fiji';												break;
			case "PH": $fullname = 'Filipinas';											break;
			case "FI": $fullname = 'Finlândia';											break;
			case "FR": $fullname = 'França';											break;
			case "GA": $fullname = 'Gabão';												break;
			case "GM": $fullname = 'Gâmbia';											break;
			case "GH": $fullname = 'Gana';												break;
			case "GE": $fullname = 'Geórgia';											break;
			case "GS": $fullname = 'Geórgia do Sul e Sandwich do Sul, Ilhas';			break;
			case "GI": $fullname = 'Gibraltar';											break;
			case "GR": $fullname = 'Grécia';											break;
			case "GD": $fullname = 'Grenada';											break;
			case "GL": $fullname = 'Groenlândia';										break;
			case "GP": $fullname = 'Guadalupe';											break;
			case "GU": $fullname = 'Guam';												break;
			case "GT": $fullname = 'Guatemala';											break;
			case "GG": $fullname = 'Guernsey';											break;
			case "GY": $fullname = 'Guiana';											break;
			case "GF": $fullname = 'Guiana Francesa';									break;
			case "GW": $fullname = 'Guiné-Bissau';										break;
			case "GN": $fullname = 'Guiné-Conacri';										break;
			case "GQ": $fullname = 'Guiné Equatorial';									break;
			case "HT": $fullname = 'Haiti';												break;
			case "HM": $fullname = 'Heard e Ilhas McDonald, Ilha';						break;
			case "HN": $fullname = 'Honduras';											break;
			case "HK": $fullname = 'Hong Kong';											break;
			case "HU": $fullname = 'Hungria';											break;
			case "YE": $fullname = 'Iémen';												break;
			case "IN": $fullname = 'Índia';												break;
			case "ID": $fullname = 'Indonésia';											break;
			case "IQ": $fullname = 'Iraque';											break;
			case "IR": $fullname = 'Irã';												break;
			case "IE": $fullname = 'Irlanda';											break;
			case "IS": $fullname = 'Islândia';											break;
			case "IL": $fullname = 'Israel';											break;
			case "IT": $fullname = 'Itália';											break;
			case "JM": $fullname = 'Jamaica';											break;
			case "JP": $fullname = 'Japão';												break;
			case "JE": $fullname = 'Jersey';											break;
			case "JO": $fullname = 'Jordânia';											break;
			case "KI": $fullname = 'Kiribati';											break;
			case "KW": $fullname = 'Kuwait';											break;
			case "LA": $fullname = 'Laos';												break;
			case "LS": $fullname = 'Lesoto';											break;
			case "LV": $fullname = 'Letônia';											break;
			case "LB": $fullname = 'Líbano';											break;
			case "LR": $fullname = 'Libéria';											break;
			case "LY": $fullname = 'Líbia';												break;
			case "LI": $fullname = 'Liechtenstein';										break;
			case "LT": $fullname = 'Lituânia';											break;
			case "LU": $fullname = 'Luxemburgo';										break;
			case "MO": $fullname = 'Macau';												break;
			case "MK": $fullname = 'Macedônia, República da';							break;
			case "MG": $fullname = 'Madagáscar';										break;
			case "MY": $fullname = 'Malásia';											break;
			case "MW": $fullname = 'Malawi';											break;
			case "MV": $fullname = 'Maldivas';											break;
			case "ML": $fullname = 'Mali';												break;
			case "MT": $fullname = 'Malta';												break;
			case "FK": $fullname = 'Malvinas, Ilhas';									break;
			case "IM": $fullname = 'Man, Ilha de';										break;
			case "MP": $fullname = 'Marianas Setentrionais';							break;
			case "MA": $fullname = 'Marrocos';											break;
			case "MH": $fullname = 'Marshall, Ilhas';									break;
			case "MQ": $fullname = 'Martinica';											break;
			case "MU": $fullname = 'Maurícia';											break;
			case "MR": $fullname = 'Mauritânia';										break;
			case "YT": $fullname = 'Mayotte';											break;
			case "UM": $fullname = 'Menores Distantes dos Estados Unidos, Ilhas';		break;
			case "MX": $fullname = 'México';											break;
			case "MM": $fullname = 'Myanmar';											break;
			case "FM": $fullname = 'Micronésia, Estados Federados da';					break;
			case "MZ": $fullname = 'Moçambique';										break;
			case "MD": $fullname = 'Moldávia';											break;
			case "MC": $fullname = 'Mônaco';											break;
			case "MN": $fullname = 'Mongólia';											break;
			case "ME": $fullname = 'Montenegro';										break;
			case "MS": $fullname = 'Montserrat';										break;
			case "NA": $fullname = 'Namíbia';											break;
			case "NR": $fullname = 'Nauru';												break;
			case "NP": $fullname = 'Nepal';												break;
			case "NI": $fullname = 'Nicarágua';											break;
			case "NE": $fullname = 'Níger';												break;
			case "NG": $fullname = 'Nigéria';											break;
			case "NU": $fullname = 'Niue';												break;
			case "NF": $fullname = 'Norfolk, Ilha';										break;
			case "NO": $fullname = 'Noruega';											break;
			case "NC": $fullname = 'Nova Caledônia';									break;
			case "NZ": $fullname = 'Nova Zelândia';										break;
			case "OM": $fullname = 'Oman';												break;
			case "NL": $fullname = 'Países Baixos';										break;
			case "PW": $fullname = 'Palau';												break;
			case "PS": $fullname = 'Palestina';											break;
			case "PA": $fullname = 'Panamá';											break;
			case "PG": $fullname = 'Papua-Nova Guiné';									break;
			case "PK": $fullname = 'Paquistão';											break;
			case "PY": $fullname = 'Paraguai';											break;
			case "PE": $fullname = 'Peru';												break;
			case "PN": $fullname = 'Pitcairn';											break;
			case "PF": $fullname = 'Polinésia Francesa';								break;
			case "PL": $fullname = 'Polônia';											break;
			case "PR": $fullname = 'Porto Rico';										break;
			case "PT": $fullname = 'Portugal';											break;
			case "PT-AC": $fullname = 'Açores';											break;
			case "PT-MA": $fullname = 'Madeira';										break;
			case "QA": $fullname = 'Qatar';												break;
			case "KE": $fullname = 'Quênia';											break;
			case "KG": $fullname = 'Quirguistão';										break;
			case "GB": $fullname = 'Reino Unido da Grã-Bretanha e Irlanda do Norte';	break;
			case "RE": $fullname = 'Reunião';											break;
			case "RO": $fullname = 'Romênia';											break;
			case "RW": $fullname = 'Ruanda';											break;
			case "RU": $fullname = 'Rússia';											break;
			case "EH": $fullname = 'Saara Ocidental';									break;
			case "AS": $fullname = 'Samoa Americana';									break;
			case "WS": $fullname = 'Samoa';												break;
			case "PM": $fullname = 'Saint Pierre et Miquelon';							break;
			case "SB": $fullname = 'Salomão, Ilhas';									break;
			case "SM": $fullname = 'San Marino';										break;
			case "SH": $fullname = 'Santa Helena';										break;
			case "LC": $fullname = 'Santa Lúcia';										break;
			case "BL": $fullname = 'São Bartolomeu';									break;
			case "KN": $fullname = 'São Cristóvão e Névis';								break;
			case "SX": $fullname = 'São Martinho (Países Baixos)';						break;
			case "MF": $fullname = 'São Martinho (França)';								break;
			case "ST": $fullname = 'São Tomé e Príncipe';								break;
			case "VC": $fullname = 'São Vicente e Granadinas';							break;
			case "SN": $fullname = 'Senegal';											break;
			case "SL": $fullname = 'Serra Leoa';										break;
			case "RS": $fullname = 'Sérvia';											break;
			case "SC": $fullname = 'Seychelles';										break;
			case "SG": $fullname = 'Singapura';											break;
			case "SY": $fullname = 'Síria';												break;
			case "SO": $fullname = 'Somália';											break;
			case "LK": $fullname = 'Sri Lanka';											break;
			case "SZ": $fullname = 'Suazilândia';										break;
			case "SD": $fullname = 'Sudão';												break;
			case "SS": $fullname = 'Sudão do Sul';										break;
			case "SE": $fullname = 'Suécia';											break;
			case "CH": $fullname = 'Suíça';												break;
			case "SR": $fullname = 'Suriname';											break;
			case "SJ": $fullname = 'Jan Mayen';											break;
			case "TH": $fullname = 'Tailândia';											break;
			case "TW": $fullname = 'Taiwan';											break;
			case "TJ": $fullname = 'Tajiquistão';										break;
			case "TZ": $fullname = 'Tanzânia';											break;
			case "TF": $fullname = 'Terras Austrais e Antárticas Francesas';			break;
			case "IO": $fullname = 'Território Britânico do Oceano Índico';				break;
			case "TL": $fullname = 'Timor-Leste';										break;
			case "TG": $fullname = 'Togo';												break;
			case "TK": $fullname = 'Toquelau';											break;
			case "TO": $fullname = 'Tonga';												break;
			case "TT": $fullname = 'Trindade e Tobago';									break;
			case "TN": $fullname = 'Tunísia';											break;
			case "TC": $fullname = 'Turks e Caicos';									break;
			case "TM": $fullname = 'Turquemenistão';									break;
			case "TR": $fullname = 'Turquia';											break;
			case "TV": $fullname = 'Tuvalu';											break;
			case "UA": $fullname = 'Ucrânia';											break;
			case "UG": $fullname = 'Uganda';											break;
			case "UY": $fullname = 'Uruguai';											break;
			case "UZ": $fullname = 'Usbequistão';										break;
			case "VU": $fullname = 'Vanuatu';											break;
			case "VA": $fullname = 'Vaticano';											break;
			case "VE": $fullname = 'Venezuela';											break;
			case "VN": $fullname = 'Vietnam';											break;
			case "VI": $fullname = 'Virgens Americanas, Ilhas';							break;
			case "VG": $fullname = 'Virgens Britânicas, Ilhas';							break;
			case "WF": $fullname = 'Wallis e Futuna';									break;
			case "ZM": $fullname = 'Zâmbia';											break;
			case "ZW": $fullname = 'Zimbabwe';											break;

			default:	break;
		}
		return $fullname;
	}
}

/**
 * Get The country ISO by name
 * @param  [string] $iso2Code
 * @return response
 */
if(!function_exists('getISO2ByCountry')){
	function getISO2ByCountry($code2iso) {
		$iso_code = '';
		switch ($code2iso) {
			case 'Afeganistão'										: $iso_code = "AF";	break;
			case 'África do Sul'									: $iso_code = "ZA";	break;
			case 'Åland, Ilhas'										: $iso_code = "AX";	break;
			case 'Albânia'											: $iso_code = "AL";	break;
			case 'Alemanha'											: $iso_code = "DE";	break;
			case 'Andorra'											: $iso_code = "AD";	break;
			case 'Angola'											: $iso_code = "AO";	break;
			case 'Anguilla'											: $iso_code = "AI";	break;
			case 'Antártida'										: $iso_code = "AQ";	break;
			case 'Antígua e Barbuda'								: $iso_code = "AG";	break;
			case 'Arábia Saudita'									: $iso_code = "SA";	break;
			case 'Argélia'											: $iso_code = "DZ";	break;
			case 'Argentina'										: $iso_code = "AR";	break;
			case 'Armênia'											: $iso_code = "AM";	break;
			case 'Aruba'											: $iso_code = "AW";	break;
			case 'Austrália'										: $iso_code = "AU";	break;
			case 'Áustria'											: $iso_code = "AT";	break;
			case 'Azerbaijão'										: $iso_code = "AZ";	break;
			case 'Bahamas'											: $iso_code = "BS";	break;
			case 'Bahrain'											: $iso_code = "BH";	break;
			case 'Bangladesh'										: $iso_code = "BD";	break;
			case 'Barbados'											: $iso_code = "BB";	break;
			case 'Bélgica'											: $iso_code = "BE";	break;
			case 'Belize'											: $iso_code = "BZ";	break;
			case 'Benim'											: $iso_code = "BJ";	break;
			case 'Bermudas'											: $iso_code = "BM";	break;
			case 'Bielorrússia'										: $iso_code = "BY";	break;
			case 'Bolívia'											: $iso_code = "BO";	break;
			case 'Bonaire, Santo Eustáquio e Saba'					: $iso_code = "BQ";	break;
			case 'Bósnia e Herzegovina'								: $iso_code = "BA";	break;
			case 'Botswana'											: $iso_code = "BW";	break;
			case 'Bouvet, Ilha'										: $iso_code = "BV";	break;
			case 'Brasil'											: $iso_code = "BR";	break;
			case 'Brunei'											: $iso_code = "BN";	break;
			case 'Bulgária'											: $iso_code = "BG";	break;
			case 'Burkina Faso'										: $iso_code = "BF";	break;
			case 'Burundi'											: $iso_code = "BI";	break;
			case 'Butão'											: $iso_code = "BT";	break;
			case 'Cabo Verde'										: $iso_code = "CV";	break;
			case 'Cambodja'											: $iso_code = "KH";	break;
			case 'Camarões'											: $iso_code = "CM";	break;
			case 'Canadá'											: $iso_code = "CA";	break;
			case 'Cayman, Ilhas'									: $iso_code = "KY";	break;
			case 'Cazaquistão'										: $iso_code = "KZ";	break;
			case 'Centro-Africana, República'						: $iso_code = "CF";	break;
			case 'Chade'											: $iso_code = "TD";	break;
			case 'Checa, República'									: $iso_code = "CZ";	break;
			case 'Chile'											: $iso_code = "CL";	break;
			case 'China'											: $iso_code = "CN";	break;
			case 'Chipre'											: $iso_code = "CY";	break;
			case 'Christmas, Ilha'									: $iso_code = "CX";	break;
			case 'Cocos, Ilhas'										: $iso_code = "CC";	break;
			case 'Colômbia'											: $iso_code = "CO";	break;
			case 'Comores'											: $iso_code = "KM";	break;
			case 'Congo, República do'								: $iso_code = "CG";	break;
			case 'Congo, República Democrática do'					: $iso_code = "CD";	break;
			case 'Cook, Ilhas'										: $iso_code = "CK";	break;
			case 'Coreia do Sul'									: $iso_code = "KR";	break;
			case 'Coreia, República Democrática da'					: $iso_code = "KP";	break;
			case 'Costa do Marfim'									: $iso_code = "CI";	break;
			case 'Costa Rica'										: $iso_code = "CR";	break;
			case 'Croácia'											: $iso_code = "HR";	break;
			case 'Cuba'												: $iso_code = "CU";	break;
			case 'Curaçao'											: $iso_code = "CW";	break;
			case 'Dinamarca'										: $iso_code = "DK";	break;
			case 'Djibouti'											: $iso_code = "DJ";	break;
			case 'Dominica'											: $iso_code = "DM";	break;
			case 'Dominicana, República'							: $iso_code = "DO";	break;
			case 'Egito'											: $iso_code = "EG";	break;
			case 'El Salvador'										: $iso_code = "SV";	break;
			case 'Emirados Árabes Unidos'							: $iso_code = "AE";	break;
			case 'Equador'											: $iso_code = "EC";	break;
			case 'Eritreia'											: $iso_code = "ER";	break;
			case 'Eslováquia'										: $iso_code = "SK";	break;
			case 'Eslovênia'										: $iso_code = "SI";	break;
			case 'Espanha'											: $iso_code = "ES";	break;
			case 'Estados Unidos'									: $iso_code = "US";	break;
			case 'Estónia'											: $iso_code = "EE";	break;
			case 'Etiópia'											: $iso_code = "ET";	break;
			case 'Feroé, Ilhas'										: $iso_code = "FO";	break;
			case 'Fiji'												: $iso_code = "FJ";	break;
			case 'Filipinas'										: $iso_code = "PH";	break;
			case 'Finlândia'										: $iso_code = "FI";	break;
			case 'França'											: $iso_code = "FR";	break;
			case 'Gabão'											: $iso_code = "GA";	break;
			case 'Gâmbia'											: $iso_code = "GM";	break;
			case 'Gana'												: $iso_code = "GH";	break;
			case 'Geórgia'											: $iso_code = "GE";	break;
			case 'Geórgia do Sul e Sandwich do Sul, Ilhas'			: $iso_code = "GS";	break;
			case 'Gibraltar'										: $iso_code = "GI";	break;
			case 'Grécia'											: $iso_code = "GR";	break;
			case 'Grenada'											: $iso_code = "GD";	break;
			case 'Groenlândia'										: $iso_code = "GL";	break;
			case 'Guadalupe'										: $iso_code = "GP";	break;
			case 'Guam'												: $iso_code = "GU";	break;
			case 'Guatemala'										: $iso_code = "GT";	break;
			case 'Guernsey'											: $iso_code = "GG";	break;
			case 'Guiana'											: $iso_code = "GY";	break;
			case 'Guiana Francesa'									: $iso_code = "GF";	break;
			case 'Guiné-Bissau'										: $iso_code = "GW";	break;
			case 'Guiné-Conacri'									: $iso_code = "GN";	break;
			case 'Guiné Equatorial'									: $iso_code = "GQ";	break;
			case 'Haiti'											: $iso_code = "HT";	break;
			case 'Heard e Ilhas McDonald, Ilha'						: $iso_code = "HM";	break;
			case 'Honduras'											: $iso_code = "HN";	break;
			case 'Hong Kong'										: $iso_code = "HK";	break;
			case 'Hungria'											: $iso_code = "HU";	break;
			case 'Iémen'											: $iso_code = "YE";	break;
			case 'Índia'											: $iso_code = "IN";	break;
			case 'Indonésia'										: $iso_code = "ID";	break;
			case 'Iraque'											: $iso_code = "IQ";	break;
			case 'Irã'												: $iso_code = "IR";	break;
			case 'Irlanda'											: $iso_code = "IE";	break;
			case 'Islândia'											: $iso_code = "IS";	break;
			case 'Israel'											: $iso_code = "IL";	break;
			case 'Itália'											: $iso_code = "IT";	break;
			case 'Jamaica'											: $iso_code = "JM";	break;
			case 'Japão'											: $iso_code = "JP";	break;
			case 'Jersey'											: $iso_code = "JE";	break;
			case 'Jordânia'											: $iso_code = "JO";	break;
			case 'Kiribati'											: $iso_code = "KI";	break;
			case 'Kuwait'											: $iso_code = "KW";	break;
			case 'Laos'												: $iso_code = "LA";	break;
			case 'Lesoto'											: $iso_code = "LS";	break;
			case 'Letônia'											: $iso_code = "LV";	break;
			case 'Líbano'											: $iso_code = "LB";	break;
			case 'Libéria'											: $iso_code = "LR";	break;
			case 'Líbia'											: $iso_code = "LY";	break;
			case 'Liechtenstein'									: $iso_code = "LI";	break;
			case 'Lituânia'											: $iso_code = "LT";	break;
			case 'Luxemburgo'										: $iso_code = "LU";	break;
			case 'Macau'											: $iso_code = "MO";	break;
			case 'Macedônia, República da'							: $iso_code = "MK";	break;
			case 'Madagáscar'										: $iso_code = "MG";	break;
			case 'Malásia'											: $iso_code = "MY";	break;
			case 'Malawi'											: $iso_code = "MW";	break;
			case 'Maldivas'											: $iso_code = "MV";	break;
			case 'Mali'												: $iso_code = "ML";	break;
			case 'Malta'											: $iso_code = "MT";	break;
			case 'Malvinas, Ilhas'									: $iso_code = "FK";	break;
			case 'Man, Ilha de'										: $iso_code = "IM";	break;
			case 'Marianas Setentrionais'							: $iso_code = "MP";	break;
			case 'Marrocos'											: $iso_code = "MA";	break;
			case 'Marshall, Ilhas'									: $iso_code = "MH";	break;
			case 'Martinica'										: $iso_code = "MQ";	break;
			case 'Maurícia'											: $iso_code = "MU";	break;
			case 'Mauritânia'										: $iso_code = "MR";	break;
			case 'Mayotte'											: $iso_code = "YT";	break;
			case 'Menores Distantes dos Estados Unidos, Ilhas'		: $iso_code = "UM";	break;
			case 'México'											: $iso_code = "MX";	break;
			case 'Myanmar'											: $iso_code = "MM";	break;
			case 'Micronésia, Estados Federados da'					: $iso_code = "FM";	break;
			case 'Moçambique'										: $iso_code = "MZ";	break;
			case 'Moldávia'											: $iso_code = "MD";	break;
			case 'Mônaco'											: $iso_code = "MC";	break;
			case 'Mongólia'											: $iso_code = "MN";	break;
			case 'Montenegro'										: $iso_code = "ME";	break;
			case 'Montserrat'										: $iso_code = "MS";	break;
			case 'Namíbia'											: $iso_code = "NA";	break;
			case 'Nauru'											: $iso_code = "NR";	break;
			case 'Nepal'											: $iso_code = "NP";	break;
			case 'Nicarágua'										: $iso_code = "NI";	break;
			case 'Níger'											: $iso_code = "NE";	break;
			case 'Nigéria'											: $iso_code = "NG";	break;
			case 'Niue'												: $iso_code = "NU";	break;
			case 'Norfolk, Ilha'									: $iso_code = "NF";	break;
			case 'Noruega'											: $iso_code = "NO";	break;
			case 'Nova Caledônia'									: $iso_code = "NC";	break;
			case 'Nova Zelândia'									: $iso_code = "NZ";	break;
			case 'Oman'												: $iso_code = "OM";	break;
			case 'Países Baixos'									: $iso_code = "NL";	break;
			case 'Palau'											: $iso_code = "PW";	break;
			case 'Palestina'										: $iso_code = "PS";	break;
			case 'Panamá'											: $iso_code = "PA";	break;
			case 'Papua-Nova Guiné'									: $iso_code = "PG";	break;
			case 'Paquistão'										: $iso_code = "PK";	break;
			case 'Paraguai'											: $iso_code = "PY";	break;
			case 'Peru'												: $iso_code = "PE";	break;
			case 'Pitcairn'											: $iso_code = "PN";	break;
			case 'Polinésia Francesa'								: $iso_code = "PF";	break;
			case 'Polônia'											: $iso_code = "PL";	break;
			case 'Porto Rico'										: $iso_code = "PR";	break;
			case 'Portugal'											: $iso_code = "PT";	break;
			case 'Qatar'											: $iso_code = "QA";	break;
			case 'Quênia'											: $iso_code = "KE";	break;
			case 'Quirguistão'										: $iso_code = "KG";	break;
			case 'Reino Unido da Grã-Bretanha e Irlanda do Norte'	: $iso_code = "GB";	break;
			case 'Reunião'											: $iso_code = "RE";	break;
			case 'Romênia'											: $iso_code = "RO";	break;
			case 'Ruanda'											: $iso_code = "RW";	break;
			case 'Rússia'											: $iso_code = "RU";	break;
			case 'Saara Ocidental'									: $iso_code = "EH";	break;
			case 'Samoa Americana'									: $iso_code = "AS";	break;
			case 'Samoa'											: $iso_code = "WS";	break;
			case 'Saint Pierre et Miquelon'							: $iso_code = "PM";	break;
			case 'Salomão, Ilhas'									: $iso_code = "SB";	break;
			case 'San Marino'										: $iso_code = "SM";	break;
			case 'Santa Helena'										: $iso_code = "SH";	break;
			case 'Santa Lúcia'										: $iso_code = "LC";	break;
			case 'São Bartolomeu'									: $iso_code = "BL";	break;
			case 'São Cristóvão e Névis'							: $iso_code = "KN";	break;
			case 'São Martinho (Países Baixos)'						: $iso_code = "SX";	break;
			case 'São Martinho (França)'							: $iso_code = "MF";	break;
			case 'São Tomé e Príncipe'								: $iso_code = "ST";	break;
			case 'São Vicente e Granadinas'							: $iso_code = "VC";	break;
			case 'Senegal'											: $iso_code = "SN";	break;
			case 'Serra Leoa'										: $iso_code = "SL";	break;
			case 'Sérvia'											: $iso_code = "RS";	break;
			case 'Seychelles'										: $iso_code = "SC";	break;
			case 'Singapura'										: $iso_code = "SG";	break;
			case 'Síria'											: $iso_code = "SY";	break;
			case 'Somália'											: $iso_code = "SO";	break;
			case 'Sri Lanka'										: $iso_code = "LK";	break;
			case 'Suazilândia'										: $iso_code = "SZ";	break;
			case 'Sudão'											: $iso_code = "SD";	break;
			case 'Sudão do Sul'										: $iso_code = "SS";	break;
			case 'Suécia'											: $iso_code = "SE";	break;
			case 'Suíça'											: $iso_code = "CH";	break;
			case 'Suriname'											: $iso_code = "SR";	break;
			case 'Jan Mayen'										: $iso_code = "SJ";	break;
			case 'Tailândia'										: $iso_code = "TH";	break;
			case 'Taiwan'											: $iso_code = "TW";	break;
			case 'Tajiquistão'										: $iso_code = "TJ";	break;
			case 'Tanzânia'											: $iso_code = "TZ";	break;
			case 'Terras Austrais e Antárticas Francesas'			: $iso_code = "TF";	break;
			case 'Território Britânico do Oceano Índico'			: $iso_code = "IO";	break;
			case 'Timor-Leste'										: $iso_code = "TL";	break;
			case 'Togo'												: $iso_code = "TG";	break;
			case 'Toquelau'											: $iso_code = "TK";	break;
			case 'Tonga'											: $iso_code = "TO";	break;
			case 'Trindade e Tobago'								: $iso_code = "TT";	break;
			case 'Tunísia'											: $iso_code = "TN";	break;
			case 'Turks e Caicos'									: $iso_code = "TC";	break;
			case 'Turquemenistão'									: $iso_code = "TM";	break;
			case 'Turquia'											: $iso_code = "TR";	break;
			case 'Tuvalu'											: $iso_code = "TV";	break;
			case 'Ucrânia'											: $iso_code = "UA";	break;
			case 'Uganda'											: $iso_code = "UG";	break;
			case 'Uruguai'											: $iso_code = "UY";	break;
			case 'Usbequistão'										: $iso_code = "UZ";	break;
			case 'Vanuatu'											: $iso_code = "VU";	break;
			case 'Vaticano'											: $iso_code = "VA";	break;
			case 'Venezuela'										: $iso_code = "VE";	break;
			case 'Vietnam'											: $iso_code = "VN";	break;
			case 'Virgens Americanas, Ilhas'						: $iso_code = "VI";	break;
			case 'Virgens Britânicas, Ilhas'						: $iso_code = "VG";	break;
			case 'Wallis e Futuna'									: $iso_code = "WF";	break;
			case 'Zâmbia'											: $iso_code = "ZM";	break;
			case 'Zimbabwe'											: $iso_code = "ZW";	break;
			default: break;
		}
		return $iso_code;
	}
}

/**
 * Get The country ISO by name
 * @param  [string] $iso2Code
 * @return response
 */
if(!function_exists('getCountryByISO2EN')){
	function getCountryByISO2EN($code2iso) {
		$iso_code = '';
		switch ($code2iso) {
			case "AF": $iso_code = 'Afghanistan'; break;
			case "ZA": $iso_code = 'South Africa'; break;
			case "AX": $iso_code = 'Åland, Islands'; break;
			case "AL": $iso_code = 'Albania'; break;
			case "DE": $iso_code = 'Germany'; break;
			case "AD": $iso_code = 'Andorra'; break;
			case "AO": $iso_code = 'Angola'; break;
			case "AI": $iso_code = 'Anguilla'; break;
			case "AQ": $iso_code = 'Antarctica'; break;
			case "AG": $iso_code = 'Antigua and Barbuda'; break;
			case "SA": $iso_code = 'Saudi Arabia'; break;
			case "DZ": $iso_code = 'Algeria'; break;
			case "AR": $iso_code = 'Argentina'; break;
			case "AM": $iso_code = 'Armenia'; break;
			case "AW": $iso_code = 'Aruba'; break;
			case "AU": $iso_code = 'Australia'; break;
			case "AT": $iso_code = 'Austria'; break;
			case "AZ": $iso_code = 'Azerbaijan'; break;
			case "BS": $iso_code = 'Bahamas'; break;
			case "BH": $iso_code = 'Bahrain'; break;
			case "BD": $iso_code = 'Bangladesh'; break;
			case "BB": $iso_code = 'Barbados'; break;
			case "BE": $iso_code = 'Belgium'; break;
			case "BZ": $iso_code = 'Belize'; break;
			case "BJ": $iso_code = 'Benin'; break;
			case "BM": $iso_code = 'Bermuda'; break;
			case "BY": $iso_code = 'Belarus'; break;
			case "BO": $iso_code = 'Bolivia'; break;
			case "BQ": $iso_code = 'Bonaire, Saint Eustatius and Saba'; break;
			case "BA": $iso_code = 'Bosnia and Herzegovina'; break;
			case "BW": $iso_code = 'Botswana'; break;
			case "BV": $iso_code = 'Bouvet Island'; break;
			case "BR": $iso_code = 'Brazil'; break;
			case "BN": $iso_code = 'Brunei'; break;
			case "BG": $iso_code = 'Bulgaria'; break;
			case "BF": $iso_code = 'Burkina Faso'; break;
			case "BI": $iso_code = 'Burundi'; break;
			case "BT": $iso_code = 'Bhutan'; break;
			case "CV": $iso_code = 'Cape Green'; break;
			case "KH": $iso_code = 'Cambodia'; break;
			case "CM": $iso_code = 'Cameroon'; break;
			case "CA": $iso_code = 'Canada'; break;
			case "KY": $iso_code = 'Cayman Islands'; break;
			case "KZ": $iso_code = 'Kazakhstan'; break;
			case "CF": $iso_code = 'Central African Republic'; break;
			case "TD": $iso_code = 'Chad'; break;
			case "CZ": $iso_code = 'Czech, Republic'; break;
			case "CL": $iso_code = 'Chile'; break;
			case "CN": $iso_code = 'China'; break;
			case "CY": $iso_code = 'Cyprus'; break;
			case "CX": $iso_code = 'Christmas Island'; break;
			case "CC": $iso_code = 'Cocos Islands'; break;
			case "CO": $iso_code = 'Colombia'; break;
			case "KM": $iso_code = 'Comoros'; break;
			case "CG": $iso_code = 'Congo, Republic of'; break;
			case "CD": $iso_code = 'Congo, Democratic Republic of the'; break;
			case "CK": $iso_code = 'Cook Islands'; break;
			case "KR": $iso_code = 'South Korea'; break;
			case "KP": $iso_code = 'Korea, Democratic Republic of'; break;
			case "CI": $iso_code = 'Costa do Marfim'; break;
			case "CR": $iso_code = 'Costa Rica'; break;
			case "HR": $iso_code = 'Croatia'; break;
			case "CU": $iso_code = 'Cuba'; break;
			case "CW": $iso_code = 'Curacao'; break;
			case "DK": $iso_code = 'Denmark'; break;
			case "DJ": $iso_code = 'Djibouti'; break;
			case "DM": $iso_code = 'Dominica'; break;
			case "DO": $iso_code = 'Dominican Republic'; break;
			case "EG": $iso_code = 'Egypt'; break;
			case "SV": $iso_code = 'El Salvador'; break;
			case "AE": $iso_code = 'United Arab Emirates'; break;
			case "EC": $iso_code = 'Ecuador'; break;
			case "ER": $iso_code = 'Eritrea'; break;
			case "SK": $iso_code = 'Slovakia'; break;
			case "SI": $iso_code = 'Slovenia'; break;
			case "ES": $iso_code = 'Spain'; break;
			case "US": $iso_code = 'U.S.A'; break;
			case "EE": $iso_code = 'Estonia'; break;
			case "ET": $iso_code = 'Ethiopia'; break;
			case "FO": $iso_code = 'Faroe Islands'; break;
			case "FJ": $iso_code = 'Fiji'; break;
			case "PH": $iso_code = 'Philippines'; break;
			case "FI": $iso_code = 'Finland'; break;
			case "FR": $iso_code = 'France'; break;
			case "GA": $iso_code = 'Gabon'; break;
			case "GM": $iso_code = 'Gambia'; break;
			case "GH": $iso_code = 'Ghana'; break;
			case "GE": $iso_code = 'Georgia'; break;
			case "GS": $iso_code = 'South Georgia and the South Sandwich Islands'; break;
			case "GI": $iso_code = 'Gibraltar'; break;
			case "GR": $iso_code = 'Greece'; break;
			case "GD": $iso_code = 'Grenada'; break;
			case "GL": $iso_code = 'Greenland'; break;
			case "GP": $iso_code = 'Guadeloupe'; break;
			case "GU": $iso_code = 'Guam'; break;
			case "GT": $iso_code = 'Guatemala'; break;
			case "GG": $iso_code = 'Guernsey'; break;
			case "GY": $iso_code = 'Guyana'; break;
			case "GF": $iso_code = 'French Guiana'; break;
			case "GW": $iso_code = 'Guinea Bissau'; break;
			case "GN": $iso_code = 'Guinea-Conakry'; break;
			case "GQ": $iso_code = 'Equatorial Guinea'; break;
			case "HT": $iso_code = 'Haiti'; break;
			case "HM": $iso_code = 'Heard and McDonald Islands, Island'; break;
			case "HN": $iso_code = 'Honduras'; break;
			case "HK": $iso_code = 'Hong Kong'; break;
			case "HU": $iso_code = 'Hungary'; break;
			case "YE": $iso_code = 'Yemen'; break;
			case "IN": $iso_code = 'India'; break;
			case "ID": $iso_code = 'Indonesia'; break;
			case "IQ": $iso_code = 'Iraq'; break;
			case "IR": $iso_code = 'Will'; break;
			case "IE": $iso_code = 'Ireland'; break;
			case "IS": $iso_code = 'Iceland'; break;
			case "IL": $iso_code = 'Israel'; break;
			case "IT": $iso_code = 'Italy'; break;
			case "JM": $iso_code = 'Jamaica'; break;
			case "JP": $iso_code = 'Japan'; break;
			case "JE": $iso_code = 'Jersey'; break;
			case "JO": $iso_code = 'Jordan'; break;
			case "KI": $iso_code = 'Kiribati'; break;
			case "KW": $iso_code = 'Kuwait'; break;
			case "LA": $iso_code = 'Laos'; break;
			case "LS": $iso_code = 'Lesotho'; break;
			case "LV": $iso_code = 'Latvia'; break;
			case "LB": $iso_code = 'Lebanon'; break;
			case "LR": $iso_code = 'Liberia'; break;
			case "LY": $iso_code = 'Libya'; break;
			case "LI": $iso_code = 'Liechtenstein'; break;
			case "LT": $iso_code = 'Lithuania'; break;
			case "LU": $iso_code = 'Luxembourg'; break;
			case "MO": $iso_code = 'Macao'; break;
			case "MK": $iso_code = 'Macedonia, Republic of'; break;
			case "MG": $iso_code = 'Madagascar'; break;
			case "MY": $iso_code = 'Malaysia'; break;
			case "MW": $iso_code = 'Malawi'; break;
			case "MV": $iso_code = 'Maldives'; break;
			case "ML": $iso_code = 'Mali'; break;
			case "MT": $iso_code = 'Malta'; break;
			case "FK": $iso_code = 'Falkland Islands'; break;
			case "IM": $iso_code = 'Man, Isle of'; break;
			case "MP": $iso_code = 'Northern Mariana Islands'; break;
			case "MA": $iso_code = 'Morocco'; break;
			case "MH": $iso_code = 'Marshall Islands'; break;
			case "MQ": $iso_code = 'Martinique'; break;
			case "MU": $iso_code = 'Mauritius'; break;
			case "MR": $iso_code = 'Mauritania'; break;
			case "YT": $iso_code = 'Mayotte'; break;
			case "UM": $iso_code = 'United States Minor Outlying Islands'; break;
			case "MX": $iso_code = 'Mexico'; break;
			case "MM": $iso_code = 'Myanmar'; break;
			case "FM": $iso_code = 'Micronesia, Federated States of'; break;
			case "MZ": $iso_code = 'Mozambique'; break;
			case "MD": $iso_code = 'Moldavia'; break;
			case "MC": $iso_code = 'Monaco'; break;
			case "MN": $iso_code = 'Mongolia'; break;
			case "ME": $iso_code = 'Montenegro'; break;
			case "MS": $iso_code = 'Montserrat'; break;
			case "NA": $iso_code = 'Namibia'; break;
			case "NR": $iso_code = 'Nauru'; break;
			case "NP": $iso_code = 'Nepal'; break;
			case "NI": $iso_code = 'Nicaragua'; break;
			case "NE": $iso_code = 'Niger'; break;
			case "NG": $iso_code = 'Nigeria'; break;
			case "NU": $iso_code = 'Niue'; break;
			case "NF": $iso_code = 'Norfolk Island'; break;
			case "NO": $iso_code = 'Norway'; break;
			case "NC": $iso_code = 'New Caledonia'; break;
			case "NZ": $iso_code = 'New Zealand'; break;
			case "OM": $iso_code = 'Oman'; break;
			case "NL": $iso_code = 'Netherlands'; break;
			case "PW": $iso_code = 'Palau'; break;
			case "PS": $iso_code = 'Palestine'; break;
			case "PA": $iso_code = 'Panama'; break;
			case "PG": $iso_code = 'Papua New Guinea'; break;
			case "PK": $iso_code = 'Pakistan'; break;
			case "PY": $iso_code = 'Paraguay'; break;
			case "PE": $iso_code = 'Peru'; break;
			case "PN": $iso_code = 'Pitcairn'; break;
			case "PF": $iso_code = 'French Polynesian'; break;
			case "PL": $iso_code = 'Poland'; break;
			case "PR": $iso_code = 'Puerto Rico'; break;
			case "PT": $iso_code = 'Portugal'; break;
			case "QA": $iso_code = 'Qatar'; break;
			case "KE": $iso_code = 'Kenya'; break;
			case "KG": $iso_code = 'Kyrgyzstan'; break;
			case "GB": $iso_code = 'United Kingdom of Great Britain and Northern Ireland'; break;
			case "RE": $iso_code = 'Meeting'; break;
			case "RO": $iso_code = 'Romania'; break;
			case "RW": $iso_code = 'Rwanda'; break;
			case "RU": $iso_code = 'Russia'; break;
			case "EH": $iso_code = 'Western Sahara'; break;
			case "AS": $iso_code = 'American Samoa'; break;
			case "WS": $iso_code = 'Samoa'; break;
			case "PM": $iso_code = 'Saint Pierre and Miquelon'; break;
			case "SB": $iso_code = 'Solomon Islands'; break;
			case "SM": $iso_code = 'San Marino'; break;
			case "SH": $iso_code = 'Saint Helen'; break;
			case "LC": $iso_code = 'Saint Lucia'; break;
			case "BL": $iso_code = 'Saint Barthélemy'; break;
			case "KN": $iso_code = 'Saint Kitts and Nevis'; break;
			case "SX": $iso_code = 'Saint Martin (Netherlands)'; break;
			case "MF": $iso_code = 'Saint Martin (France)'; break;
			case "ST": $iso_code = 'Sao Tome and Principe'; break;
			case "VC": $iso_code = 'Saint Vincent and the Grenadines'; break;
			case "SN": $iso_code = 'Senegal'; break;
			case "SL": $iso_code = 'Sierra Leone'; break;
			case "RS": $iso_code = 'Serbia'; break;
			case "SC": $iso_code = 'Seychelles'; break;
			case "SG": $iso_code = 'Singapore'; break;
			case "SY": $iso_code = 'Syria'; break;
			case "SO": $iso_code = 'Somalia'; break;
			case "LK": $iso_code = 'Sri Lanka'; break;
			case "SZ": $iso_code = 'Swaziland'; break;
			case "SD": $iso_code = 'Sudan'; break;
			case "SS": $iso_code = 'Southern Sudan'; break;
			case "SE": $iso_code = 'Sweden'; break;
			case "CH": $iso_code = 'Switzerland'; break;
			case "SR": $iso_code = 'Suriname'; break;
			case "SJ": $iso_code = 'Jan Mayen'; break;
			case "TH": $iso_code = 'Thailand'; break;
			case "TW": $iso_code = 'Taiwan'; break;
			case "TJ": $iso_code = 'Tajikistan'; break;
			case "TZ": $iso_code = 'Tanzania'; break;
			case "TF": $iso_code = 'French Southern and Antarctic Lands'; break;
			case "IO": $iso_code = 'British Indian Ocean Territory'; break;
			case "TL": $iso_code = 'Timor-Leste'; break;
			case "TG": $iso_code = 'Togo'; break;
			case "TK": $iso_code = 'Tokelau'; break;
			case "TO": $iso_code = 'Tonga'; break;
			case "TT": $iso_code = 'Trinidad and Tobago'; break;
			case "TN": $iso_code = 'Tunisia'; break;
			case "TC": $iso_code = 'Turks and Caicos Islands'; break;
			case "TM": $iso_code = 'Turkmenistan'; break;
			case "TR": $iso_code = 'Turkey'; break;
			case "TV": $iso_code = 'Tuvalu'; break;
			case "UA": $iso_code = 'Ukraine'; break;
			case "UG": $iso_code = 'Uganda'; break;
			case "UY": $iso_code = 'Uruguay'; break;
			case "UZ": $iso_code = 'Uzbekistan'; break;
			case "VU": $iso_code = 'Vanuatu'; break;
			case "VA": $iso_code = 'Vatican'; break;
			case "VE": $iso_code = 'Venezuela'; break;
			case "VN": $iso_code = 'Vietnam'; break;
			case "VI": $iso_code = 'American Virgin Islands'; break;
			case "VG": $iso_code = 'British Virgin Islands'; break;
			case "WF": $iso_code = 'Wallis and Futuna'; break;
			case "ZM": $iso_code = 'Zambia'; break;
			case "ZW": $iso_code = 'Zimbabwe'; break;

			default: break;
		}
		return $iso_code;
	}
}

/**
 * Get The country ISO by name
 * @param  [string] $iso2Code
 * @return response
 */
if(!function_exists('getCountryByISO2DE')){
	function getCountryByISO2DE($code2iso) {
		$iso_code = '';
		switch ($code2iso) {
			case "AF": $iso_code = 'Afghanistan'; break;
			case "ZA": $iso_code = 'Südafrika'; break;
			case "AX": $iso_code = 'Åland, Inseln'; break;
			case "AL": $iso_code = 'Albanien'; break;
			case "DE": $iso_code = 'Deutschland'; break;
			case "AD": $iso_code = 'Andorra'; break;
			case "AO": $iso_code = 'Angola'; break;
			case "AI": $iso_code = 'Anguilla'; break;
			case "AQ": $iso_code = 'Antarktis'; break;
			case "AG": $iso_code = 'Antigua und Barbuda'; break;
			case "SA": $iso_code = 'Saudi Arabien'; break;
			case "DZ": $iso_code = 'Algerien'; break;
			case "AR": $iso_code = 'Argentinien'; break;
			case "AM": $iso_code = 'Armenien'; break;
			case "AW": $iso_code = 'Aruba'; break;
			case "AU": $iso_code = 'Australien'; break;
			case "AT": $iso_code = 'Österreich'; break;
			case "AZ": $iso_code = 'Aserbaidschan'; break;
			case "BS": $iso_code = 'Bahamas'; break;
			case "BH": $iso_code = 'Bahrain'; break;
			case "BD": $iso_code = 'Bangladesch'; break;
			case "BB": $iso_code = 'Barbados'; break;
			case "BE": $iso_code = 'Belgien'; break;
			case "BZ": $iso_code = 'Belize'; break;
			case "BJ": $iso_code = 'Benin'; break;
			case "BM": $iso_code = 'Bermuda'; break;
			case "BY": $iso_code = 'Weißrussland'; break;
			case "BO": $iso_code = 'Bolivien'; break;
			case "BQ": $iso_code = 'Bonaire, Saint Eustatius und Saba'; break;
			case "BA": $iso_code = 'Bosnien und Herzegowina'; break;
			case "BW": $iso_code = 'Botswana'; break;
			case "BV": $iso_code = 'Bouvet-Insel'; break;
			case "BR": $iso_code = 'Brasilien'; break;
			case "BN": $iso_code = 'Brunei'; break;
			case "BG": $iso_code = 'Bulgarien'; break;
			case "BF": $iso_code = 'Burkina Faso'; break;
			case "BI": $iso_code = 'Burundi'; break;
			case "BT": $iso_code = 'Bhutan'; break;
			case "CV": $iso_code = 'Kap Grün'; break;
			case "KH": $iso_code = 'Kambodscha'; break;
			case "CM": $iso_code = 'Kamerun'; break;
			case "CA": $iso_code = 'Kanada'; break;
			case "KY": $iso_code = 'Cayman Inseln'; break;
			case "KZ": $iso_code = 'Kasachstan'; break;
			case "CF": $iso_code = 'Zentralafrikanische Republik'; break;
			case "TD": $iso_code = 'Tschad'; break;
			case "CZ": $iso_code = 'Tschechien'; break;
			case "CL": $iso_code = 'Chile'; break;
			case "CN": $iso_code = 'China'; break;
			case "CY": $iso_code = 'Zypern'; break;
			case "CX": $iso_code = 'Weihnachtsinsel'; break;
			case "CC": $iso_code = 'Kokosinseln'; break;
			case "CO": $iso_code = 'Kolumbien'; break;
			case "KM": $iso_code = 'Komoren'; break;
			case "CG": $iso_code = 'Kongo, Republik'; break;
			case "CD": $iso_code = 'Kongo, Demokratische Republik'; break;
			case "CK": $iso_code = 'Cookinseln'; break;
			case "KR": $iso_code = 'Südkorea'; break;
			case "KP": $iso_code = 'Korea, Demokratische Republik'; break;
			case "CI": $iso_code = 'Costa do Marfim'; break;
			case "CR": $iso_code = 'Costa Rica'; break;
			case "HR": $iso_code = 'Kroatien'; break;
			case "CU": $iso_code = 'Kuba'; break;
			case "CW": $iso_code = 'Curacao'; break;
			case "DK": $iso_code = 'Dänemark'; break;
			case "DJ": $iso_code = 'Dschibuti'; break;
			case "DM": $iso_code = 'Dominica'; break;
			case "DO": $iso_code = 'Dominikanische Republik'; break;
			case "EG": $iso_code = 'Ägypten'; break;
			case "SV": $iso_code = 'El Salvador'; break;
			case "AE": $iso_code = 'Vereinigte Arabische Emirate'; break;
			case "EC": $iso_code = 'Ecuador'; break;
			case "ER": $iso_code = 'Eritrea'; break;
			case "SK": $iso_code = 'Slowakei'; break;
			case "SI": $iso_code = 'Slowenien'; break;
			case "ES": $iso_code = 'Spanien'; break;
			case "US": $iso_code = 'VEREINIGTE STAATEN VON AMERIKA'; break;
			case "EE": $iso_code = 'Estland'; break;
			case "ET": $iso_code = 'Äthiopien'; break;
			case "FO": $iso_code = 'Färöer Inseln'; break;
			case "FJ": $iso_code = 'Fidschi'; break;
			case "PH": $iso_code = 'Philippinen'; break;
			case "FI": $iso_code = 'Finnland'; break;
			case "FR": $iso_code = 'Frankreich'; break;
			case "GA": $iso_code = 'Gabun'; break;
			case "GM": $iso_code = 'Gambia'; break;
			case "GH": $iso_code = 'Ghana'; break;
			case "GE": $iso_code = 'Georgia'; break;
			case "GS": $iso_code = 'Süd-Georgien und die südlichen Sandwich-Inseln'; break;
			case "GI": $iso_code = 'Gibraltar'; break;
			case "GR": $iso_code = 'Griechenland'; break;
			case "GD": $iso_code = 'Grenada'; break;
			case "GL": $iso_code = 'Grönland'; break;
			case "GP": $iso_code = 'Guadeloupe'; break;
			case "GU": $iso_code = 'Guam'; break;
			case "GT": $iso_code = 'Guatemala'; break;
			case "GG": $iso_code = 'Guernsey'; break;
			case "GY": $iso_code = 'Guyana'; break;
			case "GF": $iso_code = 'Französisch-Guayana'; break;
			case "GW": $iso_code = 'Guinea-Bissau'; break;
			case "GN": $iso_code = 'Guinea-Conakry'; break;
			case "GQ": $iso_code = 'Äquatorialguinea'; break;
			case "HT": $iso_code = 'Haiti'; break;
			case "HM": $iso_code = 'Heard- und McDonald-Inseln, Insel'; break;
			case "HN": $iso_code = 'Honduras'; break;
			case "HK": $iso_code = 'Hongkong'; break;
			case "HU": $iso_code = 'Ungarn'; break;
			case "YE": $iso_code = 'Jemen'; break;
			case "IN": $iso_code = 'Indien'; break;
			case "ID": $iso_code = 'Indonesien'; break;
			case "IQ": $iso_code = 'Irak'; break;
			case "IR": $iso_code = 'Wille'; break;
			case "IE": $iso_code = 'Irland'; break;
			case "IS": $iso_code = 'Island'; break;
			case "IL": $iso_code = 'Israel'; break;
			case "IT": $iso_code = 'Italien'; break;
			case "JM": $iso_code = 'Jamaika'; break;
			case "JP": $iso_code = 'Japan'; break;
			case "JE": $iso_code = 'Jersey'; break;
			case "JO": $iso_code = 'Jordanien'; break;
			case "KI": $iso_code = 'Kiribati'; break;
			case "KW": $iso_code = 'Kuwait'; break;
			case "LA": $iso_code = 'Laos'; break;
			case "LS": $iso_code = 'Lesotho'; break;
			case "LV": $iso_code = 'Lettland'; break;
			case "LB": $iso_code = 'Libanon'; break;
			case "LR": $iso_code = 'Liberia'; break;
			case "LY": $iso_code = 'Libyen'; break;
			case "LI": $iso_code = 'Liechtenstein'; break;
			case "LT": $iso_code = 'Litauen'; break;
			case "LU": $iso_code = 'Luxemburg'; break;
			case "MO": $iso_code = 'Macau'; break;
			case "MK": $iso_code = 'Mazedonien, Republik'; break;
			case "MG": $iso_code = 'Madagaskar'; break;
			case "MY": $iso_code = 'Malaysia'; break;
			case "MW": $iso_code = 'Malawi'; break;
			case "MV": $iso_code = 'Malediven'; break;
			case "ML": $iso_code = 'Mali'; break;
			case "MT": $iso_code = 'Malta'; break;
			case "FK": $iso_code = 'Falkland Inseln'; break;
			case "IM": $iso_code = 'Mann, Insel'; break;
			case "MP": $iso_code = 'Nördliche Marianneninseln'; break;
			case "MA": $iso_code = 'Marokko'; break;
			case "MH": $iso_code = 'Marshallinseln'; break;
			case "MQ": $iso_code = 'Martinique'; break;
			case "MU": $iso_code = 'Mauritius'; break;
			case "MR": $iso_code = 'Mauretanien'; break;
			case "YT": $iso_code = 'Mayotte'; break;
			case "UM": $iso_code = 'Kleinere vorgelagerte Inseln der Vereinigten Staaten'; break;
			case "MX": $iso_code = 'Mexiko'; break;
			case "MM": $iso_code = 'Myanmar'; break;
			case "FM": $iso_code = 'Mikronesien, Föderierte Staaten von'; break;
			case "MZ": $iso_code = 'Mosambik'; break;
			case "MD": $iso_code = 'Moldau'; break;
			case "MC": $iso_code = 'Monaco'; break;
			case "MN": $iso_code = 'Mongolei'; break;
			case "ME": $iso_code = 'Montenegro'; break;
			case "MS": $iso_code = 'Montserrat'; break;
			case "NA": $iso_code = 'Namibia'; break;
			case "NR": $iso_code = 'Nauru'; break;
			case "NP": $iso_code = 'Nepal'; break;
			case "NI": $iso_code = 'Nicaragua'; break;
			case "NE": $iso_code = 'Niger'; break;
			case "NG": $iso_code = 'Nigeria'; break;
			case "NU": $iso_code = 'Niue'; break;
			case "NF": $iso_code = 'Norfolkinsel'; break;
			case "NO": $iso_code = 'Norwegen'; break;
			case "NC": $iso_code = 'Neu-Kaledonien'; break;
			case "NZ": $iso_code = 'Neuseeland'; break;
			case "OM": $iso_code = 'Oman'; break;
			case "NL": $iso_code = 'Niederlande'; break;
			case "PW": $iso_code = 'Palau'; break;
			case "PS": $iso_code = 'Palästina'; break;
			case "PA": $iso_code = 'Panama'; break;
			case "PG": $iso_code = 'Papua Neu-Guinea'; break;
			case "PK": $iso_code = 'Pakistan'; break;
			case "PY": $iso_code = 'Paraguay'; break;
			case "PE": $iso_code = 'Peru'; break;
			case "PN": $iso_code = 'Pitcairn'; break;
			case "PF": $iso_code = 'Französisch-Polynesisch'; break;
			case "PL": $iso_code = 'Polen'; break;
			case "PR": $iso_code = 'Puerto Rico'; break;
			case "PT": $iso_code = 'Portugal'; break;
			case "QA": $iso_code = 'Katar'; break;
			case "KE": $iso_code = 'Kenia'; break;
			case "KG": $iso_code = 'Kirgisistan'; break;
			case "GB": $iso_code = 'Vereinigtes Königreich Großbritannien und Nordirland'; break;
			case "RE": $iso_code = 'Treffen'; break;
			case "RO": $iso_code = 'Rumänien'; break;
			case "RW": $iso_code = 'Ruanda'; break;
			case "RU": $iso_code = 'Russland'; break;
			case "EH": $iso_code = 'Westsahara'; break;
			case "AS": $iso_code = 'Amerikanischen Samoa-Inseln'; break;
			case "WS": $iso_code = 'Samoa'; break;
			case "PM": $iso_code = 'Saint Pierre und Miquelon'; break;
			case "SB": $iso_code = 'Salomon-Inseln'; break;
			case "SM": $iso_code = 'San Marino'; break;
			case "SH": $iso_code = 'St. Helena'; break;
			case "LC": $iso_code = 'St. Lucia'; break;
			case "BL": $iso_code = 'Saint-Barthélemy'; break;
			case "KN": $iso_code = 'St. Kitts und Nevis'; break;
			case "SX": $iso_code = 'Sankt Martin (Niederlande)'; break;
			case "MF": $iso_code = 'Saint-Martin (Frankreich)'; break;
			case "ST": $iso_code = 'Sao Tome und Principe'; break;
			case "VC": $iso_code = 'St. Vincent und die Grenadinen'; break;
			case "SN": $iso_code = 'Senegal'; break;
			case "SL": $iso_code = 'Sierra Leone'; break;
			case "RS": $iso_code = 'Serbien'; break;
			case "SC": $iso_code = 'Seychellen'; break;
			case "SG": $iso_code = 'Singapur'; break;
			case "SY": $iso_code = 'Syrien'; break;
			case "SO": $iso_code = 'Somalia'; break;
			case "LK": $iso_code = 'Sri Lanka'; break;
			case "SZ": $iso_code = 'Swasiland'; break;
			case "SD": $iso_code = 'Sudan'; break;
			case "SS": $iso_code = 'Südsudan'; break;
			case "SE": $iso_code = 'Schweden'; break;
			case "CH": $iso_code = 'Schweiz'; break;
			case "SR": $iso_code = 'Surinam'; break;
			case "SJ": $iso_code = 'Jan Mayen'; break;
			case "TH": $iso_code = 'Thailand'; break;
			case "TW": $iso_code = 'Taiwan'; break;
			case "TJ": $iso_code = 'Tadschikistan'; break;
			case "TZ": $iso_code = 'Tansania'; break;
			case "TF": $iso_code = 'Französische Süd- und Antarktisgebiete'; break;
			case "IO": $iso_code = 'Britisches Territorium des Indischen Ozeans'; break;
			case "TL": $iso_code = 'Timor-Leste'; break;
			case "TG": $iso_code = 'Gehen'; break;
			case "TK": $iso_code = 'Tokelau'; break;
			case "TO": $iso_code = 'Tonga'; break;
			case "TT": $iso_code = 'Trinidad und Tobago'; break;
			case "TN": $iso_code = 'Tunesien'; break;
			case "TC": $iso_code = 'Turks- und Caicosinseln'; break;
			case "TM": $iso_code = 'Turkmenistan'; break;
			case "TR": $iso_code = 'Truthahn'; break;
			case "TV": $iso_code = 'Tuvalu'; break;
			case "UA": $iso_code = 'Ukraine'; break;
			case "UG": $iso_code = 'Uganda'; break;
			case "UY": $iso_code = 'Uruguay'; break;
			case "UZ": $iso_code = 'Usbekistan'; break;
			case "VU": $iso_code = 'Vanuatu'; break;
			case "VA": $iso_code = 'Vatikan'; break;
			case "VE": $iso_code = 'Venezuela'; break;
			case "VN": $iso_code = 'Vietnam'; break;
			case "VI": $iso_code = 'Amerikanische Jungferninseln'; break;
			case "VG": $iso_code = 'Britische Jungferninseln'; break;
			case "WF": $iso_code = 'Wallis und Futuna'; break;
			case "ZM": $iso_code = 'Sambia'; break;
			case "ZW": $iso_code = 'Zimbabwe'; break;

			default: break;
		}
		return $iso_code;
	}
}

/**
 * Get The country translation by ISO
 * @param  [string] $iso2Code
 * @return response
 */
if(!function_exists('getTranslationByISOCountry')){
	function getTranslationByISOCountry($countryIso, $lang){
		$fullname = '';
		$isActiveTrans = 0;

		if($isActiveTrans == 1){
			switch ($lang) {
				case 'en': $fullname = getCountryByISO2EN($countryIso); break;
				case 'de': $fullname = getCountryByISO2DE($countryIso); break;
				case 'pt': $fullname = getCountryByISO2($countryIso); break;
				default: $fullname = getCountryByISO2($countryIso); break;
			}
		}else{
			$fullname = getCountryByISO2($countryIso);
		}

		return $fullname;
	}
}

/**
 * Get Translations
 * @param $lang
 * @return array
 */
if(!function_exists('getTranslationsArrayByLang')){
	function getTranslationsArrayByLang($lang){
		$isActiveTrans = 0;

		if($isActiveTrans == 1){
			if(!$lang){ return null; }
			$data = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/i18n/".$lang.".json");
			if($data){ return json_decode($data, true); }
		}else{
			$data = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/i18n/pt.json");
			if($data){ return json_decode($data, true); }
		}

		return null;
	}
}

/**
 * CLEAN STRING FROM SPECIAL CHARS AND BLANK SPACES
 * @param $string
 * @return cleaned string
 */
if(!function_exists('stringCleanerSC')){
	function stringCleanerSC($stringToClean) {
		// Replaces all spaces.
		$stringToClean = str_replace(' ', '', $stringToClean);
		// Removes special chars.
		$stringToClean = preg_replace('/[^A-Za-z0-9\-]/', '', $stringToClean);

		// Replaces multiple hyphens.
		return preg_replace('/-+/', '', $stringToClean);
	}
}

/**
 * CLEAN STRING: ALLOW ONLY LETTERS | NUMBERS | SPACES
 * @param  $stringToClean
 * @return cleaned string
 */
if(!function_exists('stringCleanerLNS')){
	function stringCleanerLNS($stringToClean) {
		//Test string and return bool
		// return preg_match('/^[a-zA-Z0-9- #_]+$/', $stringToClean) ? true : false;
		return preg_match('/^[a-zA-Z0-9- _#*\/.]+$/', $stringToClean) ? true : false;
	}
}

/**
 * Send notification email for administration
 * @param $emailNotification
 * @param $subject
 * @param $htmlTextContent
 * @return bool response
 */
if(!function_exists('sendNotificationEmailAdminCentral')){
	function sendNotificationEmailAdminCentral($emailNotification, $subject, $htmlTextContent, $getEmpresaData=1, $emailCC = null){
		//PROCESS EMAIL SENDER
		$phpmailer = __DIR__.'/../../server/PHPMailer6/PHPMailerAutoload.php';
		require_once ($phpmailer);

		//INIT VARS
		$emailNotification = trim($emailNotification);
		$designacaoEmpresa = 'Empresa';
		$emailEmpresa = 'email@empresa.pt';
		$logoEmpresa = '';

		$mail = new _PHPMailer(true);
		$mail -> SMTPDebug = 0;

		$htmlClienteTemp = ' '.$htmlTextContent.' ';

		$htmlCliente = prepareHtmlEmailCentral($htmlClienteTemp, $logoEmpresa, $designacaoEmpresa);

		$textPlain = "".$htmlTextContent."\n
		\n Obrigado pela sua preferência,\n A equipa do GESFaturação.";

		$Mailer = new _PHPMailer();

		// define que será usado SMTP
		$Mailer -> IsSMTP();

		// envia email HTML
		$Mailer -> isHTML(true);

		// codificação UTF-8, a codificação mais usada recentemente
		$Mailer -> CharSet = 'UTF-8';

		$Mailer -> SMTPDebug = 0;

		$Mailer -> SMTPAuth = true;
		$Mailer -> SMTPSecure = 'ssl';
		$Mailer -> Host = 'server.email.pt';
		$Mailer -> Port = '999';
		$Mailer -> Username = 'no-reply@teste.pt';
		$Mailer -> Password = 'xpto12345XPTA';
		$Mailer->addReplyTo($emailEmpresa, $designacaoEmpresa);
		$Mailer -> From = 'no-reply@teste.pt';
		$Mailer -> FromName = $designacaoEmpresa;

		$Mailer -> Subject = $subject;
		$Mailer -> AddAddress($emailNotification);
		if($emailCC && $emailCC!==null) $Mailer -> AddCC($emailCC);

		$Mailer -> Body = $htmlCliente;
		$Mailer -> AltBody = strip_tags($textPlain);

		//Send the email
		$send = $Mailer -> Send();

		return $send;
	}
}

//place html content into final template
if(!function_exists('prepareHtmlEmailCentral')){
	function prepareHtmlEmailCentral($htmlBodyContent, $logoEmpresa=null, $designacaoEmpresa=null){
		if(!$logoEmpresa) $logoEmpresa = 'logo_default.png';
		if(!$designacaoEmpresa) $designacaoEmpresa = 'GESFaturação';

		//prepare final html
		$htmlBodyFinal = '
			<!doctype html>
			<html>
				<head>
					<meta name="viewport" content="width=device-width" />
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title>GESFaturação - O mais simples software de faturação online</title>
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
					<style>
						img { border: none; -ms-interpolation-mode: bicubic; max-width: 100%; }
						.logoimg { max-width: 200px; }
						.logoimg2 { max-width: 150px; }

						body { background-color: #f6f6f6; font-family: "Helvetica Neue Bold", sans-serif; -webkit-font-smoothing: antialiased; font-size: 12px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #222222 !important; }
						table { border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; } table td { font-family: "Helvetica Neue Bold", sans-serif; font-size: 12px; vertical-align: top; }
						.body { background-color: #f6f6f6; width: 100%; }
						.container { display: block; margin: 0 auto !important; /* makes it centered */ max-width: 580px; padding: 10px; width: 580px; }
						.content { box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; }
						.main { background: #ffffff; border-radius: 3px; width: 100%; }
						.wrapper { box-sizing: border-box; padding: 20px; }
						.content-block { padding-bottom: 10px; padding-top: 10px; }
						.footer { clear: both; margin-top: 10px; text-align: center; width: 100%; }
						.footer td, .footer p, .footer span, .footer a { color: #999999; font-size: 12px; text-align: center; }

						h1, h2, h3, h4 { color: #000000; font-family: "Helvetica Neue Bold", sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 20px; color: #222222; }
						h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; color: #222222; }
						p, ul, ol { font-family: "Helvetica Neue Bold", sans-serif; font-size: 12px; font-weight: normal; margin: 0; margin-bottom: 15px; color: #222222; }
						p li, ul li, ol li { list-style-position: inside; margin-left: 5px; }
						a { color: #3498db; text-decoration: underline; }

						.btn { box-sizing: border-box; width: 100%; }
						.btn > tbody > tr > td { padding-bottom: 15px; }
						.btn table { width: auto; }
						.btn table td { background-color: #ffffff; border-radius: 5px; text-align: center; }
						.btn a { background-color: #ffffff; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; color: #3498db; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; }
						.btn-primary table td {background-color: #3498db; }
						.btn-primary a { background-color: #3498db; border-color: #3498db; color: #ffffff; }
						.last { margin-bottom: 0; }

						.first { margin-top: 0; }
						.align-center { text-align: center; }
						.align-right { text-align: right; }
						.align-left { text-align: left; }
						.clear { clear: both; }

						.mt0 { margin-top: 0; }
						.mb0 { margin-bottom: 0; }
						.preheader { color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0; }
						.powered-by a { text-decoration: none; }
						hr { border: 0; border-bottom: 1px solid #f6f6f6; margin: 20px 0; }

						@media only screen and (max-width: 620px) {
							table[class=body] h1 { font-size: 28px !important; margin-bottom: 10px !important; }
							table[class=body] p,
							table[class=body] ul,
							table[class=body] ol,
							table[class=body] td,
							table[class=body] span,
							table[class=body] a { font-size: 16px !important; }
							table[class=body] .wrapper,
							table[class=body] .article { padding: 10px !important; }
							table[class=body] .content { padding: 0 !important; }
							table[class=body] .container { padding: 0 !important; width: 100% !important; }
							table[class=body] .main { border-left-width: 0 !important; border-radius: 0 !important; border-right-width: 0 !important; }
							table[class=body] .btn table { width: 100% !important; }
							table[class=body] .btn a { width: 100% !important; }
							table[class=body] .img-responsive { height: auto !important; max-width: 100% !important; width: auto !important; }
						}
					
						@media all {
							.ExternalClass { width: 100%; }
							.ExternalClass,
							.ExternalClass p,
							.ExternalClass span,
							.ExternalClass font,
							.ExternalClass td,
							.ExternalClass div { line-height: 100%; }
							.apple-link a { color: inherit !important; font-family: inherit !important; font-size: inherit !important; font-weight: inherit !important; line-height: inherit !important; text-decoration: none !important; }
							#MessageViewBody a { color: inherit; text-decoration: none; font-size: inherit; font-family: inherit; font-weight: inherit; line-height: inherit; }
							.btn-primary table td:hover { background-color: #34495e !important; }
							.btn-primary a:hover { background-color: #34495e !important; border-color: #34495e !important; } 
						}

						.title { font-weight: 400; font-size: 16px; color: #000000; font-family: "Helvetica Neue Bold", sans-serif; line-height: 1.4; margin: 0; margin-bottom: 20px;}
						.subtitle { font-weight: 600; font-size: 14px; color: #000000; font-family: "Helvetica Neue Bold", sans-serif; line-height: 1.4; margin: 0; margin-top: 30px; margin-bottom: 10px;}
						.text-black { color: #000000 !important; }
						.facebook-link { color: #1877F2; }
						.facebook-link i { color: #1877F2; }
						.final_contente_thanks { color: #444444; margin-top: 40px; margin-bottom: 20px; line-height: 2;}
						a.button { display: inline-block; font-size: 14px; text-decoration: none; padding: 12px 35px 12px 35px; text-align: center; background-color: #DE8224; color: #ffffff; }
					</style>
				</head>
				<body class="">
					<span class="preheader">GESFaturação - O mais simples software de faturação online.</span>
					<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
						<tr>
							<td>&nbsp;</td>
							<td class="container">
								<div class="content">
									<!-- START HEADER BEFORE WHITE BOARD -->
									<!--<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td class="content-block align-center">
										<a href="https://gesfaturacao.pt" target="_blank"><img class="logoimg" src="https://gesfaturacao.pt/images/logo.png" alt="'.$designacaoEmpresa.'" title="'.$designacaoEmpresa.'"></a>
										</td>
									</tr>
									</table>-->
									<!-- END HEADER BEFORE WHITE BOARD -->

									<!-- START CENTERED WHITE CONTAINER -->
									<table role="presentation" class="main">
										<tr>
											<td class="wrapper">
												<table role="presentation" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td class="align-left">
															<a href="https://gesfaturacao.pt" target="_blank"><img class="logoimg" src="https://gesfaturacao.pt/images/logo.png" alt="'.$designacaoEmpresa.'" title="'.$designacaoEmpresa.'"></a>
															<p></p>
														</td>
													</tr>
													<tr>
														<td class="text-black">
															'.$htmlBodyContent.'
															<p class="align-center final_contente_thanks">Obrigado pela preferência<br>GESFaturação</p>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- END CENTERED WHITE CONTAINER -->

									<!-- START FOOTER -->
									<div class="footer">
										<table role="presentation" border="0" cellpadding="0" cellspacing="0">
											<tr>
											<td class="content-block">
												<span class="apple-link"><a class="facebook-link" href="https://www.facebook.com/gesfaturacao" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></span>
											</td>
											</tr>
											<tr>
											<td class="content-block powered-by">
												<a href="https://gesfaturacao.pt" target="_blank"><img class="logoimg2" src="https://gesfaturacao.pt/images/logo.png" alt="'.$designacaoEmpresa.'" title="'.$designacaoEmpresa.'"></a>
											</td>
											</tr>
										</table>
									</div>
									<!-- END FOOTER -->
								</div>
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</body>
			</html>	
		';

		return $htmlBodyFinal;
	}
}

/* ==============================
 * ------- ENCOMENDA AQUI -------
 * ------ NOT USED ANYMORE ------
 * ============================== */
/**
 * GET ORDER INFO
 * @param  $client_id
 * @param  $order_id
 * @return
 */
if(!function_exists('getDataOrder')){
	function getDataOrder($client_id, $order_id) {
		global $sqli_connection;

		$data = array();

		//get data for check
		$query = "SELECT Referencia, FaturaConsumidorFinal, ID_MoradaFaturacao, Nome_Faturacao, NIF_Faturacao, Morada_Faturacao, CodigoPostal_Faturacao, Localidade_Faturacao, Contacto_Faturacao, MoradaEntregaDiferente, ID_PontoEntrega, Nome_PontoEntrega, Morada_PontoEntrega, CodigoPostal_PontoEntrega, Localidade_PontoEntrega, Contacto_PontoEntrega, ID_MoradaEntrega, Nome_Entrega, NIF_Entrega, Morada_Entrega, CodigoPostal_Entrega, Localidade_Entrega, Contacto_Entrega, Obs, ID_TipoEntrega, DATE_FORMAT(DataHoraEncomenda,'%d/%m/%Y'), DATE_FORMAT(DataHoraEntrega,'%d/%m/%Y %H:%i:%s'), DATE_FORMAT(DataHoraPagamento,'%d/%m/%Y %H:%i:%s'), TotalEnvio, TotalProdutos, Total, encomendaaqui_metodopagamento.ID_MetodoPagamento, encomendaaqui_metodopagamento.Nome, encomendaaqui_estado.ID_Estado, encomendaaqui_estado.Nome, encomendaaqui_estado.Cor
		FROM encomendaaqui_encomenda, encomendaaqui_estado, encomendaaqui_metodopagamento
		WHERE encomendaaqui_encomenda.ID_MetodoPagamento=encomendaaqui_metodopagamento.ID_MetodoPagamento 
			AND encomendaaqui_encomenda.ID_Estado=encomendaaqui_estado.ID_Estado 
			AND encomendaaqui_encomenda.ID_Cliente=? 
			AND encomendaaqui_encomenda.ID_Encomenda=? 
		";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("dd", $client_id, $order_id);
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP061";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($referencia, $fat_noinvoice, $fat_address_id, $fat_address_name, $fat_address_nif, $fat_address_street, $fat_address_postalcode, $fat_address_city, $fat_address_contact, $diff_delivery_address, $take_away_point, $tw_point_name, $tw_point_street, $tw_point_postalcode, $tw_point_city, $tw_point_contact, $delivery_address_id, $delivery_address_name, $delivery_address_nif, $delivery_address_street, $delivery_address_postalcode, $delivery_address_city, $delivery_address_contact, $order_obs, $delivery_option, $datetime_order, $datetime_delivery, $datetime_payment, $delivery_cost, $products_order, $order_total, $payment_method_id, $payment_method, $state_id, $state, $state_color);
			while ($stmt -> fetch()) {
				$data["order"] = array("referencia" => $referencia, "fat_noinvoice" => $fat_noinvoice, "fat_address_id" => $fat_address_id, "fat_address_name" => $fat_address_name, "fat_address_nif" => $fat_address_nif, "fat_address_street" => $fat_address_street, "fat_address_postalcode" => $fat_address_postalcode, "fat_address_city" => $fat_address_city, "fat_address_contact" => $fat_address_contact, "diff_delivery_address" => $diff_delivery_address, "take_away_point" => $take_away_point, "tw_point_name" => $tw_point_name, "tw_point_street" => $tw_point_street, "tw_point_postalcode" => $tw_point_postalcode, "tw_point_city" => $tw_point_city, "tw_point_contact" => $tw_point_contact, "delivery_address_id" => $delivery_address_id, "delivery_address_name" => $delivery_address_name, "delivery_address_nif" => $delivery_address_nif, "delivery_address_street" => $delivery_address_street, "delivery_address_postalcode" => $delivery_address_postalcode, "delivery_address_city" => $delivery_address_city, "delivery_address_contact" => $delivery_address_contact, "order_obs" => $order_obs, "delivery_option" => $delivery_option, "datetime_order" => $datetime_order, "datetime_delivery" => $datetime_delivery, "datetime_payment" => $datetime_payment, "delivery_cost" => $delivery_cost, "products_order" => $products_order, "order_total" => $order_total, "payment_method_id" => $payment_method_id, "payment_method" => $payment_method, "state_id" => $state_id, "state" => $state, "state_color" => $state_color);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP062";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		//PROCESS PAYMENT METHOD - MB REF.
		if ($payment_method_id == 1) {
			$query = "SELECT Entidade, Referencia, Valor, DATE_FORMAT(DataEmissao,'%d/%m/%Y'), DATE_FORMAT(DataValidade,'%d/%m/%Y')
			FROM encomendaaqui_multibanco, encomendaaqui_encomenda_multibanco
			WHERE encomendaaqui_encomenda_multibanco.ID_Multibanco = encomendaaqui_multibanco.ID_ReferenciaMB 
				AND encomendaaqui_encomenda_multibanco.ID_Encomenda=? 
			ORDER BY ID_EncomendaMultibanco LIMIT 1";
			if ($stmt = $sqli_connection -> prepare($query)) {
				$stmt -> bind_param("d", $order_id);
				$result = $stmt -> execute();
				if (false === $result) {
					$response["errors"] = true;
					$response["type"] = "HELP063";
					$response["message"] = $stmt -> error;
					die(json_encode($response));
				}
				$stmt -> bind_result($mb_entity, $mb_reference, $mb_value, $mb_emission_date, $mb_vality_date);
				while ($stmt -> fetch()) {
					$data["mb"] = array("mb_entity" => $mb_entity, "mb_reference" => $mb_reference, "mb_value" => $mb_value, "mb_emission_date" => $mb_emission_date, "mb_vality_date" => $mb_vality_date);
				}
				$stmt -> close();
			} else {
				$response["errors"] = true;
				$response["type"] = "HELP064";
				$response["message"] = $sqli_connection -> error;
				die(json_encode($response));
			}
		}
		//PROCESS PAYMENT METHOD - MBWAY
		else if ($payment_method_id == 2) {
			$query = "SELECT Numero, Valor, DATE_FORMAT(DataEmissao,'%d/%m/%Y')
			FROM encomendaaqui_mbway, encomendaaqui_encomenda_mbway
			WHERE encomendaaqui_encomenda_mbway.ID_MBWay = encomendaaqui_mbway.ID_ReferenciaMBWay 
				AND encomendaaqui_encomenda_mbway.ID_Encomenda=? 
			ORDER BY ID_EncomendaMBWay LIMIT 1";
			if ($stmt = $sqli_connection -> prepare($query)) {
				$stmt -> bind_param("d", $order_id);
				$result = $stmt -> execute();
				if (false === $result) {
					$response["errors"] = true;
					$response["type"] = "HELP065";
					$response["message"] = $stmt -> error;
					die(json_encode($response));
				}
				$stmt -> bind_result($mbway_number, $mbway_value, $mbway_emission_date);
				while ($stmt -> fetch()) {
					$data["mbway"] = array("mbway_number" => $mbway_number, "mbway_value" => $mbway_value, "mbway_emission_date" => $mbway_emission_date);
				}
				$stmt -> close();
			} else {
				$response["errors"] = true;
				$response["type"] = "HELP066";
				$response["message"] = $sqli_connection -> error;
				die(json_encode($response));
			}
		}

		//GET STATE INFO FROM ENCOMENDA
		$query = "SELECT encomendaaqui_estado.Nome, encomendaaqui_estado.Cor, DATE_FORMAT(encomendaaqui_encomenda_estado.DataHoraAlteracao,'%d/%m/%Y %H:%i:%s')
		FROM encomendaaqui_encomenda, encomendaaqui_estado, encomendaaqui_encomenda_estado
		WHERE encomendaaqui_encomenda_estado.ID_Estado=encomendaaqui_estado.ID_Estado 
			AND encomendaaqui_encomenda_estado.ID_Encomenda=encomendaaqui_encomenda.ID_Encomenda 
			AND encomendaaqui_encomenda.ID_Cliente=? 
			AND encomendaaqui_encomenda.ID_Encomenda=? 
		ORDER BY encomendaaqui_encomenda_estado.DataHoraAlteracao DESC";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("dd", $client_id, $order_id);
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP067";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($state_name, $state_color, $state_update);
			while ($stmt -> fetch()) {
				$data["states"][] = array("name" => $state_name, "color" => $state_color, "update" => $state_update);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP068";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		$query = "SELECT faturacao_artigos.ID_Artigo, encomendaaqui_encomenda_linha.Nome_Artigo, encomendaaqui_encomenda_linha.PrecoPVP, encomendaaqui_encomenda_linha.Quantidade, encomendaaqui_encomenda_linha.Obs, encomendaaqui_encomenda_linha.Subtotal
		FROM encomendaaqui_encomenda, encomendaaqui_encomenda_linha, faturacao_artigos
		WHERE faturacao_artigos.ID_Artigo=encomendaaqui_encomenda_linha.ID_Artigo 
			AND encomendaaqui_encomenda.ID_Encomenda=encomendaaqui_encomenda_linha.ID_Encomenda 
			AND encomendaaqui_encomenda.ID_Cliente=? 
			AND encomendaaqui_encomenda.ID_Encomenda=?
		";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("dd", $client_id, $order_id);
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["type"] = "HELP069";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($article_id, $article_name, $article_price, $article_qty, $article_obs, $line_subtotal);
			while ($stmt -> fetch()) {
				$data["lines"][] = array("article_id" => $article_id, "article_name" => $article_name, "article_price" => $article_price, "article_qty" => $article_qty, "article_obs" => $article_obs, "line_subtotal" => $line_subtotal);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP070";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		//return all data
		return $data;
	}
}

/**
 * TEST IF URL EXISTS
 * @param  $url
 * @return boolean
 */
if(!function_exists('is_url_exist')){
	function is_url_exist($url) {
		//curl to get the url response
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		//check if exists with status code
		if ($code == 200) {
			$status = true;
		} else {
			$status = false;
		}
		curl_close($ch);

		//return bool
		return $status;
	}
}

/**
 * GET DATA FROM RESTAURANT
 * @return info array
 */
if(!function_exists('getRestaurantData')){
	function getRestaurantData() {
		global $sqli_connection;

		$data = array();

		//GET THE DATA
		$query = "SELECT Nome, Contacto, Morada, CodigoPostal, Localidade, Contacto, Email, Logotipo, ImagemFundo, MetaKeywords, MetaDescription FROM encomendaaqui_restaurante";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP071";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($restaurant_name, $restaurant_phone, $restaurant_street, $restaurant_postalcode, $restaurant_city, $restaurant_contact, $restaurant_email, $restaurant_logo, $restaurant_background, $restaurant_keywords, $restaurant_description);
			while ($stmt -> fetch()) {
				$restaurant_address = $restaurant_street . " | " . $restaurant_postalcode . " " . $restaurant_city;

				$data = array("name" => $restaurant_name, "phone" => $restaurant_phone, "street" => $restaurant_street, "postalcode" => $restaurant_postalcode, "city" => $restaurant_city, "address" => $restaurant_address, "contact" => $restaurant_contact, "email" => $restaurant_email, "logo" => $restaurant_logo, "background" => $restaurant_background, "keywords" => $restaurant_keywords, "description" => $restaurant_description);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP072";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		//RETURN ARRAY
		return $data;
	}
}

/**
 * GET RESTAURANT PREFS
 * @return info array
 */
if(!function_exists('getRestaurantPrefs')){
	function getRestaurantPrefs() {
		global $sqli_connection;
		$data = array();

		//GET THE DATA
		$query = "SELECT MinimoEncomenda, EntregaDomicilio, TempoPreparacao, URLGesFaturacao, URLEncomendaAqui, TermosUso, PoliticaPrivacidade, EnvioEmailEncomenda, EnvioEmailPagamento FROM encomendaaqui_prefs";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "HELP073";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($minimo_encomenda, $entrega_domicilio, $tempo_preparacao, $url_base, $url_encomendaaqui, $termos_uso, $politica_privacidade, $email_novaencomenda, $email_novopagamento);
			while ($stmt -> fetch()) {
				$data = array("minimo_encomenda" => $minimo_encomenda, "entrega_domicilio" => $entrega_domicilio, "tempo_preparacao" => $tempo_preparacao, "url_base" => $url_base, "url_encomendaaqui" => $url_encomendaaqui, "termos_uso" => $termos_uso, "politica_privacidade" => $politica_privacidade, "email_novaencomenda" => $email_novaencomenda, "email_novopagamento" => $email_novopagamento);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "HELP074";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		//return array
		return $data;
	}
}
/* ================================= */

?>
