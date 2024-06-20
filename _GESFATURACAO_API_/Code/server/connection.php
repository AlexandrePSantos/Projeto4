<?php

date_default_timezone_set("Europe/London");
$sqli_connection = mysqli_connect("127.0.0.1","root","","gesfaturacao_db") or die("Error db :" . mysqli_error($sqli_connection)." | ".mysqli_connect_errno()." | ".mysqli_connect_error()); 
mysqli_set_charset($sqli_connection,"utf8");

?>