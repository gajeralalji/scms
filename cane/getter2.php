<?php
	//lalji's logic no.2

	include_once('Connections/lalo.php');
	mysql_select_db($database_lalo, $lalo);
	$choice = mysql_real_escape_string($_GET['choice']);
	
	$query = "SELECT ifsc FROM branches WHERE branch_name='$choice'";
	
	$result= mysql_query($query);
		
	while ($row = mysql_fetch_array($result)) {
   		echo "<option>" . $row{'ifsc'} . "</option>";
	}
?>