<?php session_start();
$server="localhost";
$username="dogfight_marto";
$password="7FS~9]HPF_19";
$db_name="dogfight_airriders";


$connect = mysql_connect($server,$username,$password) or die (mysql_error());
mysql_select_db($db_name,$connect) or die (mysql_error());

mysql_query("SET NAMES utf8");

?>