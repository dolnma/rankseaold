<?php
//Version 3.2
$steamauth['apikey'] = "50D3F08D6897D2FE99BEC3819243C030"; // Your Steam WebAPI-Key found at http://steamcommunity.com/dev/apikey
$steamauth['domainname'] = "http://localhost:8080/forum"; // The main URL of your website displayed in the login page
$steamauth['logoutpage'] = "http://localhost:8080/home"; // Page to redirect to after a successfull logout (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
$steamauth['loginpage'] = "http://localhost:8080/forum"; // Page to redirect to after a successfull login (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
$steamauth['accountpage'] = "http://localhost:8080/account"; // Page to redirect to account settings

// System stuff
if (empty($steamauth['apikey'])) {die("<div style='display: block; width: 100%; background-color: red; text-align: center;'>SteamAuth:<br>Please supply an API-Key!</div>");}
if (empty($steamauth['domainname'])) {$steamauth['domainname'] = $_SERVER['SERVER_NAME'];}
if (empty($steamauth['logoutpage'])) {$steamauth['logoutpage'] = $_SERVER['PHP_SELF'];}
if (empty($steamauth['loginpage'])) {$steamauth['loginpage'] = $_SERVER['PHP_SELF'];}
if (empty($steamauth['accountpage'])) {$steamauth['accountpage'] = $_SERVER['PHP_SELF'];}
?>
