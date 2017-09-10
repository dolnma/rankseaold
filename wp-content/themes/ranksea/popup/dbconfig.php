<?php
	
	$DBhost = "localhost";
	$DBuser = "c2ranksea";
	$DBpass = "geqAB54A@";
	$DBname = "c2ranksea";
	try {
		$DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
		//$DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $ex){
		die($ex->getMessage());
	}