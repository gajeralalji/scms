<?php

$hostname_lalo = "localhost";
$database_lalo = "myuser";
$username_lalo = "root";
$password_lalo = "root";
$lalo = mysql_pconnect($hostname_lalo, $username_lalo, $password_lalo) or trigger_error(mysql_error(),E_USER_ERROR); 
?>