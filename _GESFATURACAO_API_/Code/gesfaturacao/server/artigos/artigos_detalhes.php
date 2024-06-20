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
	(SELECT Nome as categoria FROM faturacao_artigos_categorias WHERE faturacao_artigos_categorias.ID_Categoria=faturacao_artigos.ID_Categoria) AS Categoria, 
	(CASE Tipo WHEN 'P' THEN 'Produtos' WHEN 'S' THEN 'Serviços' WHEN 'O' THEN 'Outros' ELSE NULL END) AS Tipo,
	PrecoPVP,
	Preco,
	(SELECT Valor FROM faturacao_impostos WHERE faturacao_impostos.ID_Imposto=faturacao_artigos.ID_Imposto) AS IVA,
	(SELECT Descricao as Unidade FROM faturacao_unidades WHERE faturacao_unidades.ID_Unidade=faturacao_artigos.ID_Unidade) AS Unidade,
	Ativo,
	PlanoContas,
	PlanoContasCompras,
	Usado,
	RetencaoPercentagem,
	RetencaoValor,
	Stock,
	(SELECT CONCAT(Codigo, ': ', Descricao) FROM faturacao_motivos_isencao WHERE ID_Motivo=id_motivo_isencao),
	0 AS PrecoCustoCompras,
	DescricaoLonga,
	imagem,
	LabelEtiqueta,
	PrecoCusto AS PrecoCustoInicial,
	id_motivo_isencao,
	TipoComposto,
	EncomendaAqui,
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
		$objectData['Ativo'],
		$objectData['PlanoContas'],
		$objectData['PlanoContasCompras'],
		$objectData['Usado'],
		$objectData['RetencaoPercentagem'],
		$objectData['RetencaoValor'],
		$objectData['Stock'],
		$objectData['MotivoIsencao'],
		$objectData['PrecoCusto'],
		$objectData['DescricaoLonga'],
		$objectData['imagem'],
		$objectData['LabelEtiqueta'],
		$objectData['PrecoCustoInicial'],
		$objectData['ID_MotivoIsencao'],
		$objectData['TipoComposto'],
		$objectData['EncomendaAqui'],
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
	//clean text and put <br>
	$objectData['DescricaoLonga'] = nl2br($objectData['DescricaoLonga']);


	//calculate Retenção
	$retencaoFinal = 0;
	if($objectData['RetencaoValor'] > 0) $retencaoFinal = $objectData['RetencaoValor'];
	else{
		$taxa = $objectData['RetencaoPercentagem'] * 0.01;
		$retencaoFinal = $objectData['Preco'] * $taxa;
	}
	$objectData['Retencao'] = $retencaoFinal;

	//confirm price if null
	if(!$objectData['PrecoCusto']) $objectData['PrecoCusto'] = $objectData['PrecoCustoInicial'] > 0 ? $objectData['PrecoCustoInicial'] : 0;

	//tipo de composto
	$objectData['TipoCompostoDescricao'] = 'Nenhum';
	switch ($objectData['TipoComposto']) {
		case 1: $objectData['TipoCompostoDescricao'] = 'Composto Normal'; break;
		case 2: $objectData['TipoCompostoDescricao'] = 'Composto de Transformação'; break;

		default: break;
	}
	//------------------
} else {
	$response["errors"] = true;
	$response["type"] = "query";
	$response["line"] = "FATS002";
	$response["message"] = $sqli_connection -> error;
	die(json_encode($response));
}

//GET ASSOCIATED PRODUCTS ------------------------------------------------
$linhasassociados = array();

//add lines to final var
$objectData['linhas'] = $linhasassociados;
//------------------------------------------------------------------------

//GET ASSOCIATED PRODUCTS ------------------------------------------------
$linhasassociado = array();

//add lines to final var
$objectData['linhas_associado'] = $linhasassociado;
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
$query = "SELECT ID_Artigo_Preco, Preco, ID_Imposto,
	(SELECT Valor FROM faturacao_impostos WHERE faturacao_impostos.ID_Imposto=faturacao_artigos_precos.ID_Imposto) AS IVA,
 PrecoPVP FROM faturacao_artigos_precos WHERE ID_Artigo=?";
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
	$stmt -> bind_result($ID_Artigo_Preco, $Preco, $ID_Imposto, $Imposto, $PrecoPVP);
	while ($stmt -> fetch()) {
		$pricesLines[] = array("id" => $ID_Artigo_Preco, "preco" => $Preco, "id_imposto" => $ID_Imposto, "imposto" => $Imposto, "precoPVP" => $PrecoPVP);
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

//GET BARCODES ------------------------------------------------
$suppliersLines = array();

//add lines to final var
$objectData['suppliersLines'] = $suppliersLines;
//------------------------------------------------------------------------

// var_dump($objectData);die();
$response["errors"] = false;
$response["data"] = $objectData;
die(json_encode($response));

?>
