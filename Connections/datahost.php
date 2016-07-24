<?php
error_reporting(0);

/*
InsMessenger V1.0.
author: Victor Ratts;
Site: none;
email: victor.ratts13@gmail.com;
vesão: 1.0;
distribuição: Open Source;
-----------------------------------------
este opensource fornece um conhecimento de conceito bassico para
quem quer programar um web-chat ou um app de mensagens instantaneas.
*/

$app_name = "InsMessenger";
$app_logo = "<img src='core/img/logo.png' height='50' widht='50' />";
$hostname_datahost = "localhost";
$database_datahost = "database";
$username_datahost = "root";
$password_datahost = "";
$datahost = mysql_connect($hostname_datahost, $username_datahost, $password_datahost) or die(mysql_error()); 
?>