<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
/*Control user*/
/*
 * Script: DataTables server-side script for PHP and MySQL
 * Copyright: 2010 - Allan Jardine
 * License: GPL v2 or BSD (3-point)
 * Edited by Pedro Gomes
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Database connection information */
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection_mysql.php";

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
$aColumns = array(
	'faturacao_artigos.Codigo',
	'faturacao_artigos.Nome',
	'faturacao_artigos_categorias.Nome',
	'CASE faturacao_artigos.Tipo WHEN "P" THEN "Produtos" WHEN "S" THEN "Serviços" WHEN "O" THEN "Outros" ELSE NULL END',
	'faturacao_artigos.PrecoPVP',
	'faturacao_impostos.Valor',
	'faturacao_artigos.Stock',
	'faturacao_unidades.Sigla',
	'faturacao_artigos.ID_Artigo',
	'faturacao_artigos.Ativo',
	'faturacao_artigos.Usado',
	"0",
	'faturacao_artigos.TipoComposto',
	'faturacao_artigos.SerialNumber',
);

/* Column to filter*/
$fFilter = array(
	'faturacao_artigos.Codigo',
	'faturacao_artigos.Nome',
	'faturacao_artigos_categorias.Nome',
	'CASE faturacao_artigos.Tipo WHEN "P" THEN "Produtos" WHEN "S" THEN "Serviços" WHEN "O" THEN "Outros" ELSE NULL END',
	'faturacao_artigos.PrecoPVP',
	'faturacao_impostos.Valor',
	'faturacao_artigos.Stock',
	'faturacao_unidades.Sigla',
	'faturacao_artigos.ID_Artigo',
	'faturacao_artigos.Ativo',
	'faturacao_artigos.Usado',
	"0",
	'faturacao_artigos.TipoComposto',
	'faturacao_artigos.SerialNumber',
);

// 'AS' NAMES
$namesColumns = array(
	"Codigo",
	"ArtigoNome",
	"CategoriaNome",
	"Tipo",
	"PrecoPVP",
	"IvaValor",
	"Stock",
	"UnidadeSigla",
	"ID_Artigo",
	"Ativo",
	"Usado",
	"listCBarras",
	"TipoComposto",
	"SerialNumber",
);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "faturacao_artigos.ID_Artigo";

/* DB table to use */
$sTable = "faturacao_artigos 
	LEFT JOIN faturacao_unidades ON faturacao_unidades.ID_Unidade = faturacao_artigos.ID_Unidade 
	LEFT JOIN faturacao_impostos ON faturacao_impostos.ID_Imposto = faturacao_artigos.ID_Imposto 
	LEFT JOIN faturacao_artigos_categorias ON faturacao_artigos_categorias.ID_Categoria = faturacao_artigos.ID_Categoria 
";

/*DB Table to count*/
$cTable = "faturacao_artigos";

/*LEFT JOIN Table*/
$sLeft="";

/*Join Table*/
$sJoin = "faturacao_artigos.ID_Artigo > 0";

$categoria = filter_var($_GET["categoria"], FILTER_SANITIZE_NUMBER_INT);
$tipo = filter_var($_GET["tipo"], FILTER_SANITIZE_STRING);
$iva = filter_var($_GET["iva"], FILTER_SANITIZE_NUMBER_INT);
$stock_minimo = filter_var($_GET["stock_minimo"], FILTER_SANITIZE_NUMBER_FLOAT);
$stock_maximo = filter_var($_GET["stock_maximo"], FILTER_SANITIZE_NUMBER_FLOAT);


if($categoria != ""){
	$sJoin .= " AND faturacao_artigos.ID_Categoria = ".mysqli_real_escape_string($conexao, $categoria)." ";
}

if($tipo != ""){
	$sJoin .= " AND faturacao_artigos.Tipo = '".mysqli_real_escape_string($conexao, $tipo)."' ";
}

if($iva != ""){
	$sJoin .= " AND faturacao_artigos.ID_Imposto = ".mysqli_real_escape_string($conexao, $iva)." ";
}

if($stock_minimo != "" && $stock_maximo != ''){
	$sJoin .= " AND faturacao_artigos.Stock >= ".mysqli_real_escape_string($conexao, $stock_minimo)." AND Stock <= ".mysqli_real_escape_string($conexao, $stock_maximo)." ";
}

if($stock_minimo != "" && $stock_maximo == ''){
	$sJoin .= " AND faturacao_artigos.Stock >= ".mysqli_real_escape_string($conexao, $stock_minimo)." ";
}

if($stock_minimo == "" && $stock_maximo != ''){
	$sJoin .= " AND faturacao_artigos.Stock <= ".mysqli_real_escape_string($conexao, $stock_maximo)." ";
}

/* 
* Paging
*/
$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
{
	$sLimit = "LIMIT ".mysqli_real_escape_string($conexao, $_GET['iDisplayStart'] ).", ".mysqli_real_escape_string( $conexao,$_GET['iDisplayLength'] );
}


/*
* Ordering
*/
if ( isset( $_GET['iSortCol_0'] ) )
{
	$sOrder = "ORDER BY  ";
	for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
	{
		if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
		{
			$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				".mysqli_real_escape_string($conexao, $_GET['sSortDir_'.$i] ) .", ";
		}
	}

	$sOrder = substr_replace( $sOrder, "", -2 );
	if ( $sOrder == "ORDER BY" )
	{
		$sOrder = "";
	}
}


/* 
* Filtering
* NOTE this does not match the built-in DataTables filtering which does it
* word by word on any field. It's possible to do here, but concerned about efficiency
* on very large tables, and MySQL's regex functionality is very limited
*/
$sWhere = "WHERE " . $sJoin;
if ( $_GET['sSearch'] != "" )
{
	$sWhere = "WHERE ". $sJoin. " AND(";

	for ( $i=0 ; $i<count($fFilter) ; $i++ )
	{
		$sWhere .= $fFilter[$i]." LIKE '%".mysqli_real_escape_string( $conexao,$_GET['sSearch'] )."%' OR ";
	}
	$sWhere = substr_replace( $sWhere, "", -3 );
	$sWhere .= ')';
}

/* Individual column filtering */
for ( $i=0 ; $i<count($fFilter) ; $i++ )
{
	if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
	{
		if ( $sWhere == "" )
		{
			$sWhere = "WHERE ";
		}
		else
		{
			$sWhere .= " AND ";
		}
		$sWhere .= $fFilter[$i]." LIKE '%".mysqli_real_escape_string($conexao,$_GET['sSearch_'.$i])."%' ";
	}
}

/*
* Select list
*/
$sSelect = "";
for ( $i=0 ; $i<count($aColumns) ; $i++ )
{
	$sSelect .= $aColumns[$i] .' as `'.$namesColumns[$i].'`, ';
}
$sSelect = substr_replace( $sSelect, "", -2 );

/*
* SQL queries
* Get data to display
*/
$sQuery = "
	SELECT SQL_CALC_FOUND_ROWS ". $sSelect ."
	FROM $sTable
	$sLeft
	$sWhere 
	$sOrder
	$sLimit
";
$query = $sQuery;
// echo $sQuery;
$rResult = executaQuery($sQuery);

/* Data set length after filtering */
$sQuery = "
	SELECT FOUND_ROWS()
";
$rResultFilterTotal = executaQuery($sQuery);
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */

$sQuery = "
	SELECT COUNT(".$sIndexColumn.")
	FROM $cTable
"; 
$rResultTotal = executaQuery($sQuery);
$aResultTotal = mysqli_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];

/*
* Output
*/
$output = array(
	// "query" => $query,
	"sEcho" => intval($_GET['sEcho']),
	"iTotalRecords" => $iTotal,
	"iTotalDisplayRecords" => $iFilteredTotal,
	"aaData" => array()
);

while ( $aRow = mysqli_fetch_array( $rResult ) )
{
	$row = array();
	for ( $i=0 ; $i<count($namesColumns) ; $i++ )
	{
		if ( $namesColumns[$i] == "version" )
		{
			/* Special output formatting for 'version' column */
			$row[] = ($aRow[ $namesColumns[$i] ]=="0") ? '-' : $aRow[ $namesColumns[$i] ] ;
		}
		else if ( $namesColumns[$i] != ' ' )
		{
			/* General output */
			$row[] = $aRow[ $namesColumns[$i] ];
			
		}
	}
	$output['aaData'][] = $row;
}

echo json_encode( $output );
?>
