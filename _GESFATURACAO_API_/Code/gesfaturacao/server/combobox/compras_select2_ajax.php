<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";

//Get Post Vars
$opcao = $_POST['opcao'];
$data = array();

//Process selected choice
switch ($opcao) {
	//Articles Select2
	case 1:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';
		$idStock = null;
		$idArmazem = null;

		//get default type of search
		$tP = '';
		$tp_tmp = 1;
		switch ($tp_tmp) {
			case 1: $tP = '%'; break;
			case 2: $tP = ''; break;
			
			default:break;
		}

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = $_POST['search_term'];
			$search_term_lower = mb_strtolower($_POST['search_term']);
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( faturacao_artigos.Codigo LIKE "'.$tP.$search_term.$tP.'" OR LOWER(faturacao_artigos.Nome) LIKE "%'.$search_term_lower.'%" OR faturacao_artigos.CodigoBarras LIKE "'.$tP.$search_term.$tP.'" OR faturacao_artigos.SerialNumber LIKE "'.$tP.$search_term.$tP.'" OR LOWER(faturacao_artigos_categorias.Nome) LIKE "%'.$search_term_lower.'%" OR LOWER(CBarras.listCBarras) LIKE "%'.$search_term_lower.'%" )';
			}
		}
		//is id is set
		else if( isset($_POST['search_idarticle']) ){
			$search_idarticle = intval($_POST['search_idarticle']);
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
		FROM faturacao_artigos 
			LEFT JOIN faturacao_artigos_categorias ON faturacao_artigos_categorias.ID_Categoria = faturacao_artigos.ID_Categoria
			LEFT JOIN (SELECT ID_Artigo, GROUP_CONCAT(CodigoBarras) as listCBarras FROM faturacao_artigos_codigo_barras GROUP BY ID_Artigo) AS CBarras ON CBarras.ID_Artigo = faturacao_artigos.ID_Artigo 
		WHERE faturacao_artigos.Ativo = 1 ".$searchIncluded." ORDER BY faturacao_artigos.Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT faturacao_artigos.ID_Artigo,
		faturacao_artigos.Nome, 
		faturacao_artigos.Codigo, 
		CBarras.listCBarras, 
		faturacao_artigos.SerialNumber,
		faturacao_artigos_categorias.Nome AS Categoria,
		faturacao_artigos.Tipo,
		faturacao_artigos.Stock
		FROM faturacao_artigos 
			LEFT JOIN faturacao_artigos_categorias ON faturacao_artigos_categorias.ID_Categoria = faturacao_artigos.ID_Categoria
			LEFT JOIN (SELECT ID_Artigo, GROUP_CONCAT(CodigoBarras) as listCBarras FROM faturacao_artigos_codigo_barras GROUP BY ID_Artigo) AS CBarras ON CBarras.ID_Artigo = faturacao_artigos.ID_Artigo
		WHERE faturacao_artigos.Ativo = 1 ".$searchIncluded." ORDER BY faturacao_artigos.Nome LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result(
				$ID_Artigo,
				$Nome,
				$Codigo,
				$CodigosBarras,
				$SerialNumber,
				$Categoria,
				$Tipo,
				$Stock
			);
			while ($stmt -> fetch()) {
				$data[$ID_Artigo] = array(
					"ID_Artigo" => $ID_Artigo,
					"Nome" => $Nome,
					"Codigo" => $Codigo,
					"CodigoBarras" => $CodigosBarras,
					"SerialNumber" => $SerialNumber,
					"Categoria" => $Categoria,
					"Tipo" => $Tipo,
					"Stock" => $Stock,
					"idStock" => $idStock,
					"idArmazem" => $idArmazem
				);
			}
			$stmt -> close();
		} else {}

		//return final results
		// $response["query"] = str_replace("\n\r", "", $query);
		// $response["queryCounter"] = str_replace("\n\r", "", $queryCount);
		// $response["tp_tmp"] = $tp_tmp;
		// $response["tP"] = $tP;
		// $response["searchIncluded"] = $searchIncluded;
		$response["range"] = $limitRange;
		$response["results"] = $data;
		$response["count_filtered"] = $rowCounter;		
		die(json_encode($response));
		break;

	//Fornecedores Select2
	case 2:
		//init vars
		$rowCounter = 0;
		$data = array();
		$stepSize = 25;
		$limitRange = '0,25';
		$searchIncluded = '';
		$activeState = ' Ativo = 1 ';

		//prepare search if necessary
		if( isset($_POST['search_term']) ){
			$search_term = mb_strtolower($_POST['search_term']);
			if($search_term != '' && $search_term != null ){
				$searchIncluded = ' AND ( LOWER(Nome) LIKE "%'.$search_term.'%" OR LOWER(Nif) LIKE "%'.$search_term.'%" OR LOWER(Codigo) LIKE "%'.$search_term.'%" OR LOWER(Telefone) LIKE "%'.$search_term.'%" OR LOWER(Telemovel) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaNome) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaTelefone) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaTelemovel) LIKE "%'.$search_term.'%" OR LOWER(Email) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaEmail) LIKE "%'.$search_term.'%" OR LOWER(ObservacoesFornecedor) LIKE "%'.$search_term.'%" )';
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

		if( isset($_POST['all_records']) ){
			$activeState = ' 1 = 1 ';
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM faturacao_fornecedores WHERE ".$activeState." ".$searchIncluded." ORDER BY Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Fornecedor, Nome, Nif, Codigo, PreferenciaNome FROM faturacao_fornecedores WHERE ".$activeState." ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
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

	//Centros Custo Select2
	case 3:
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
				$searchIncluded = ' AND ( Nome LIKE "%'.$search_term.'%" OR Descricao LIKE "%'.$search_term.'%" )';
			}
		}
		//is id is set
		elseif( isset($_POST['search_idcenter']) ){
			$search_idcenter = $_POST['search_idcenter'];
			if($search_idcenter != '' && $search_idcenter != null ){
				$searchIncluded .= ' OR ID_CentroCusto = '.$search_idcenter;
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
		$data[0] = array(
			"ID_CentroCusto" => 0, "Nome" => 'Não Especificado', "Descricao" => null
		);
		$query = "SELECT ID_CentroCusto, Nome, Descricao FROM faturacao_centros_custo WHERE Ativo = 1 ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result( $ID_CentroCusto, $Nome, $Descricao );
			while ($stmt -> fetch()) {
				$data[$ID_CentroCusto] = array(
					"ID_CentroCusto" => $ID_CentroCusto, "Nome" => $Nome, "Descricao" => $Descricao
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
}

?>