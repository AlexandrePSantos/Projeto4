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

	//Clientes Select2
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
				$searchIncluded = ' AND ( LOWER(Nome) LIKE "%'.$search_term.'%" OR LOWER(Nif) LIKE "%'.$search_term.'%" OR LOWER(Codigo) LIKE "%'.$search_term.'%" OR LOWER(CodigoInterno) LIKE "%'.$search_term.'%" OR LOWER(Telefone) LIKE "%'.$search_term.'%" OR LOWER(Telemovel) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaNome) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaTelefone) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaTelemovel) LIKE "%'.$search_term.'%" OR LOWER(Email) LIKE "%'.$search_term.'%" OR LOWER(PreferenciaEmail) LIKE "%'.$search_term.'%" OR LOWER(ObservacoesCliente) LIKE "%'.$search_term.'%" )';
			}
		}
		//is id is set
		elseif( isset($_POST['search_idcliente']) ){
			$search_idcliente = intval($_POST['search_idcliente']);
			if($search_idcliente != '' && $search_idcliente != null ){
				$searchIncluded .= ' OR ID_Cliente = '.$search_idcliente;
			}
		}

		if( isset($_POST['page']) ){
			$currPage = intval($_POST['page']) - 1;

			$prevLimit = $currPage * $stepSize;
			$nextLimit = ( $currPage * $stepSize ) + $stepSize;
			$limitRange = $prevLimit.",".$nextLimit;
		}

		if( isset($_POST['all_records']) ){
			$activeState = ' 1 = 1 ';
		}

		//getFiltered items totals
		$queryCount = "SELECT COUNT(*)
			FROM faturacao_clientes WHERE ".$activeState." ".$searchIncluded." ORDER BY Nome ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT ID_Cliente, Nome, Nif, Codigo, CodigoInterno, PreferenciaNome FROM faturacao_clientes WHERE ".$activeState." ".$searchIncluded." ORDER BY Nome LIMIT ".$limitRange." ";
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
			FROM faturacao_clientes WHERE Ativo = 1 ".$searchIncluded." ORDER BY Nome ";
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

	//Avencas Select2
	case 4:
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
				$searchIncluded = ' AND ( DescricaoAvenca LIKE "%'.$search_term.'%" OR Data LIKE "%'.$search_term.'%" OR RepeticaoAvenca LIKE "%'.$search_term.'%" OR DiaFaturacaoSemanal LIKE "%'.$search_term.'%" OR DiaFaturacaoMensal LIKE "%'.$search_term.'%" )';
			}
		}
		//is id is set
		else if( isset($_POST['search_idavenca']) ){
			$search_idavenca = $_POST['search_idavenca'];
			if($search_idavenca != '' && $search_idavenca != null && $search_idavenca > 0 ){
				$searchIncluded .= ' OR ID_Avenca = '.$search_idavenca;
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
			FROM faturacao_avencas WHERE Estado IN ('Aberto') AND AvencaAtiva=1 ".$searchIncluded." ORDER BY InvoiceStatusDate DESC ";
		if ($stmtCount = $sqli_connection -> prepare($queryCount)) {
			$result = $stmtCount -> execute();
			if (false === $result) {}
			$stmtCount -> bind_result( $rowCounter );
			$stmtCount -> fetch();
			$stmtCount -> close();
		} else {}

		//getFiltered items
		$query = "SELECT DescricaoAvenca, 
			Data, 
			RepeticaoAvenca, 
			DiaFaturacaoSemanal, 
			DiaFaturacaoMensal, 
			GrossTotal, 
			FinalizarAvenca, 
			ID_Avenca, 
			ID_Cliente,
			(SELECT Nome FROM faturacao_clientes WHERE faturacao_clientes.ID_Cliente = faturacao_avencas.ID_Cliente) AS NomeCliente, 
			(SELECT Nif FROM faturacao_clientes WHERE faturacao_clientes.ID_Cliente = faturacao_avencas.ID_Cliente) AS NifCliente
			FROM faturacao_avencas WHERE Estado IN ('Aberto') AND AvencaAtiva=1 ".$searchIncluded." ORDER BY InvoiceStatusDate DESC LIMIT ".$limitRange." ";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {}
			$stmt -> bind_result(
				$descAvenca,
				$dataAvenca,
				$periodicidade,
				$diaFaturacaoSemanal,
				$diaFaturacaoMensal,
				$valorTotal,
				$finalizarAvenca,
				$id_document,
				$id_cliente ,
				$NomeCliente ,
				$NifCliente
			);
			while ($stmt -> fetch()) {
				//prepare some vars
				$PeriodicidadeLabel = ucfirst($periodicidade);
				switch ($periodicidade) {
					case 'diaria':
						$PeriodicidadeLabel = 'Diária';
						break;
					case 'semanal':
						$PeriodicidadeLabel = 'Semanal - '.$diaFaturacaoSemanal;
						break;
					case 'mensal':
						$PeriodicidadeLabel = 'Mensal - '.$diaFaturacaoMensal;
						break;
					default:break;
				}

				$FinalizarAvencaLabel = $finalizarAvenca==1 ? 'Sim' : 'Não';

				$ValorLabel = number_format($valorTotal,2, ',', '.').'€';

				$data[$id_document] = array(
					"DescricaoAvenca" => $descAvenca,
					"Data" => $dataAvenca,
					"Periodicidade" => $periodicidade,
					"DiaFaturacaoSemanal" => $diaFaturacaoSemanal,
					"DiaFaturacaoMensal" => $diaFaturacaoMensal,
					"Valor" => $valorTotal,
					"FinalizarAvenca" => $finalizarAvenca,
					"ID_Document" => $id_document,
					"idCliente" => $id_cliente,
					"NomeCliente" => $NomeCliente,
					"NifCliente" => $NifCliente,
					"PeriodicidadeLabel" => $PeriodicidadeLabel,
					"FinalizarAvencaLabel" => $FinalizarAvencaLabel,
					"ValorLabel" => $ValorLabel,
					"LabelField" => $descAvenca." | ".$dataAvenca." | ".$PeriodicidadeLabel." | Finalizar: ".$FinalizarAvencaLabel." | Valor: ".$ValorLabel
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

	//GET ENTERPRISE DATA
	case 5:
		//get enterprise data
		$query = "SELECT CONCAT(Endereco1, ' ', Endereco2) AS Endereco, CodigoPostal, (SELECT concelho.Nome FROM concelho WHERE concelho.ID_Concelho=faturacao_empresa_dados.Cidade) AS Cidade, (SELECT distrito.Nome FROM distrito, concelho WHERE distrito.ID_Distrito=concelho.ID_Distrito AND concelho.ID_Concelho=faturacao_empresa_dados.Cidade) AS Regiao FROM faturacao_empresa_dados LIMIT 1";
		if ($stmt = $sqli_connection -> prepare($query)) {
			$result = $stmt -> execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["type"] = "FTGA001";
				$response["message"] = $stmt -> error;
				die(json_encode($response));
			}
			$stmt -> bind_result($Endereco, $CodigoPostal, $Cidade, $Regiao );
			while ($stmt -> fetch()) {
				$data = array("Endereco" => $Endereco, "CodigoPostal" => $CodigoPostal, "Cidade" => $Cidade, "Regiao" => $Regiao, "Pais" => 'PT');
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

	//CHECK AVAILABLE STOCKS - USING ARTICLE LINES
	case 6:
		//get post vars
		$articlesLines = json_decode($_POST['linhas'], true);

		//init some vars
		$stockWarnings = array();

		if(is_array($articlesLines) && !empty($articlesLines)){
			$stockWarnings = checkMinStockBeforeConfirm($articlesLines);
		}

		//response data
		$response["errors"] = false;
		$response["stockWarnings"] = json_encode($stockWarnings);
		// $response["articlesLines"] = $articlesLines;
		die(json_encode($response));
		break;

	//CHECK AVAILABLE STOCKS - USING DOCUMENT ID
	case 7:
		//get post vars
		$documento = $_POST['id_documento'];
		$tipo = $_POST['tipo_documento'];

		//init some vars
		$stockWarnings = array();
		$tableName = '';
		$fieldId = '';

		//process type
		switch ($tipo) {
			case 'FT':
				$tableName = 'faturacao_faturas';
				$fieldId = 'ID_Fatura';
				break;
			case 'FS':
				$tableName = 'faturacao_faturas_simplificadas';
				$fieldId = 'ID_FaturaSimplificada';
				break;
			case 'FR':
				$tableName = 'faturacao_faturas_recibo';
				$fieldId = 'ID_FaturaRecibo';
				break;
			case 'NC':
				$tableName = 'faturacao_notas_credito';
				$fieldId = 'ID_NotaCredito';
				break;
			case 'ND':
				$tableName = 'faturacao_notas_debito';
				$fieldId = 'ID_NotaDebito';
				break;
			case 'FTC':
				$tableName = 'faturacao_compras';
				$fieldId = 'ID_Compra';
				break;
			case 'NCC':
				$tableName = 'faturacao_compras_notas_credito';
				$fieldId = 'ID_NotaCreditoCompra';
				break;

			default:
				$response["errors"] = false;
				$response["stockWarnings"] = json_encode($stockWarnings);
				die(json_encode($response));
				break;
		}

		if($documento || !empty($articlesLines)){
			$stockWarnings = checkMinStock($documento, $tableName, $fieldId);
		}

		//response data
		$response["errors"] = false;
		$response["stockWarnings"] = json_encode($stockWarnings);
		die(json_encode($response));
		break;

	//ALL CLIENTS
	case 8:
		$query = "SELECT ID_Cliente, Nome, Nif, Codigo, CodigoInterno, PreferenciaNome FROM faturacao_clientes WHERE Ativo = 1 ORDER BY Nome";
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
		$response["errors"] = false;
		$response["data"] = $data;
		die(json_encode($response));
		break;
}

?>
