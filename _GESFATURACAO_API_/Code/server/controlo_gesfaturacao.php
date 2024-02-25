<?php
if (!isset($_SESSION['gesfaturacao'])) {
	session_unset();
	session_destroy();
		header('Location: /server/logout.php');
} else {
	if ($_SESSION['gesfaturacao'] == 1) {
		$_SESSION['LAST_ACTIVITY'] = time();
	} else {
		session_unset();
		session_destroy();
		header('Location: /server/logout.php');
	}
}
?>