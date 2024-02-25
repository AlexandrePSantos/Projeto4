<?php
//INCLUDES
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

//RECEIVED VARS
$opcao = $_POST['opcao'];

//INIT VARS
$data = array();

// PROCESS OPTION
switch ($opcao) {
	//OBTEM ANOS FISCAIS
	case 1 :
		$query = "SELECT Ano FROM faturacao_ano_fiscal ORDER BY ANO DESC";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($ano_fiscal);
			while ($stmt -> fetch()) {
				$data[] = array("AnoFiscal" => $ano_fiscal);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}
		$response["errors"] = false;
		$response["type"] = "FTGA002";
		$response["data"] = $data;
		die(json_encode($response));

		break;

	//Clientes
	case 2:
		$query = "SELECT ID_Cliente, Nome, Nif FROM faturacao_clientes WHERE Esquecer=0 ORDER BY Nome";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA003";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($ID_Cliente, $Nome, $Nif );
			while ($stmt -> fetch()) {
				$data[] = array("ID_Cliente" => $ID_Cliente, "Nome" => $Nome, "Nif" => $Nif);
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

	//Fornecedores
	case 3:
		$query = "SELECT ID_Fornecedor, Nome, Nif FROM faturacao_fornecedores ORDER BY Nome";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA003";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($ID_Fornecedor, $Nome, $Nif );
			while ($stmt -> fetch()) {
				$data[] = array("ID_Fornecedor" => $ID_Fornecedor, "Nome" => $Nome, "Nif" => $Nif);
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

	//Articles Select2
	case 4:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';
		$conditionsOrder = '';

		//get default type of search
		$tP = '';
		$tp_tmp = 1;
		switch ($tp_tmp) {
			case 1: $tP = '%'; break;
			case 2: $tP = ''; break;

			default:break;
		}

		//process sorting
		$conditionsOrder = 'ORDER BY faturacao_artigos.Codigo';

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = $_POST['search_term'];
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( Codigo LIKE "'.$tP.$search_term.$tP.'" OR Nome LIKE "%'.$search_term.'%" OR CodigoBarras LIKE "'.$tP.$search_term.$tP.'" OR SerialNumber LIKE "'.$tP.$search_term.$tP.'" OR (SELECT Nome AS Categoria FROM faturacao_artigos_categorias WHERE faturacao_artigos_categorias.ID_Categoria = faturacao_artigos.ID_Categoria) LIKE "%'.$search_term.'%" )';
			}
		}
		//is id is set
		else if( isset($_POST['search_idarticle']) ){
			$search_idarticle = $_POST['search_idarticle'];
			if($search_idarticle != '' && $search_idarticle != null ){
				$searchIncluded .= ' OR ID_Artigo = '.$search_idarticle;
			}
		}

		if( isset($_POST['page']) ){
			$currPage = $_POST['page'] - 1;

			$prevLimit = $currPage * $stepSize;
			$nextLimit = ( $currPage * $stepSize ) + $stepSize;
			$limitRange = $prevLimit.",".$nextLimit;
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM faturacao_artigos WHERE Ativo = 1 ".$searchIncluded." ".$conditionsOrder." ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Artigo, Nome, Codigo, CodigoBarras, SerialNumber,
			(SELECT Nome AS Categoria FROM faturacao_artigos_categorias WHERE faturacao_artigos_categorias.ID_Categoria = faturacao_artigos.ID_Categoria),
			Tipo
			FROM faturacao_artigos WHERE Ativo = 1 ".$searchIncluded." ".$conditionsOrder." LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result(
			            $ID_Artigo,
						$Nome,
						$Codigo,
						$CodigoBarras,
						$SerialNumber,
						$Categoria,
						$Tipo
					);
			while ($stmt -> fetch()) {
				$data[$ID_Artigo] = array(
					"ID_Artigo" => $ID_Artigo,
					"Nome" => $Nome,
					"Codigo" => $Codigo,
					"CodigoBarras" => $CodigoBarras,
					"SerialNumber" => $SerialNumber,
					"Categoria" => $Categoria,
					"Tipo" => $Tipo
				);
			}
			$stmt -> close();
		} else {}

		//return final results
		// $response["query"] = $query;
		// $response["tp_tmp"] = $tp_tmp;
		// $response["tP"] = $tP;
		// $response["searchIncluded"] = $searchIncluded;
		$response["range"] = $limitRange;
		$response["results"] = $data;
		$response["count_filtered"] = $rowCounter;
		die(json_encode($response));

		break;

	//Clientes Select2
	case 5:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = $_POST['search_term'];
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( Nome LIKE "%'.$search_term.'%" OR Nif LIKE "%'.$search_term.'%" OR Codigo LIKE "%'.$search_term.'%" OR CodigoInterno LIKE "%'.$search_term.'%" OR Telefone LIKE "%'.$search_term.'%" OR Telemovel LIKE "%'.$search_term.'%" OR PreferenciaNome LIKE "%'.$search_term.'%" OR PreferenciaTelefone LIKE "%'.$search_term.'%" OR PreferenciaTelemovel LIKE "%'.$search_term.'%" OR Email LIKE "%'.$search_term.'%" OR PreferenciaEmail LIKE "%'.$search_term.'%" )';
			}
		}
		//is id is set
		elseif( isset($_POST['search_idcliente']) ){
			$search_idcliente = $_POST['search_idcliente'];
			if($search_idcliente != '' && $search_idcliente != null ){
				$searchIncluded .= ' OR ID_Cliente = '.$search_idcliente;
			}
		}

		if( isset($_POST['page']) ){
			$currPage = $_POST['page'] - 1;

			$prevLimit = $currPage * $stepSize;
			$nextLimit = ( $currPage * $stepSize ) + $stepSize;
			$limitRange = $prevLimit.",".$nextLimit;
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM faturacao_clientes WHERE Ativo = 1 ".$searchIncluded." ORDER BY Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Cliente, Nome, Nif, Codigo, CodigoInterno, PreferenciaNome FROM faturacao_clientes WHERE ID_UserAtual IS NULL AND ID_Relacao IS NULL AND DataAtualizacao IS NULL AND ID_Cliente > 0 ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result( $ID_Cliente, $Nome, $Nif, $Codigo, $CodigoInterno, $PreferenciaNome );
			while ($stmt -> fetch()) {
				$data[] = array(
					"ID_Cliente" => $ID_Cliente, "Nome" => $Nome, "Nif" => $Nif, "Codigo" => $Codigo, "CodigoInterno" => $CodigoInterno, "PreferenciaNome" => $PreferenciaNome
				);
			}
			$stmt -> close();
		} else {}

		//return final results
		// $response["query"] = $query;
		$response["range"] = $limitRange;
		$response["results"] = $data;
		$response["count_filtered"] = $rowCounter;
		die(json_encode($response));

		break;

	//Fornecedores Select2
	case 6:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = $_POST['search_term'];
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( Nome LIKE "%'.$search_term.'%" OR Nif LIKE "%'.$search_term.'%" OR Codigo LIKE "%'.$search_term.'%" OR Telefone LIKE "%'.$search_term.'%" OR Telemovel LIKE "%'.$search_term.'%" OR PreferenciaNome LIKE "%'.$search_term.'%" OR PreferenciaTelefone LIKE "%'.$search_term.'%" OR PreferenciaTelemovel LIKE "%'.$search_term.'%" OR Email LIKE "%'.$search_term.'%" OR PreferenciaEmail LIKE "%'.$search_term.'%" )';
			}
		}
		//is id is set
		elseif( isset($_POST['search_idfornecedor']) ){
			$search_idfornecedor = $_POST['search_idfornecedor'];
			if($search_idfornecedor != '' && $search_idfornecedor != null ){
				$searchIncluded .= ' OR ID_Fornecedor = '.$search_idfornecedor;
			}
		}

		if( isset($_POST['page']) ){
			$currPage = $_POST['page'] - 1;

			$prevLimit = $currPage * $stepSize;
			$nextLimit = ( $currPage * $stepSize ) + $stepSize;
			$limitRange = $prevLimit.",".$nextLimit;
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM faturacao_fornecedores WHERE Ativo = 1 ".$searchIncluded." ORDER BY Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Fornecedor, Nome, Nif, Codigo, PreferenciaNome FROM faturacao_fornecedores WHERE ID_Fornecedor > 0 ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result( $ID_Fornecedor, $Nome, $Nif, $Codigo, $PreferenciaNome );
			while ($stmt -> fetch()) {
				$data[$ID_Fornecedor] = array(
					"ID_Fornecedor" => $ID_Fornecedor, "Nome" => $Nome, "Nif" => $Nif, "Codigo" => $Codigo, "PreferenciaNome" => $PreferenciaNome
				);
			}
			$stmt -> close();
		} else {}

		//return final results
		// $response["query"] = $query;
		$response["range"] = $limitRange;
		$response["results"] = $data;
		$response["count_filtered"] = $rowCounter;
		die(json_encode($response));
		break;

	//Utilizadores Select2
	case 7:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = $_POST['search_term'];
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( Nome LIKE "%'.$search_term.'%" OR Username LIKE "%'.$search_term.'%" OR Email LIKE "%'.$search_term.'%" OR NumTocContabilista LIKE "%'.$search_term.'%" )';
			}
		}
		//is id is set
		elseif( isset($_POST['search_idutilizador']) ){
			$search_idutilizador = $_POST['search_idutilizador'];
			if($search_idutilizador != '' && $search_idutilizador != null ){
				$searchIncluded .= ' OR ID_Utilizador = '.$search_idutilizador;
			}
		}

		if( isset($_POST['page']) ){
			$currPage = $_POST['page'] - 1;

			$prevLimit = $currPage * $stepSize;
			$nextLimit = ( $currPage * $stepSize ) + $stepSize;
			$limitRange = $prevLimit.",".$nextLimit;
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM utilizador WHERE ID_TipoUtilizador > 1 AND (Contabilista = 1 OR UserSistema = 0) ".$searchIncluded." ORDER BY Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Utilizador, Nome, Username, Email, NumTocContabilista FROM utilizador WHERE ID_TipoUtilizador > 1 AND (Contabilista = 1 OR UserSistema = 0) ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result( $ID_Utilizador, $Nome, $Username, $Email, $NumTocContabilista );
			while ($stmt -> fetch()) {
				$data[] = array(
					"id_utilizador" => $ID_Utilizador, "nome" => $Nome, "email" => $Email, "num_toc_contabilista" => $NumTocContabilista
				);
			}
			$stmt -> close();
		} else {}

		//return final results
		$response["query"] = $query;
		$response["range"] = $limitRange;
		$response["results"] = $data;
		$response["count_filtered"] = $rowCounter;
		die(json_encode($response));

		break;

	case 8:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = $_POST['search_term'];
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( Nome LIKE "%'.$search_term.'%" )';
			}
		}

		if( isset($_POST['page']) ){
			$currPage = $_POST['page'] - 1;

			$prevLimit = $currPage * $stepSize;
			$nextLimit = ( $currPage * $stepSize ) + $stepSize;
			$limitRange = $prevLimit.",".$nextLimit;
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM faturacao_artigos_categorias WHERE Ativo = 1 ".$searchIncluded." ORDER BY Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Categoria, Nome FROM faturacao_artigos_categorias WHERE Ativo = 1 AND ID_Categoria > 0 ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result( $ID_Categoria, $Nome );
			while ($stmt -> fetch()) {
				$data[] = array(
					"ID_Categoria" => $ID_Categoria, "Nome" => $Nome
				);
			}
			$stmt -> close();
		} else {}

		//return final results
		// $response["query"] = $query;
		$response["range"] = $limitRange;
		$response["results"] = $data;
		$response["count_filtered"] = $rowCounter;
		die(json_encode($response));
		break;
	case 9:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = $_POST['search_term'];
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( Nome LIKE "%'.$search_term.'%" )';
			}
		}

		if( isset($_POST['page']) ){
			$currPage = $_POST['page'] - 1;

			$prevLimit = $currPage * $stepSize;
			$nextLimit = ( $currPage * $stepSize ) + $stepSize;
			$limitRange = $prevLimit.",".$nextLimit;
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM faturacao_series WHERE Ativo = 1 ".$searchIncluded." ORDER BY Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Serie, Nome FROM faturacao_series WHERE Ativo = 1 AND ID_Serie > 0 ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result( $ID_Serie, $Nome );
			while ($stmt -> fetch()) {
				$data[] = array(
					"ID_Serie" => $ID_Serie, "Nome" => $Nome
				);
			}
			$stmt -> close();
		} else {}

		//return final results
		// $response["query"] = $query;
		$response["range"] = $limitRange;
		$response["results"] = $data;
		$response["count_filtered"] = $rowCounter;
		die(json_encode($response));
		break;
	case 10:
		$data = array();
		$query = "SELECT ID_Categoria, Nome FROM faturacao_artigos_categorias ORDER BY faturacao_artigos_categorias.Nome";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA031";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($ID_Categoria, $Nome);
			while ($stmt -> fetch()) {
				$data[] = array("ID_Categoria" => $ID_Categoria, "Nome" => $Nome);
			}
			$stmt -> close();
		} else {
			$response["errors"] = true;
			$response["type"] = "FTGA032";
			$response["message"] = $sqli_connection -> error;
			die(json_encode($response));
		}

		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;
}
?>
