<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

//Init some vars
$opcao = $_POST['opcao'];
$data = array();

switch ($opcao) {
	//OBTEM CATEGORIAS
	case 1 :
		if (isset($_POST['idCategoria'])) {
			$query = "SELECT ID_Categoria, Nome FROM faturacao_artigos_categorias WHERE Ativo = 1 OR ID_Categoria = " . $_POST['idCategoria'];
		} else {
			$query = "SELECT ID_Categoria, Nome FROM faturacao_artigos_categorias WHERE Ativo = 1";
		}
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($id, $nome);
			while ($stmt->fetch()) {
				$data[] = array("id" => $id, "nome" => $nome);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));

		break;

	//OBTEM IMPOSTOS
	case 2 :
		if (isset($_POST['idImposto'])) {
			$query = "SELECT ID_Imposto, Nome, Descricao, Valor, Predefinido, Regiao FROM faturacao_impostos WHERE Ativo = 1 OR ID_Imposto = " . intval($_POST['idImposto']) . " ORDER BY Regiao ASC, CAST(Valor AS UNSIGNED) DESC, Nome ASC;";
		} else {
			$query = "SELECT ID_Imposto, Nome, Descricao, Valor, Predefinido, Regiao FROM faturacao_impostos WHERE Ativo = 1 ORDER BY Regiao ASC, CAST(Valor AS UNSIGNED) DESC, Nome ASC;";
		}
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($id, $nome, $descricao, $taxa, $predefinido, $Regiao);
			while ($stmt->fetch()) {
				$data[] = array(
					"id" => $id, 
					"nome" => $nome, 
					"descricao" => $descricao, 
					'taxa' => $taxa, 
					'predefinido' => $predefinido,
					"Regiao" => $Regiao,
					"RegiaoLabel" => getCountryByISO2($Regiao),
				);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));

		break;

	//OBTEM UNIDADES
	case 3 :
		$query = "SELECT ID_Unidade, Descricao FROM faturacao_unidades WHERE Ativo = 1 ORDER BY ID_Unidade";
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($id, $nome);
			while ($stmt->fetch()) {
				$data[] = array("id" => $id, "nome" => $nome);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));

		break;

	//OBTEM IMPOSTOS
	case 4 :
		$idPredefinido = 0;

		$query = "SELECT ID_Motivo, Codigo, Descricao FROM faturacao_motivos_isencao WHERE Ativo=1 ORDER BY Codigo";
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA004";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($id, $codigo, $descricao);
			while ($stmt->fetch()) {
				$data[] = array("ID_Motivo" => $id, "Codigo" => $codigo, "Descricao" => $descricao);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}

		$idPredefinido = 18;

		$response["errors"] = false;
		$response["data"] = $data;
		$response["idPredefinido"] = $idPredefinido;
		die(json_encode($response));

		break;

	//OBTEM DETALHES
	case 5 :
		if (isset($_POST['idArtigo'])) {
			$query = "SELECT ID_Artigo, Nome, Codigo, CodigoBarras, SerialNumber,
			(SELECT Nome AS Categoria FROM faturacao_artigos_categorias WHERE faturacao_artigos_categorias.ID_Categoria = faturacao_artigos.ID_Categoria),
			Tipo, ID_Imposto, id_motivo_isencao
			FROM faturacao_artigos WHERE ID_Artigo = " . $_POST['idArtigo'];
		} else {
			$query = "SELECT ID_Artigo, Nome, Codigo, CodigoBarras, SerialNumber,
			(SELECT Nome AS Categoria FROM faturacao_artigos_categorias WHERE faturacao_artigos_categorias.ID_Categoria = faturacao_artigos.ID_Categoria),
			Tipo, ID_Imposto, id_motivo_isencao
			FROM faturacao_artigos WHERE ID_Artigo = 0";
		}
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($ID_Artigo, $Nome, $Codigo, $CodigoBarras, $SerialNumber, $Categoria, $Tipo, $ID_Imposto, $id_motivo_isencao);
			while ($stmt->fetch()) {
				$data = array(
					"idArtigo" => $ID_Artigo,
					"artigo" => $ID_Artigo,
					"descricao" => $Nome,
					"codigo" => $Codigo,
					"codigobarras" => $CodigoBarras,
					"serialnumber" => $SerialNumber,
					"categoria" => $Categoria,
					"Tipo" => $Tipo,
					"impostoID" => $ID_Imposto,
					"motivoID" => $id_motivo_isencao,
					"NextID" => $Codigo + 1,
				);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));

		break;

	//GET CUSTOM PRICES
	case 6 :
		$query = "SELECT ID_Imposto, Nome, Valor, Predefinido, Subclasse, Regiao FROM faturacao_impostos WHERE Ativo = 1 ORDER BY Regiao ASC, CAST(Valor AS UNSIGNED) DESC, Nome ASC; ";
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result(
				$ID_Imposto,
				$Nome,
				$Valor,
				$Predefinido,
				$Subclasse,
				$Regiao
			);
			while ($stmt->fetch()) {
				$data[] = array(
					"ID_Imposto" => $ID_Imposto,
					"Nome" => $Nome,
					"Valor" => $Valor,
					"Predefinido" => $Predefinido,
					"Subclasse" => $Subclasse,
					"Regiao" => $Regiao,
					"RegiaoLabel" => getCountryByISO2($Regiao),
				);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["type"] = "FTGA002";
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}

		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;

	//OBTEM postos
	case 7 :
		$query = "SELECT ID_Posto,Nome FROM faturacao_postos";
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($id, $nome);
			while ($stmt->fetch()) {
				$data[] = array("id" => $id, "nome" => $nome);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));

		break;

	case 8 :
		$query = "SELECT ID_Posto FROM faturacao_postos_artigos WHERE ID_Artigo = ? ";
		if ($stmt = $sqli_connection->prepare($query)) {
			$stmt->bind_param("d", $_POST['idArtigo']);
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($id);
			while ($stmt->fetch()) {
				$data[] = array("id" => $id);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;
	case 9 :
		$data = array("alertaStockMinimo" => 0);
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;
	case 10:
		$query = "SELECT ID_Fornecedor,Nome,Nif FROM faturacao_fornecedores WHERE Ativo = 1";
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt->error;
				die(json_encode($response));
			}
			$stmt->bind_result($id, $nome,$nif);
			while ($stmt->fetch()) {
				$data[] = array("ID_Fornecedor" => $id, "Nome" => $nome,  "Nif" => $nif);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;
}
?>
