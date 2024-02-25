<?php
//LOGIN VERSAO DE DEV

//SESSION STARTERS
ob_start();
session_start();

//DB CONNECTION
include "connection.php";

//CHECK DATE FUNCTION
function checkDateisValid($data) {
	$hoje = date("Y-m-d");
	$data_validade = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
	if ($hoje > $data_validade) {
		return false;
	} else {
		return true;
	}
}

//VALIDATE INPUTS
if (!$_POST['username'] || !$_POST['password']) {
	$response["errors"] = true;
	$response["type"] = 1;
	$response["message"] = "GESA001x";
	die(json_encode($response));
} else {
	//GET VARS
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Redirect to home page after successful login.

	//PROCESS SESSION VARS AND OTHERS
	$nome_plataforma = 'gesfaturacao';

	$_SESSION['id_utilizador'] = 1;
	$_SESSION['username'] = $username;
	$_SESSION['nome_utilizador'] = "Administrador";
	$_SESSION['email_utilizador'] = "teste@gesfaturacao.pt";

	$tempo_sessao = 6000;

	$_SESSION['tempo_sessao'] = $tempo_sessao * 60;
	$_SESSION['tipo_utilizador'] = 1;
	$_SESSION['plataforma'] = $nome_plataforma;

	$_SESSION['user_pos'] = 0;
	$_SESSION['gesfatur_user'] = 1;

	$tot_modulos = 0;

	$_SESSION['gesfaturacao'] = 1;
	$_SESSION['versao'] = $versao;

	$_SESSION['perm_nome_permissao'] = "Administrador";

	//SESSION LAST FISCAL YEAR
	$_SESSION['ano'] = date("Y");

	//COMPANY (CLIENT) MAIN DATA FOR SESSION VARS
	$_SESSION['designacao_gesfaturacao'] = "GESFaturação";
	$_SESSION['logotipo_gesfaturacao'] = 'logo_default.png';

	// Check Modulo and DataValidade
	$licenca_expirada = false;

	//PROCESS QUERY
	$id_modulo = 1;

	//VALIDATIONS FOR MODULE EXPIRING DATE
	$data_validade_modulo = '2060-12-31';
	$dt_validade_modulo = new DateTime($data_validade_modulo);
	$dt_today = new DateTime(date('Y-m-d'));

	if($dt_validade_modulo < $dt_today) {
		$licenca_expirada = true;
	} else {
		$interval = $dt_today->diff($dt_validade_modulo);
		$dias_restantes = $interval->format('%a');
		switch ($dias_restantes) {
			case 30:
				$_SESSION["validade_licenca"] = 'dentro de 1 mês';
				break;
			case 25:
			case 20:
			case 15:
			case 10:
			case 7:
			case 6:
			case 5:
			case 4:
			case 3:
			case 2:
				$_SESSION["validade_licenca"] = 'dentro de '.$dias_restantes.' dias';
				break;
			case 1:
				$_SESSION["validade_licenca"] = 'dentro de 1 dia';
				break;
			case 0:
				$_SESSION["validade_licenca"] = '0';
				break;
			default:
				$_SESSION["validade_licenca"] = '';
				break;
		}
	}

	// IF IS PLANO Basic SET SESSION AS Basic, ELSE SET PLANO Pro/Demo IN SESSION
	$_SESSION['id_plano_atual'] = 2;

	//REGENERATE SESSION ID EACH TIMES THAT LOGS IN
	session_regenerate_id(true);

	//CLOSE SESSION WRITE
	session_write_close();

	//LAST VALIDATION FOR EXPIRED VERSION
	if($licenca_expirada === true) {
		$response["errors"] = true;
		$response["type"] = 10;
		$response["licenca"] = $id_modulo == 2 ? 'Pro' : 'Basic';
		$response["validade"] = $data_validade_modulo;
		die(json_encode($response));
	}

	//NO ERRORS RESPONSE - REDIRECT FOR FRONTPAGE AFTER!
	$response["errors"] = false;
	$response["state"] = 0;
	$response["pos_user"] = 0;
	$response['user_faturacao'] = 1;
	die(json_encode($response));
}
?>
