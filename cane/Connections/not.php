<?php
include_once('lalo.php');
mysql_select_db($database_lalo, $lalo);
$query= mysql_query("SELECT * From job WHERE notif=1");
$n = mysql_num_rows($query);
if($n==0)
$n="";
?>