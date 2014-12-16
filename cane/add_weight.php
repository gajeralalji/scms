<?php 
include_once('Connections/lalo.php');
if(isset($_POST['wtc']))
{
$wtc=$_POST['wtc'];
$coc=$_POST['coc'];
$vt=$_POST['vt'];
$id=$_POST['id'];
$wwv=$_POST['wwv'];
$nw=$_POST['nw'];

mysql_select_db($database_lalo, $lalo);
$quer=mysql_query("INSERT INTO weight(ticket_code,cutting_order_code,vehicle_type,id,weight_vehicle,net_weight)VALUES('$wtc','$coc','$vt', '$id','$wwv', '$nw')") or trigger_error(mysql_error(),E_USER_ERROR);
header("location:weight.php?dsent=1");
}
 
?>