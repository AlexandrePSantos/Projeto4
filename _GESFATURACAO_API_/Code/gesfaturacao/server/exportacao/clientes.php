<?php
	//INCLUDE CONNECTION AND GLOBAL VARS ------------------------------------
	include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/importacao/PHPExcel.php";

	try {
		// Turn off AUTOCOMMIT and begin Transaction
		mysqli_autocommit($sqli_connection, FALSE);
		$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

		//log sistema - processo
		$descricao_log = "Impressão de documento: Mapa de Clientes";
		insert_log(14, "Editar", $descricao_log, $sqli_connection);

		//registar exportacao
		insertDocumentoExportado('MAPA-CLIENTES', $data_inicio, $data_fim, $sqli_connection);

		/**
		 * |---------------------------------------------------------------------------
		 * |    Informações Globais
		 * | ------------------------
		 * |
		 * | @Tamanho da Page PDF - 267 Horizontal
		 * | @Tamanho da Page PDF - 160 Vertical
		 * | MultiCell -> $width, $height, $txt, $border=0, $align='J/R/L/C', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false
		 * | Line -> $x1, $y1, $x2, $y2, $style=array()
		 * |---------------------------------------------------------------------------
		 */

		//COMPANY $GLOBALS['Designacao'] = "GESFaturação";
		$GLOBALS['Nif'] = "999999990";
		$GLOBALS['RegistoComercial'] = "123456789";
		$GLOBALS['Endereco1'] = "Rua de Exemplo Nº 80";
		$GLOBALS['Endereco2'] = "Fração L";
		$GLOBALS['CodigoPostal'] = "4935-124";
		$GLOBALS['Cidade'] = "Viana do Castelo";
		$GLOBALS['Email'] = "email@empresa.pt";
		$GLOBALS['Website'] = "https://gesfaturacao.pt";
		$GLOBALS['CapitalSocial'] = "5000";
		$GLOBALS['Conservatoria'] = "Registo Civil de Ponte de Lima";
		$GLOBALS['Telefone'] = "258 938 493";
		$GLOBALS['Fax'] = "";
		$GLOBALS['Logotipo'] = "logo_default.png";
		$GLOBALS['NormaContabilistica'] = "S";
		$GLOBALS['CAE_Principal'] = "05012";
		$GLOBALS['CustoTipoContacto'] = 2;


		$documentos = array();
		$query = "SELECT ID_Cliente, Nome, Nif, Codigo, Endereco, (CONCAT(CodigoPostal, ' ', Cidade, ', ', Pais)), Email, IF(Telemovel!='', Telemovel, Telefone), 
		IF(Usado=1,'Sim','Não'), 0 AS Account,
		ObservacoesCliente
		FROM faturacao_clientes WHERE Esquecer=0 ORDER BY Nome ASC";
		if ($stmt = $sqli_connection->prepare($query)) {
			$result = $stmt->execute();
			if (false === $result) {
				$response["errors"] = true;
				$response["message"] = $stmt->error;
				$sqli_connection->rollback();
				die(json_encode($response));
			}
			$stmt->store_result();
			$stmt->bind_result($idCliente, $nome, $contribuinte, $codigo, $endereco1, $endereco2, $email, $telemovel, $usado, $planoContas, $observacoes);
			while ($stmt->fetch()) {
				$documentos[] = array(
					"ID_Cliente" => $idCliente,
					"Nome" => $nome,
					"Nif" => $contribuinte,
					"Codigo" => $codigo,
					"Endereco1" => $endereco1,
					"Endereco2" => $endereco2,
					"Email" => $email,
					"Contacto" => $telemovel,
					"Usado" => $usado,
					"Conta" => $planoContas,
					"Observacoes" => $observacoes
				);
			}
			$stmt->close();
		} else {
			$response["errors"] = true;
			$response["message"] = $sqli_connection->error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}

		$sqli_connection->commit();
	} catch (Exception $e) {
		$response["errors"] = true;
		$response["message"] = $sqli_connection->error;
		$response["type"] = "transaction";
		$sqli_connection->rollback();
		die(json_encode($response));
	}

	function fillTable($objPHPExcel, $element, $line)
	{
		global $styleAlginLeft;

		$objPHPExcel->getActiveSheet()->setCellValue('A' . $line, $element['Codigo'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('B' . $line, $element['Nome'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $line, $element['Nif'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $line, $element['Contacto'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $line, $element['Email'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $line, $element['Endereco1'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('G' . $line, $element['Endereco2'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('H' . $line, $element['Usado'], PHPExcel_Cell_DataType::TYPE_STRING);
		$objPHPExcel->getActiveSheet()->setCellValue('I' . $line, $element['Observacoes'], PHPExcel_Cell_DataType::TYPE_STRING);

		$objPHPExcel->getActiveSheet()->getStyle("B" . $line . ":I" . $line)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle("A" . $line . ":I" . $line)->applyFromArray($styleAlginLeft);
	}

	$filename = "MAPA_CLIENTES";
	$table = $documentos;
	$type = 'clientes';
	$tile = 'Mapa de Clientes';
	$names = ['Código', 'Nome', 'NIF', 'Contacto', 'Email', 'Endereço', 'Código Postal, Cidade, País', 'Usado', 'Observações'];
	$columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
	$alignment = ['L', 'L', 'L', 'L', 'L', 'L', 'L', 'L', 'L'];
	$widths = [12, 40, 20, 20, 30, 40, 40, 10, 45];

	/**
	 * |----------------------------------------------------
	 * |                Dynamic Excel Generator
	 * |----------------------------------------------------
	 */
	//6 rows fixed values
	$heights = [20, 10, 15, 10, 20, 10];

	//START PROCESSING EXCEL
	$objPHPExcel = new PHPExcel();

	$lastCol = end($columns);
	$firstCol = $columns[0];
	//SET HEADER
	$firstSheetLine = 'Emitido em: ' . date('d/m/Y H:i:s') . ' | Por: ' . $GLOBALS['Designacao'] . '. - NIF: ' . $GLOBALS['Nif'];
	$objPHPExcel->getActiveSheet()->mergeCells("{$firstCol}1:{$lastCol}1")->setCellValue("{$firstCol}1", $firstSheetLine);
	$objPHPExcel->getActiveSheet()->mergeCells("{$firstCol}2:{$lastCol}2")->setCellValue("{$firstCol}2", '');

	$secondSheetLine = "{$tile}";
	$objPHPExcel->getActiveSheet()->mergeCells("{$firstCol}3:{$lastCol}3")->setCellValue("{$firstCol}3", $secondSheetLine);
	$objPHPExcel->getActiveSheet()->mergeCells("{$firstCol}4:{$lastCol}4")->setCellValue("{$firstCol}4", '');

	$styleHeader = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
				'color' => array('rgb' => '000000')
			)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);
	$objPHPExcel->getActiveSheet()->getStyle("{$firstCol}1:{$lastCol}1")->applyFromArray($styleHeader);
	$objPHPExcel->getActiveSheet()->getStyle("{$firstCol}1:{$lastCol}1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE0E0E0');
	$objPHPExcel->getActiveSheet()->getStyle("{$firstCol}3:{$lastCol}3")->applyFromArray($styleHeader);
	$objPHPExcel->getActiveSheet()->getStyle("{$firstCol}3:{$lastCol}3")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE0E0E0');

	//SET DOCS HEADER LINE
	foreach ($names as $key => $name) {
		$objPHPExcel->getActiveSheet()->setCellValue("{$columns[$key]}5", $name);
	}

	$styleDocHeaderLeft = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('rgb' => '000000')
			)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);
	$styleDocHeaderRight = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('rgb' => '000000')
			)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);

	$styleAlginLeft = array(
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);
	$styleAlginRight = array(
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);

	foreach ($alignment as $key => $align) {
		if ($align === 'L') {
			$objPHPExcel->getActiveSheet()->getStyle("{$columns[$key]}5:{$columns[$key]}5")->applyFromArray($styleDocHeaderLeft);
		} else {
			$objPHPExcel->getActiveSheet()->getStyle("{$columns[$key]}5:{$columns[$key]}5")->applyFromArray($styleDocHeaderRight);
		}
	}

	$objPHPExcel->getActiveSheet()->getStyle("{$firstCol}5:{$lastCol}5")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE0E0E0');

	$objPHPExcel->getActiveSheet()->mergeCells("{$firstCol}6:{$lastCol}6")->setCellValue("{$firstCol}6", '');

	//PROCESS ROWS
	$styleDocLine = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('rgb' => '000000')
			)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);
	$styleDocLineVals = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('rgb' => '000000')
			)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		)
	);

	$currentLine = 7;
	//size docs
	$tamTable = sizeof($table);

	if ($tamTable < 1) {
		$noDocsLabel = "Não existem {$type} registados.";
		$objPHPExcel->getActiveSheet()->mergeCells("{$firstCol}7:{$lastCol}7")->setCellValue("{$firstCol}7", $noDocsLabel);

		$styleEmpty = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		);
		$objPHPExcel->getActiveSheet()->getStyle("{$firstCol}7:{$lastCol}7")->applyFromArray($styleEmpty);
	} else {
		foreach ($table as $element) {
			fillTable($objPHPExcel, $element, $currentLine);
			$currentLine++;
		}

		//process footer
		$objPHPExcel->getActiveSheet()->mergeCells("{$firstCol}" . $currentLine . ":{$lastCol}" . $currentLine)->setCellValue("{$firstCol}" . $currentLine, '');
		$objPHPExcel->getActiveSheet()->getRowDimension($currentLine)->setRowHeight(10);
		$currentLine++;

		$styleFooterVals = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		);
	}

	//AUTO SET COLS
	foreach ($columns as $key => $column) {
		$objPHPExcel->getActiveSheet()->getColumnDimension("{$column}")->setAutoSize(false)->setWidth($widths[$key]);
	}

	foreach ($heights as $key => $height) {
		$index = $key + 1;
		$objPHPExcel->getActiveSheet()->getRowDimension("{$index}")->setRowHeight($height);
	}

	//SHEET LABEL TITLE
	$labelDate = new DateTime('now');
	$objPHPExcel->getActiveSheet()->setTitle("{$filename}_" . $labelDate->format("d-m-Y"));

	//FINISH AND OUTPUT FILE
	$fileNameDoc = "{$filename}_IU_" . $id_utilizador . ".xlsx";
	$fileNameDownload = "{$filename}_" . $labelDate->format("Y_m_d_H_i_s") . ".xlsx";
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace(__FILE__, $_SERVER['DOCUMENT_ROOT'] . '/docs/gesfaturacao/excel/' . $fileNameDoc, __FILE__));

	//FORCE DOWNLOAD
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="' . $fileNameDownload . '"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	unlink($_SERVER['DOCUMENT_ROOT'] . '/docs/gesfaturacao/excel/' . $fileNameDoc);

?>
