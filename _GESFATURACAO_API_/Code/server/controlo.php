<?php
//check method and process the vars
$_token_read = null;
$_token_read_app = null;

//process request method and get the token for validation
$headers = apache_request_headers();
$token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
if($token){
	$_token_read_app = $token;
} else {
//process request method and get the token for validation
	switch ($_SERVER['REQUEST_METHOD']) {
		case 'GET':
			$_token_read = isset($_GET['_token']) ? $_GET['_token'] : null;
			break;
		case 'POST':
			$_token_read = isset($_POST['_token']) ? $_POST['_token'] : null;
			break;
		case 'PUT':
			//parse data x-www-form-urlencoded
			parse_str(file_get_contents("php://input"), $_PUT);
			$_token_read = isset($_PUT['_token']) ? $_PUT['_token'] : null;
			break;
		case 'PATCH':
			//parse data x-www-form-urlencoded
			parse_str(file_get_contents("php://input"), $_PATCH);
			$_token_read = isset($_PATCH['_token']) ? $_PATCH['_token'] : null;
			break;
		case 'DELETE':
			//parse data x-www-form-urlencoded
			parse_str(file_get_contents("php://input"), $_DELETE);
			$_token_read = isset($_DELETE['_token']) ? $_DELETE['_token'] : null;
			break;

		default:
			$_token_read = isset($_POST['_token']) ? $_POST['_token'] : null;
			break;
	}
}

//web browser controller
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $_SESSION['tempo_sessao'])) {
	session_unset();
	session_destroy();
	header('Location: /server/logout.php');
} else {
	if (isset($_SESSION['id_utilizador']) && isset($_SESSION['plataforma'])) {
		if ($_SESSION['plataforma'] == 'gesfaturacao') {
			$_SESSION['LAST_ACTIVITY'] = time();
		} else {
			session_unset();
			session_destroy();
			header('Location: /server/logout.php');
		}
	} else {
		session_unset();
		session_destroy();
		header('Location: /server/logout.php');
	}
}

?>
