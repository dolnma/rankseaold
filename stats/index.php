<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<link rel="stylesheet" type="text/css" href="styles.css" />

<script src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.titlecase.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script src="scripts.js"></script>
<body onload="make_oddeven(0)"><center>
<?php
require_once('gora.php');
?>
<p>
  <?php

include_once "check_restore.php";

global $bd_table;
$query1 = "SELECT * FROM `$bd_table` ORDER BY score DESC";
$resultado1 = mysqli_query($conexao,$query1);

echo "<table id='table'><tr><th>RANK</th><th>NAME</th><th>STEAMID</th><th>POINTS</th><th>KDR</th><th>HS</th><th>ACC</th><th>PROFILE</th></td>";
$rank=0;
while ($row = mysqli_fetch_array($resultado1)) {
	$rank++;
	if($row['hits'] == 0){
		$hits = 1;
	} else {
		$hits = $row['hits'];
	}

	if($row['deaths'] == 0){
		$deaths = 1;
	} else {
		$deaths = $row['deaths'];
	}

	if($row['shots'] == 0){
		$shots = 1;
	} else {
		$shots = $row['shots'];
	}
	$accuracy = "";

	$temp = strval($row['hits']/$shots);
	//$accuracy = $temp;
	if(strpos($temp,".") !== false){
																			for($i = 0; $i<=strpos($temp,".")+2;$i++){
																				if( strlen($temp)-1 <$i ){
																					$accuracy .= "";
																				}else{
																					$accuracy = $accuracy . $temp[$i];
																					}

																			}
																		} else { $accuracy = $temp . ".00";}
	echo "<tr><td>$rank</td><td>" . $row['name'] . "</td><td>{$row['steam']}</td><td>{$row['score']}</td><td>";
	$temp = strval($row['kills']/$deaths);
	if(strpos($temp,".") !== false){
		for($i = 0; $i<=strpos($temp,".")+2;$i++){
			if( strlen($temp)-1 <$i ){
				break;
			}else{
				echo $temp[$i];
			}

		}
	} else { echo $temp . ".00";}
	echo "</td><td>{$row['headshots']}</td><td>" . $accuracy . "</td>
	<td><a href='showplayer.php?id=".$row['id']."'><img src='/images/more.png'></a></a></td>
	</tr>";
}
// close connection
$logdb = null;
?>
</p>
</center>
<div id="modal"></div>
