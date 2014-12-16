<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_user = "localhost";
$database_user = "myuser";
$username_user = "root";
$password_user = "root";
$user = mysql_pconnect($hostname_user, $username_user, $password_user) or trigger_error(mysql_error(),E_USER_ERROR); 
?>