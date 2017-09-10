<?php
include_once "config.php";
$DEBUG = false;

$conn_id = ftp_connect($ftp_server);
if(!$conn_id)
	die ("Couldn't connect to the ftp server!");

if(!ftp_login($conn_id, $ftp_user_name, $ftp_user_pass))
	die ("Couldn't log in to the ftp server!");
global $bd_table;
$backupFile[0]['file'] = 'up/rank.sql';
$backupFile[0]['table'] = $bd_table;

$filename = "rank.sql";
if (ftp_get($conn_id, "up/rank.sql", $ftpDIR . "/rank.sql", FTP_BINARY)) {
    if(isset($_GET['echo']) || $DEBUG)
		echo "Successfully received file<BR>";
	ftp_close($conn_id);
} else {


	if(isset($_GET['echo']) || $DEBUG){
		echo "There was a problem reading from the ftp or writing into the up folder. Testing if FTP file exist.<BR>";
		$contents = ftp_nlist($conn_id, $ftpDIR . "/.");
		$found = false;

		foreach($contents as $file){
			if($file == "rank.sql"){
				echo "rank.sql found. The problem is writing into the up folder.";
				$found = true;
				break;
			}

		}
		if(!$found){
			echo "rank.sql not found. The problem is reading from the FTP. Files:<BR>";
			var_dump($contents);
		}
	}
	ftp_close($conn_id);
	die("");
}
foreach ($backupFile as $table){
	$sql = "DROP TABLE `" . $table['table'] . "`;";
	try {
		mysqli_query($sql);
	} catch (Exception $e) {}

	$current = file_get_contents($table['file']);

	$query = explode("\n", $current);
	foreach($query as $sql){
		try {
			mysqli_query($sql);
		} catch (Exception $e) {}

	}

}

?>
