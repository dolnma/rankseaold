<?php
/*
=====================================================
				MENSAGENS DE ERRO
=====================================================
*/
$msg[0] = "Conex�o com o banco falhou!";
$msg[1] = "N�o foi poss�vel selecionar o banco de dados!";
/*
=====================================================
					CONEXAO
=====================================================
*/
$bd_user = "c2serverstats"; // DATABASE USER 
$bd_password = "mjTeQC_4";// DATABASE PASS
$bd = "c2serverstats";// DATABASE
$host = "192.168.16.12";	// DATABASE HOST


$lastback = file_get_contents("up/restore.txt");
	if(intval($lastback)+180 < mktime()){
		include "restore.php";

		file_put_contents("up/restore.txt",mktime());
	}
// Fazendo a conex�o com o servidor MySQL
$conexao = mysqli_connect($host,$bd_user,$bd_password) or die($msg[0]);
mysqli_select_db($conexao,$bd) or die($msg[1]);
?>
