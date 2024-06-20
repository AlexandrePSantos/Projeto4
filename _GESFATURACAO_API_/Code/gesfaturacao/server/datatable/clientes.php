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
	'CAST(Codigo AS UNSIGNED)',
	'CodigoInterno',
	'Nome',
	'Nif',
	'IF(Telemovel!="", Telemovel, Telefone)',
	'Email',
	'0',
	'CONCAT(CodigoPostal,", ",IFNULL(Localidade,""))',
	'0',
	'ID_Cliente',
	'Usado',
	'Ativo'
);

/* Column to filter*/
$fFilter = array(
	'CAST(Codigo AS UNSIGNED)',
	'CodigoInterno',
	'Nome',
	'Nif',
	'Telemovel',
	'Email',
	'0',
	'CONCAT(CodigoPostal,", ",IFNULL(Localidade,""))',
	'0',
	'ID_Cliente',
	'Usado',
	'Ativo',
	'Endereco'
);

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "faturacao_clientes.ID_Cliente";

/* DB table to use */
$sTable = "faturacao_clientes";

/*DB Table to count*/
$cTable = "faturacao_clientes";

/*LEFT JOIN Table*/
$sLeft="";

/*Join Table*/
$sJoin = "ID_Cliente > 0 AND Esquecer = 0 AND ID_Relacao IS NULL AND ID_UserAtual IS NULL AND DataAtualizacao IS NULL ";


include 'commun.php';
?>
