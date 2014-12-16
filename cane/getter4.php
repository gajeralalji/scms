<?php
	//include_once('Connections/lalo.php');
	//mysql_select_db($database_lalo, $lalo);
	
	//lalji's logic no.4 
	
$pdo = new PDO("mysql:host=localhost;dbname=myuser;charset=utf8", "root", "root");
header("Content-Type:application/json; Charset=utf-8");
$st = $pdo->prepare("SELECT * FROM vehicle WHERE vehicle_num = :id");
$st->execute(array ('id' => $_POST['id']));
$data = $st->fetch(PDO::FETCH_ASSOC);

echo json_encode(array ('status' => true, 'name' => $data ['name']));
?>