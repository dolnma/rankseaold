<?php
/*
=====================================================
				MENSAGENS DE ERRO
=====================================================
*/
$msg[0] = "Can't Connect to DB Server, check settings!";
$msg[1] = "Not possible to select database! Is the name right? Does it exist?";
/*
=====================================================
					CONEXAO
=====================================================
*/

$sqlite_server = false; // ARE YOUR SERVER RUNNING THE PLUGIN AS SQLITE?

//(IF THE PLUGIN IS RUNNING AS MYSQL, PUT BELOW THE DATA FOR CONNECTING TO THE DATABASE THAT IS BEING USED BY THE PLUGIN)
$bd_user = "c2serverstats"; // DATABASE USER 
$bd_password = "mjTeQC_4";// DATABASE PASS
$bd = "c2serverstats";// DATABASE
$host = "192.168.16.12";	// DATABASE HOST
$bd_table = "rankme"; // DATABASE TABLE BEING USED AT THE PLUGIN. (rankme_sql_table cvar). Default: rankme.

$ftp_server = ""; //FTP HOST
$ftp_user_name = ""; // FTP USER NAME
$ftp_user_pass = ""; // FTP PASS
$ftpDIR = ""; // CSTRIKE FOLDER ON FTP

// Fazendo a conex�o com o servidor MySQL
$conexao = mysqli_connect($host,$bd_user,$bd_password) or die($msg[0]);
mysqli_select_db($conexao,$bd) or die($msg[1]);
?>
