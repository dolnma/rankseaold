<?php
include_once "config.php";
global $sqlite_server;
if($sqlite_server){
	if(file_exists("up/restore.txt"))
		$lastback = file_get_contents("up/restore.txt");
	else 
		$lastback = 0;
		
	if(intval($lastback)+180 < mktime()){
		include "restore.php";
		
		file_put_contents("up/restore.txt",mktime());
	}
}
?>
