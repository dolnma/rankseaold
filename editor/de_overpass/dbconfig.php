<?php

	$DB_HOST = 'localhost';
	$DB_USER = 'c2ranksea';
	$DB_PASS = 'geqAB54A@';
	$DB_NAME = 'c2ranksea';
	
	try{
		$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
$map_name = "de_overpass";
$table_name = "nades_de_overpass";
$upload_path = "../../wp-content/themes/ranksea/nades/screens/de_overpass/";
?>
<style type="text/css">
  .help_text {
  	font-size:12px;
  	color: #2B2B2B;
</style>