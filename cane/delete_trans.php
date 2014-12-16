<?php
include_once('Connections/lalo.php');
	mysql_select_db($database_lalo, $lalo);
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $result = mysql_query("DELETE FROM trans WHERE ticket_code=$id")
 or die(mysql_error()); 
 
 // redirect back to the view page
 header("Location: view_tran.php");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: view_tran.php");
 }
 
?>