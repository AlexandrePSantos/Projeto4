<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo_gesfaturacao.php";
/*Control user*/
/*
 * Script:	DataTables server-side script for PHP and MySQL
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
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
	'ID_Registo',
	'STR_TO_DATE( Data,  "%d/%m/%Y %H:%i:%s" )', 
	'Acao', 
	'Ref_Doc_Associado',
	'NomeUtilizador',
	'StockAnterior',
	'StockPosterior',
	'CASE AcertoStock WHEN "1" THEN 0 ELSE (StockPosterior - StockAnterior) END',
	'ID_Registo',
	'AcertoStock',
);

/* Column to filter*/
$fFilter = array(
	'ID_Registo',
	'Data', 
	'Acao', 
	'Ref_Doc_Associado',
	'NomeUtilizador',
	'StockAnterior',
	'StockPosterior',
	'CASE AcertoStock WHEN "1" THEN 0 ELSE (StockPosterior - StockAnterior) END',
	'ID_Registo',
	'AcertoStock',
);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "faturacao_artigos_registos.ID_Registo";

/* DB table to use */
$sTable = "faturacao_artigos_registos";

/*DB Table to count*/
$cTable = "faturacao_artigos_registos";

/*LEFT JOIN Table*/
$sLeft="";

/*Join Table*/
$sJoin = "ID_Registo > 0";

if( isset($_GET['artigo']) && $_GET['artigo'] > 0) $sJoin .= " AND ID_Artigo = ". intval($_GET['artigo']);
else $sJoin .= " AND ID_Artigo = 0";


include 'commun.php';
?>