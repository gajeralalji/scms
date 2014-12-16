<?php 
include_once('Connections/lalo.php');
if(isset($_POST['id']))
{
$wtc=$_POST['wtc'];
$coc=$_POST['vt'];
$vt=$_POST['vn'];
$id=$_POST['id'];
$wwv=$_POST['di'];
$nw=$_POST['rent'];

mysql_select_db($database_lalo, $lalo);
$quer=mysql_query("INSERT INTO trans(ticket_code,vehicle_type,vehicle_number,id,distance,rent)VALUES('$wtc','$coc','$vt', '$id','$wwv', '$nw')") or trigger_error(mysql_error(),E_USER_ERROR);
header("location:transportation.php?dsent=1");
}
 
?>