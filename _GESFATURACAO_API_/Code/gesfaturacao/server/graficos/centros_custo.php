<?php
//INCLUDE CONNECTION
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';

$id_utilizador = $_SESSION['id_utilizador'];

$array_final = array( array('Categoria', 'Total (€)' ) );
$array_categorias = array();
$array_totais = array();

$dia = date("Y-m-d");
$mes = date("Y-m");
$ano = date("Y");
$totalHoje = 0;
$totalMes = 0;
$totalAno = 0;


//get sum centros custo
$array_categorias[0] = "Não Especificado";
$array_categorias[1] = "Centro Custo Vendas";

//start query

//get sum centros custo
$array_totais[0] = 1000;
$array_totais[0] = 230;

foreach ($array_totais as $key => $value) {
	if($key == 0) $array_final[] = array( "Não Especificado", $value+0 );
	else $array_final[] = array( $array_categorias[$key], $value+0 );
}
die(json_encode($array_final));
?>