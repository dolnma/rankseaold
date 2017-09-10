<?php
require_once("control/queryFunctions.php");
require_once("control/class.Player.php");
require_once("control/class.Server.php");
$pageTitle = 'RankSea.com';
$weaponsArray = array();
$webTitle = 'Stats';
$dbh = new PDO("mysql:host=192.168.16.12;dbname=c2serverstats", 'c2serverstats', 'mjTeQC_4');
$webURL = 'http://ranksea.com/stats/';
$sbURL = '';
?>