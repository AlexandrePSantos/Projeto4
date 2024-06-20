<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";

$conexao = $sqli_connection;

function executaQuery($query) {
	global $conexao;
	$resultado = $conexao -> query($query);
	return $resultado;
}
