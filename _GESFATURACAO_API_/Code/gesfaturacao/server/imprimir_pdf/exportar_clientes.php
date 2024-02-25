<?php
include $_SERVER["DOCUMENT_ROOT"] . "/server/controlo.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/connection.php";
include $_SERVER["DOCUMENT_ROOT"] . "/server/inserir/log.php";
// include "../../../../resources/tcpdf/tcpdf.php";
include "../../../../../resources/tcpdf/tcpdf.php";
include $_SERVER["DOCUMENT_ROOT"] . "/gesfaturacao/server/helpers.php";
include "../../../../../../P_Key/AssinaturaDigital.php"; /* general version */
// include "../../../../P_Key/AssinaturaDigital.php"; /* demo version only */

// setlocale(LC_MONETARY, 'fr_CH.UTF-8');

try {
	// Turn off AUTOCOMMIT and begin Transaction
	mysqli_autocommit($sqli_connection, FALSE);
	$sqli_connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

	//log sistema - processo
	$descricao_log ="Impressão de documento: Mapa de Clientes";
	insert_log(14,"Editar",$descricao_log,$sqli_connection);

	//registar exportacao
	insertDocumentoExportado('MAPA-CLIENTES', date('d/m/Y'), date('d/m/Y'), $sqli_connection);

	/**
	 * |---------------------------------------------------------------------------
	 * |	Informações Globais
	 * | ------------------------
	 * |
	 * | @Tamanho da Page PDF - 267 Horizontal
	 * | @Tamanho da Page PDF - 160 Vertical
	 * | MultiCell -> $width, $height, $txt, $border=0, $align='J/R/L/C', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false
	 * | Line -> $x1, $y1, $x2, $y2, $style=array()
	 * |---------------------------------------------------------------------------
	 */

	$GLOBALS['Designacao'] = "GESFaturação";
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

	//Clientes - - - - - - - - - - - - - - - - - - - - - -
	$clientes = array();
	$query = "SELECT ID_Cliente, Nome, Nif, Codigo, Endereco, (CONCAT(CodigoPostal, ' ', Cidade, ', ', Pais)), Email, IF(Telemovel!='', Telemovel, Telefone), IF(Usado=1,'Sim','Não'), 0 AS Account
	FROM faturacao_clientes WHERE Esquecer=0 ORDER BY Nome ASC";
	if ($stmt = $sqli_connection -> prepare($query)) {
		$result = $stmt -> execute();
		if (false === $result) {
			$response["errors"] = true;
			$response["message"] = $stmt -> error;
			$sqli_connection->rollback();
			die(json_encode($response));
		}
		$stmt -> store_result();
		$stmt -> bind_result($idCliente, $nome, $contribuinte, $codigo, $endereco1, $endereco2, $email, $telemovel, $usado, $planoContas);
		while ($stmt->fetch()) {
			$clientes[] = array(
				"ID_Cliente" => $idCliente,
				"Nome" => $nome,
				"Nif" => $contribuinte,
				"Codigo" => $codigo,
				"Endereco1" => $endereco1,
				"Endereco2" => $endereco2,
				"Email" => $email,
				"Contacto" => $telemovel,
				"Usado" => $usado,
				"Conta" => $planoContas
			);
		}
		$stmt -> close();
	} else {
		$response["errors"] = true;
		$response["message"] = $sqli_connection -> error;
		$sqli_connection->rollback();
		die(json_encode($response));
	}

	$sqli_connection->commit();
} catch (Exception $e) {
	$response["errors"] = true;
	$response["message"] = $sqli_connection -> error;
	$response["type"] = "transaction";
	$sqli_connection->rollback();
	die(json_encode($response));
}

/**
 * |----------------------------------------------------
 * |				BASE CLASS
 * |----------------------------------------------------
 */
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		$full_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT);
		$half_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/2;
		$third_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/3;
		$fourth_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/4;
		$fifth_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/5;
		$six_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/6;
		$seven_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/7;
		$eigth_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/8;
		$nine_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/9;
		$ten_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/10;
		$eleven_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/11;
		$twelve_page = ($this -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/12;

		$fourth_touch_right = ($this -> getPageWidth() - PDF_MARGIN_RIGHT - $fourth_page);

		$destX = $third_page + $third_page ;

		// Image method signature:
		// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
		$image_path = $_SERVER["DOCUMENT_ROOT"] . "/uploads/faturacao/".$GLOBALS["Logotipo"];
		$a = getimagesize($image_path);
		$image_type = $a[2];

		if($GLOBALS["Logotipo"] != '') {
			if($image_type == IMAGETYPE_JPEG) {
				$this -> Image($image_path, 0, 7, 0, 20, 'JPG', '', 'C', false, 300, 'L', false, false, 0, false, false, false);
			} elseif ($image_type == IMAGETYPE_PNG) {
				$this -> Image($image_path, 0, 7, 0, 20, 'PNG', '', 'C', false, 300, 'L', false, false, 0, false, false, false);
			}

			// $this -> SetFont('opensans', '', 8, '', true);

			$this -> setY(27);
		} else {
			$this -> setY(10);
		}

		/* Special Header Documents */
		$header_special = $full_page - $fourth_page;
		$size_block_header = 71;

		//Left Side (Our Company)
		$this -> SetFont('opensans', 'B', 8, '', true);
		$this -> MultiCell($header_special, '', $GLOBALS["Designacao"],   0, 'L', false, 1, '', '', false, 0, false, true, 0, 'T', false);
		$this -> SetFont('opensans', '', 8, '', true);
		//Line
		$this -> MultiCell($header_special, '', $GLOBALS["Endereco1"],    0, 'L', false, 1, '', '', false, 0, false, true, 0, 'T', false);
		//Line
		$this -> MultiCell($header_special, '', $GLOBALS["CodigoPostal"] . " " . $GLOBALS["Cidade"] , 0, 'L', false, 1, '', '', true, 0, false, true, 0, 'T', false);

		//Line
		$labelSize = 26; $aux_remain = $size_block_header-$labelSize;
		$this -> SetFont('opensans', 'B', 8, '', true);
		$this -> MultiCell($labelSize, '', 'Contribuinte: ', 0, 'L', false, 0, '', '', false, 0, false, true, 0, 'T', false);
		$this -> SetFont('opensans', '', 8, '', true);
		$this -> MultiCell($aux_remain, '', $GLOBALS["Nif"], 0, 'L', false, 1, '', '', false, 0, false, true, 0, 'T', false);

		//Line
		$labelSize = 11; $aux_remain = $size_block_header-$labelSize;
		$this -> SetFont('opensans', 'B', 8, '', true);
		$this -> MultiCell($labelSize, '', 'Email:', 0, 'L', false, 0, '', '', false, 0, false, true, 0, 'T', false);
		$this -> SetFont('opensans', '', 8, '', true);
		$this -> MultiCell($aux_remain, '', $GLOBALS["Email"], 0, 'L', false, 1, '', '', false, 0, false, true, 0, 'T', false);

		//Line
		$this -> Line(PDF_MARGIN_LEFT, $this->GetY()+2, $third_page+$seven_page, $this->GetY()+2, array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(150, 150, 150)));
	}

	// Page footer
	public function Footer() {
		$line1 = '<p>Emitido em: ' . date('d/m/Y H:i:s') . '<br>Por: ' . $GLOBALS['Designacao'] . '. - NIF: ' . $GLOBALS['Nif'] . '</p>';

		$right_marg = $this -> getPageWidth() - PDF_MARGIN_RIGHT;
		$paginationX = $this -> getPageWidth() - PDF_MARGIN_LEFT - 4;

		// Position at 20 mm from bottom
		$this -> SetY(-18);
		$lineY = $this->GetY();
		// Set font
		$this -> SetFont('opensans', '', 8);
		$this -> Line(PDF_MARGIN_LEFT, $this->GetY()-2, $right_marg, $this->GetY()-2, array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(150, 150, 150)));

		$this -> writeHTMLCell(0, 5, '', $this->GetY(), $line1, 0, 1, 0, true, 'C', false);

		/*$this -> SetFont('opensans', '', 7);
		$this -> SetY(-15);
		$this -> Cell($paginationX, 10, 'Page ' . $this -> getAliasNumPage() . '/' . $this -> getAliasNbPages(), 0, 0, 'R', 0, '', 0, false, 'T', 'M');*/
	}
}

//=====================================================+
// 					START FILE
//=====================================================+

$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf -> SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf -> setFooterData(array(0, 64, 0), array(0, 64, 128));

$pdf -> setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf -> setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf -> SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf -> SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf -> SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf -> SetAutoPageBreak(TRUE, 0);
$pdf -> setImageScale(PDF_IMAGE_SCALE_RATIO);

$tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)), 'div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)), 'ul' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)), 'br' => array(0 => array('h' => 0.2, 'n' => 1), 1 => array('h' => 0.2, 'n'=> 1)));
$pdf->setHtmlVSpace($tagvs);

// Add a page
$pdf -> setPrintHeader(false);
$pdf -> setPrintFooter(true);

$pdf -> setFillColor(255, 255, 255);

//Defs
$full_page = $pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT;
$half_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/2;
$third_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/3;
$fourth_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/4;
$fifth_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/5;
$six_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/6;
$seven_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/7;
$eigth_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/8;
$nine_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/9;
$ten_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/10;
$eleven_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/11;
$twelve_page = ($pdf -> getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/12;

//Defs2
$border_bottom = array('B' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_full = array('TLRB' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_lr = array('LR' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_lt = array('LT' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_rt = array('RT' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_lrt = array('LRT' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_lrb = array('LRB' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_lb = array('LB' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_rb = array('RB' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_tb = array('TB' => array('width' => 0.1, 'color' => array(0, 0, 0)));

$border_r = array('R' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_l = array('L' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_b = array('B' => array('width' => 0.1, 'color' => array(0, 0, 0)));
$border_t = array('T' => array('width' => 0.1, 'color' => array(0, 0, 0)));

$style_line = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$style_bold_line = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$style_light_line = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(150, 150, 150));

$right_marg = $pdf -> getPageWidth() - PDF_MARGIN_RIGHT;

//--------------- First Page ---------------
// $pdf -> startPageGroup();
$pdf -> AddPage();

// Início do conteudo (Y)
$startContentY = $pdf -> getPageHeight() / 4;

$pdf -> Header();

$resto = $full_page - ( ($twelve_page/3*2) + $ten_page + $ten_page + $eigth_page + $eigth_page + $seven_page /*+ $ten_page*/ + ($twelve_page/2));

cabecalho($pdf);

cabecalho_tabela($pdf);

// Linhas de Fatura
$pdf -> SetFont('opensans', '', 7);
foreach ($clientes as $linha) {
	//CHECH IF MAIN COMPTE OR CHILD
	$pdf -> SetFont('opensans', '', 7, '', true);

	$a = $pdf->getStringHeight(($twelve_page/3*2), $linha['Codigo']);
	$b = $pdf->getStringHeight($resto, $linha['Nome']);
	$c = $pdf->getStringHeight($ten_page, $linha['Nif']);
	$d = $pdf->getStringHeight($ten_page, $linha['Contacto']);
	$e = $pdf->getStringHeight($eigth_page, $linha['Email']);
	$f = $pdf->getStringHeight($eigth_page, $linha['Endereco1']);
	$g = $pdf->getStringHeight($seven_page, $linha['Endereco2']);
	// $h = $pdf->getStringHeight($ten_page, $linha['Conta']);
	$i = $pdf->getStringHeight(($twelve_page/2), $linha['Usado']);

	//GET PAGE MAX HEIGHT
	$height = calcHeightProd([$a, $b, $c, $d, $e, $f, $g, /*$h,*/ $i]);

	// -- $twelve_page/4 *3 --
	// -- $resto       --
	// -- $six_page    --
	// -- $ten_page  --
	// -- $eigth_page  --
	// -- $eleven_page  --
	// -- $eigth_page  --

	// -- $movimentos['Codigo']                 --
	// -- $movimentos['Descricao']              --
	// -- $movimentos['PlanoCategoria']         --
	// -- $movimentos['SubCategoriaPlanoConta'] --
	// -- $movimentos['ID_CobrancaIVA']         --
	// -- $movimentos['Ecriture']               --
	// -- $movimentos['Total_PVP']              --

	if($pdf -> getY() + $height >= 185) {
		//page break ---------------------------------------------------------------------------------------------------
		$pdf -> AddPage();
		cabecalho_tabela($pdf);
		$pdf -> setY($pdf -> getY() );
	}

	$pdf -> Line(PDF_MARGIN_LEFT, $pdf->GetY(), $right_marg, $pdf->GetY(), $style_light_line);

	//LINE PRINT
	$pdf -> MultiCell(($twelve_page/3*2), $height, $linha['Codigo'],  0, 'L', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	$pdf -> MultiCell($resto, $height, $linha['Nome'],  0, 'L', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	$pdf -> MultiCell($ten_page, $height, $linha['Nif'],  0, 'L', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	$pdf -> MultiCell($ten_page, $height, $linha['Contacto'],  0, 'L', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	$pdf -> MultiCell($eigth_page, $height, $linha['Email'],  0, 'L', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	$pdf -> MultiCell($eigth_page, $height, $linha['Endereco1'],  0, 'L', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	$pdf -> MultiCell($seven_page, $height, trim($linha['Endereco2'],' ,'),  0, 'L', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	// $pdf -> MultiCell($ten_page, $height, $linha['Conta'],  0, 'R', false, 0, '', '', true, 0, false, false, 0, 'T', true);
	$pdf -> MultiCell(($twelve_page/2), $height, $linha['Usado'],  0, 'R', false, 1, '', '', true, 0, false, false, 0, 'T', true);

	$pdf->SetTextColor(0,0,0);
}

$pdf -> Line(PDF_MARGIN_LEFT, $pdf->GetY(), $right_marg, $pdf->GetY(), $style_line);

$pdf->SetTextColor(0,0,0);

$pdf -> SetFont('opensans', '', 8, '', true);

// $pdf -> Ln();

	// Line -> $x1, $y1, $x2, $y2, $style=array()
	// MultiCell -> $width, $height, $txt, $border=0, $align='J/R/L/C', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false

// ----------- Paginação e colocação de 'Originale', 'Duplicata', 'Triplé' e 'Quadruplé' -----------
$max = $pdf -> PageNo();

// ----------------- Page Numbers -----------------------------
$paginationX = $right_marg - PDF_MARGIN_RIGHT;
$pages = $pdf -> getNumPages();
for($i = 1; $i <= $pages; ){
	for($k = 1; $k <= $max; $k++, $i++){
		$pdf -> setPage($i);

		$pdf -> SetFont('opensans', '', 7);
		$pdf -> SetY(-10);
		$pdf -> Cell($paginationX, 0, 'Página ' . $k . '/' . $max, 0, 0, 'R', 0, '', 0, false, 'B', 'B');

	}
}
// ----------------------------------------------------------

// ------------- Certificação Vertical Lado Esquerdo --------
$total_pages = $pdf -> getNumPages();
for ($i = 1; $i <= $total_pages; $i++) {
    $pdf -> setPage($i);

    // $myPageWidth = $pdf -> getPageWidth();
    $myPageHeight = $pdf -> getPageHeight();

    $myX = PDF_MARGIN_LEFT / 2 + 2;
    $myY = $myPageHeight - 35;

    $pdf -> SetAlpha(0.5);

    $pdf -> StartTransform();
    $pdf -> Rotate(90, $myX, $myY);
    $pdf -> SetFont('opensans', '', 7);
    $pdf -> SetTextColor(0, 0, 0);

    $pdf -> Text($myX, $myY, ' ');
    $pdf -> StopTransform();

    // Reset the transparency to default
    $pdf -> SetAlpha(1);
}

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$exportedFileName = 'Clientes_'.date("d-m-Y").'.pdf';
//set aditional information
$pdf->SetAuthor('GESFaturação');
$pdf->SetTitle($exportedFileName);
$pdf->SetSubject('Documento Assinado e Certificado Digitalmente');

//sign digital document
//$pdf->setSignature($glb_certificate, $glb_certificate, $glb_pwd, '', 2, $glb_info);

//output document
$pdf -> Output('Clientes_'.date("d-m-Y").'.pdf', 'I');

//=====================================================+
// 					END OF FILE
//=====================================================+

//DOC HEADER - - - - - - - - - - - - - - - - - - -
function cabecalho($pdf){
	global $full_page;   //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT     --
	global $half_page;   //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/2  --
	global $third_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/3  --
	global $fourth_page; //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/4  --
	global $fifth_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/5  --
	global $six_page;    //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/6  --
	global $seven_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/7  --
	global $eigth_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/8  --
	global $nine_page;   //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/9  --
	global $ten_page;    //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/10 --
	global $eleven_page; //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/11 --
	global $twelve_page; //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/12 --

	global $style_line;
	global $style_bold_line;
	global $style_light_line;

	global $right_marg;
	global $startContentY;

	// global $data_inicio;
	// global $data_fim;
	// global $stringLabelPeriod;

	global $planComptable;
	global $planLBL;


	$pdf -> SetFont('opensans', 'B', 10);
	$pdf -> MultiCell($half_page, '', 'Mapa de Clientes', 0, 'L',  false, 1, '', $startContentY, false, 0, false, true, 0, 'T', false);

	$pdf -> Line(PDF_MARGIN_LEFT, $pdf->GetY(), $right_marg, $pdf->GetY(), $style_bold_line);

	$pdf -> SetFont('opensans', '', 8);
	$pdf -> Ln();

	$pdf -> SetFont('opensans', 'B', 8);
	// $pdf -> MultiCell($half_page, '', 'Plan Comptable ', 0, 'L', false, 1, '', '', false, 0, false, true, 0, 'T', false);
	// $pdf -> MultiCell($fourth_page, '', 'Monnaie', 0, 'L', false, 1, PDF_MARGIN_LEFT + $half_page + $fourth_page, '', false, 0, false, true, 0, 'T', false);

	// $pdf -> Line(PDF_MARGIN_LEFT, $pdf->GetY(), PDF_MARGIN_LEFT + $half_page - 4, $pdf->GetY(), $style_line);
	// $pdf -> Line(PDF_MARGIN_LEFT + $half_page, $pdf->GetY(), PDF_MARGIN_LEFT + $half_page + $fourth_page - 4, $pdf->GetY(), $style_line);
	// $pdf -> Line(PDF_MARGIN_LEFT + $half_page + $fourth_page, $pdf->GetY(), $right_marg, $pdf->GetY(), $style_line);

	$pdf -> SetFont('opensans', '', 8);
	// $pdf -> MultiCell($full_page, '', $planComptable, 0, 'L', false, 1, PDF_MARGIN_LEFT, '', false, 0, false, true, 0, 'T', false);
	// $pdf -> MultiCell($fourth_page, '', $GLOBALS['NifCliente'], 0, 'L', false, 0, PDF_MARGIN_LEFT + $half_page, '', false, 0, false, true, 0, 'T', false);
	// $pdf -> MultiCell($fourth_page, '', 'Franc Suisse (CHF)', 0, 'L', false, 1, PDF_MARGIN_LEFT + $half_page + $fourth_page, '', false, 0, false, true, 0, 'T', false);

	// $pdf -> Ln();

	$pdf -> SetFont('opensans', 'B', 8);

	// $pdf -> Ln();
	// $pdf -> Ln();

}

//LINES HEADER - - - - - - - - - - - - - - - - - - -
function cabecalho_tabela($pdf){
	global $right_marg;

	global $style_line;
	global $style_bold_line;

	global $full_page;   //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT     --
	global $half_page;   //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/2  --
	global $third_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/3  --
	global $fourth_page; //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/4  --
	global $fifth_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/5  --
	global $six_page;    //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/6  --
	global $seven_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/7  --
	global $eigth_page;  //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/8  --
	global $nine_page;   //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/9  --
	global $ten_page;    //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/10 --
	global $eleven_page; //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/11 --
	global $twelve_page; //-- getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT)/12 --


	global $resto;

	$pdf -> SetFont('opensans', 'B', 8);
	$pdf -> Line(PDF_MARGIN_LEFT, $pdf->GetY(), $right_marg, $pdf->GetY(), $style_bold_line);
	$pdf -> setFillColor(230, 230, 230);

	$pdf -> MultiCell(($twelve_page/3*2), '', 'Código', 0, 'L', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	$pdf -> MultiCell($resto, '', 'Nome', 0, 'L', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	$pdf -> MultiCell($ten_page, '', 'NIF', 0, 'L', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	$pdf -> MultiCell($ten_page, '', 'Contacto', 0, 'L', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	$pdf -> MultiCell($eigth_page, '', 'Email', 0, 'L', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	$pdf -> MultiCell($eigth_page, '', 'Endereco', 0, 'L', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	$pdf -> MultiCell($seven_page, '', 'Cód. Postal, Cidade, País', 0, 'L', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	// $pdf -> MultiCell($ten_page, '', 'Conta', 0, 'R', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	$pdf -> MultiCell(($twelve_page/2), '', 'Usado', 0, 'R', true, 1, '', '', true, 0, false, false, 0, 'T', false);
	// $pdf -> MultiCell($eigth_page, '', 'Montant Unit.', 0, 'R', true, 0, '', '', true, 0, false, false, 0, 'T', false);
	// $pdf -> MultiCell($eigth_page, '', 'Montant TVA', 0, 'R', true, 1, '', '', true, 0, false, false, 0, 'T', false);

	$pdf -> Line(PDF_MARGIN_LEFT, $pdf->GetY(), $right_marg, $pdf->GetY(), $style_line);
	$pdf -> setFillColor(255, 255, 255);
	$pdf -> SetFont('opensans', '', 7);
}


// Calculate Min Height of Line
function calcHeightProd($strHeight){
	return max($strHeight) + 1;
}

 ?>
