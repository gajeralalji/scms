<?php
	//include_once('Connections/lalo.php');
	//mysql_select_db($database_lalo, $lalo);
	
	//lalji's logic no.3 
	
$pdo = new PDO("mysql:host=localhost;dbname=myuser;charset=utf8", "root", "root");

header("Content-Type:application/json; Charset=utf-8");


$st = $pdo->prepare("SELECT * FROM farmers WHERE id = :id");
$st->execute(array ('id' => $_POST['id']));
$data = $st->fetch(PDO::FETCH_ASSOC);

echo json_encode(array ('status' => true, 'name' => $data ['firstname'], 'lastname' => $data ['lastname'], 'vn' => $data ['village_name'], 'vc' => $data ['village_code'], 'zn' => $data ['zone_name'], 'zc' => $data ['zone_code'], 'ta' => $data ['taluka'], 'tc' => $data ['taluka_code'], 'di' => $data ['district'], 'dis' => $data ['distance']));
?>