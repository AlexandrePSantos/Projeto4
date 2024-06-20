<?php 
/* Simple Call to check if website is responding */

//Init some vars
$opcao = isset($_POST['opcao']) ? intval($_POST['opcao']) : 0;
if($opcao < 1) $opcao = isset($_GET['opcao']) ? intval($_GET['opcao']) : 0;

header('HTTP/1.0 200 Ok');
die();

//Process Received Option
switch ($opcao) {
	//Check if reaches this page
	case 1:
		header('HTTP/1.0 200 Ok');
		$response["errors"] = false;
		$response["valid"] = true;
		die(json_encode($response));
		break;

	default:
		header('HTTP/1.0 200 Ok');
		die();
		break;
}

die();
?>