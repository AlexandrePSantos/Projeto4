<?php
//INCLUDE CONNECTION
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

$id_utilizador = $_SESSION['id_utilizador'];

$array_results = array();

$ano = date("Y");

//totals
$janTotal = 230 * 1;
$fevTotal = 230 * 2;
$marTotal = 230 * 3;
$abrTotal = 230 * 4;
$maiTotal = 230 * 5;
$junTotal = 230 * 6;
$julTotal = 230 * 7;
$agoTotal = 230 * 8;
$setTotal = 230 * 9;
$outTotal = 230 * 10;
$novTotal = 230 * 11;
$dezTotal = 230 * 12;
//---------------------------------------------------------------------------------------------------------------------------------------

//totals Received
$janTotalReceived = 30 * 1;
$fevTotalReceived = 30 * 2;
$marTotalReceived = 30 * 3;
$abrTotalReceived = 30 * 4;
$maiTotalReceived = 30 * 5;
$junTotalReceived = 30 * 6;
$julTotalReceived = 30 * 7;
$agoTotalReceived = 30 * 8;
$setTotalReceived = 30 * 9;
$outTotalReceived = 30 * 10;
$novTotalReceived = 30 * 11;
$dezTotalReceived = 30 * 12;
//---------------------------------------------------------------------------------------------------------------------------------------

//Print final totals
$array_results = array( 
	array("Meses", "Vendas (€)", "Compras (€)"), 
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

die(json_encode($array_results));
?>