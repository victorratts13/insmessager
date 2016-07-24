<?php
$hostname_datahost = "localhost";
$database_datahost = "database";
$username_datahost = "root";
$password_datahost = "";
$datahost = mysql_connect($hostname_datahost, $username_datahost, $password_datahost) or die(mysql_error()); 
mysql_select_db($database_datahost);

session_start();
$online2 = mysql_query("UPDATE users SET online = '0' WHERE id = '".$_SESSION['id']."'")or die(mysql_error());
$server = $_SERVER['SERVER_NAME']/auth.php;
session_destroy();
echo header('Location: ../')


?>