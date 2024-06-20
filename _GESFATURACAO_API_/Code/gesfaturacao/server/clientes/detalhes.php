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
$idCliente = $_POST['idCliente'];
$recuperacao = isset($_POST['esquecido']) && $_POST['esquecido'] == 1;

//DEFINE VARS ------------------------------------------------------------
$objectData = array();

//GET THE PROCESS --------------------------------------------------------
$query = "SELECT ID_Cliente,
	Nome,
	Nif,
	Codigo,
	CodigoInterno,
	Endereco,
	CodigoPostal,
	Localidade,
	Cidade,
	(SELECT ID_Concelho FROM concelho WHERE concelho.Nome LIKE faturacao_clientes.Cidade) AS IDCidade,
	Pais,
	Regiao,
	(SELECT ID_Distrito FROM distrito WHERE distrito.Nome LIKE faturacao_clientes.Regiao) AS IDDistrito,
	Email,
	Telefone,
	Telemovel,
	Fax,
	Website,
	'',
	ID_Grupo,
	(SELECT Descricao AS Metodo FROM faturacao_metodos_pagamento WHERE faturacao_metodos_pagamento.ID_Metodo = faturacao_clientes.MetPagamento),
	MetPagamento,
	Vencimento,
	Desconto,
	PreferenciaNome,
	PreferenciaTelefone,
	PreferenciaEmail,
	PreferenciaTelemovel,
	'',
	0,
	Usado,
	Ativo,
	IsentoIVA,
	MotivoIsencaoIVA,
	(SELECT CONCAT(Codigo,' - ', Descricao) FROM faturacao_motivos_isencao WHERE faturacao_motivos_isencao.ID_Motivo = faturacao_clientes.MotivoIsencaoIVA) AS MotivoIsencaoDescricao,
	Notas,
	NumAtividadeFitoFarmac,
	ObservacoesCliente
	FROM faturacao_clientes WHERE ID_Cliente=?";
if(!$recuperacao) $query .= " AND Esquecer=0";
if ( $stmt = $sqli_connection -> prepare($query) ) {
	//bind params
	$stmt -> bind_param("d", $idCliente);
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
        $objectData['ID_Cliente'],
		$objectData['Nome'],
		$objectData['Nif'],
		$objectData['Codigo'],
		$objectData['CodigoInterno'],
		$objectData['Endereco'],
		$objectData['CodigoPostal'],
		$objectData['Localidade'],
		$objectData['Cidade'],
		$objectData['CidadeID'],
		$objectData['Pais'],
		$objectData['Regiao'],
		$objectData['RegiaoID'],
		$objectData['Email'],
		$objectData['Telefone'],
		$objectData['Telemovel'],
		$objectData['Fax'],
		$objectData['Website'],
		$objectData['Grupo'],
		$objectData['GrupoID'],
		$objectData['Metodo'],
		$objectData['MetodoID'],
		$objectData['Vencimento'],
		$objectData['Desconto'],
		$objectData['PreferenciaNome'],
		$objectData['PreferenciaTelefone'],
		$objectData['PreferenciaEmail'],
		$objectData['PreferenciaTelemovel'],
		$objectData['Account'],
		$objectData['ContaGeral'],
		$objectData['Usado'],
		$objectData['Ativo'],
		$objectData['IsencaoIVA'],
		$objectData['MotivoIsencao'],
		$objectData['MotivoIsencaoDescricao'],
		$objectData['Notas'],
		$objectData['NumAtividadeFitoFarmac'],
		$objectData['Observacoes']
	);
	$stmt -> fetch();
	$stmt -> close();
		
	$objectData['PaisFull'] = getCountryByISO2($objectData['Pais']);
	$objectData['ObservacoesCliente'] = nl2br($objectData['Observacoes']);

	//Repalce All NULL values for empty string
	// $objectData = array_map(function($v){
	//     if($v == NULL || is_null($v)) return "---";
	//     else return $v;
	// },$objectData);
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS002";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}

// var_dump($objectData);die();
$response["errors"] = false;
$response["data"] = $objectData;
die(json_encode($response));

?>