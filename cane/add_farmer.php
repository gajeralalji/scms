<?php 
include_once('Connections/lalo.php');
if(isset($_POST['email']))
{
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$date = $_POST['yy'] . '-' . $_POST['mm'] . '-' . $_POST['dd'];
$gender=$_POST['gender'];
$ft=$_POST['ft'];
$add=$_POST['add'];
$vn=$_POST['vilage_name'];
$vc=$_POST['village_code'];
$zn=$_POST['zone_name'];
$zc=$_POST['zone_code'];
$ta=$_POST['taluka'];
$tc=$_POST['taluka_code'];
$di=$_POST['district'];
$pn=$_POST['ph_no'];
$mn=$_POST['mo_no'];
$emai=$_POST['email'];
$if=$_POST['ifsc'];
mysql_select_db($database_lalo, $lalo);
$quer=mysql_query("INSERT INTO farmers(id,firstname,lastname,birthdate,gender,farmer_type,address,village_name,village_code,zone_name,zone_code,taluka,taluka_code,district,ph_no,mo_no,email,ifsc)VALUES('','$fname', '$lname','$date', '$gender','$ft','$add','$vn','$vc','$zn','$zc','$ta','$tc','$di','$pn','$mn','$emai','$if')") or trigger_error(mysql_error(),E_USER_ERROR);
header("location:farmers.php?dsent=1");
}
 
?>