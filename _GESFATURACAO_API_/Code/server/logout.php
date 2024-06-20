<?php
include "connection.php";

// you must start session before destroying it
session_start();
$id_utilizador = $_SESSION['id_utilizador'];
$nome_utilizador = $_SESSION['nome_utilizador'];

session_unset();
session_destroy();

unset($_SESSION["id_utilizador"]);
unset($_SESSION["username"]);
unset($_SESSION["nome_utilizador"]);
unset($_SESSION["plataforma"]);
unset($_SESSION['user_pos']);

/* Token do pos */
unset($_SESSION['token']);

$link = "/index.php";

header('Location: ' . $link);
?>