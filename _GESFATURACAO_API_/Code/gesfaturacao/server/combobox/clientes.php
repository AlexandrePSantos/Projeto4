<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

$opcao = $_POST['opcao'];

$data = array();

switch ($opcao) {
	//Regions
	case 1:
		$query = "SELECT ID_Distrito, Nome FROM distrito";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($id, $nome);
			while ($stmt -> fetch()) {
				$data[] = array("id" => $id, "nome" => $nome);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "FTGA002";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));

		break;

	//Cities
	case 2:
		if( isset($_POST['regiao']) && $_POST['regiao'] > 0 ){
			$query = "SELECT ID_Concelho, Nome FROM concelho WHERE ID_Distrito = ".intval($_POST['regiao'])." ORDER BY Nome";
		}else{
			$query = "SELECT ID_Concelho, Nome FROM concelho ORDER BY Nome";
		}
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA003";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($id, $nome);
			while ($stmt -> fetch()) {
				$data[] = array("id" => $id, "nome" => $nome);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
				$response["type"] = "FTGA004";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;

	//Groups
	case 3:
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;

	case 4:
		//GET THE PROCESS --------------------------------------------------------
		$query = "SELECT ID_Metodo, Codigo, Descricao FROM faturacao_metodos_pagamento";
		if ( $stmt = $sqli_connection -> prepare($query) ) {
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
			    $id,
				$codigo,
				$descricao
			);
			while ($stmt -> fetch()) {
				$data[] = array('ID' => $id,'Codigo' => $codigo, 'Descricao' => $descricao);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "query";
			$response["line"] = "FATS002";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;

	//Motives
	case 5:
		$query = "SELECT ID_Motivo, Codigo, Descricao FROM faturacao_motivos_isencao WHERE Ativo=1 ORDER BY Codigo";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FATS007";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result(
			            $ID_Motivo,
						$Codigo,
						$Descricao
					);
			while ($stmt -> fetch()) {
				$data[] = array(
				    "ID_Motivo" => $ID_Motivo,
					"Codigo" => $Codigo,
					"Descricao" => $Descricao,
				);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "FATS008";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));

		break;
	
	//Cities home demo
	case 6:
		$id_freguesia = isset($_POST['localidade']) ? intval($_POST['localidade']) : 0;

		$query = "SELECT concelho.ID_Concelho, concelho.Nome FROM concelho, freguesia WHERE freguesia.ID_Concelho=concelho.ID_Concelho AND freguesia.ID_Freguesia=? ORDER BY Nome";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$stmt -> bind_param("d", $id_freguesia);
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA003";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($id, $nome);
			while ($stmt -> fetch()) {
				$data[] = array("id" => $id, "nome" => $nome);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
				$response["type"] = "FATS009";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;
	

	//Localities
	case 7:
		$query = "SELECT ID_Freguesia, Nome FROM freguesia ORDER BY Nome";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA003";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($id, $nome);
			while ($stmt -> fetch()) {
				$data[] = array("id" => $id, "nome" => $nome);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
				$response["type"] = "FATS010";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;
}
?>