<?php
	//lalji's logic no.1

	include_once('Connections/lalo.php');
	mysql_select_db($database_lalo, $lalo);
	$choice = mysql_real_escape_string($_GET['choice']);
	
	$query = "SELECT branch_name FROM branches WHERE bank_name='$choice'";
	
	$result = mysql_query($query);
		echo "<option value=''>--select--</option>";
	while ($row = mysql_fetch_array($result)) {
   		 echo "<option value='" . $row['branch_name'] . "'>" . $row['branch_name'] . "</option>";
	}
?>