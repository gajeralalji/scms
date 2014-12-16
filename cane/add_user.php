<?php 
include_once('Connections/lalo.php');
if(isset($_POST['email']))
{
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$emai=$_POST['email'];
$un=$_POST['username'];
$ps=md5($_POST['password']);
$gender=$_POST['gen'];
$date = $_POST['dob_year'] . '-' . $_POST['dob_month'] . '-' . $_POST['dob_day'];
$today1 = date("Y-m-d H:i:s.u");
$ut1=$_POST['ut'];
mysql_select_db($database_lalo, $lalo);
$quer=mysql_query("INSERT INTO members(id,username,firstname, lastname,password,email,gender,birthdate,user_type,date,activation_code)VALUES('','$un','$fname', '$lname','$ps', '$emai', '$gender', '$date', '$ut1', '$today1','')") or trigger_error(mysql_error(),E_USER_ERROR);
header("location:dashboard.php?dsent=1");
}
 
?>