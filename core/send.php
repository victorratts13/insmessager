<?php
require_once('../Connections/datahost.php');
session_start();

//seleção de banco de dados e configurações.
mysql_select_db($database_datahost, $datahost);
$query_online = "SELECT * FROM users WHERE email='".$user."'";
$online = mysql_query($query_online, $datahost) or die(mysql_error());
$row_online = mysql_fetch_assoc($online);
$totalRows_online = mysql_num_rows($online);

//config and vars
$send = $_POST['send'];
$data = date('Y:m:d H:i');
$name = $_SESSION['nome'];
$msn = "your mensage";
if(empty($send)){
	echo $msn;
}
else{
mysql_select_db($database_datahost);
mysql_query("INSERT INTO mensagens (nome,data,mensagem) VALUES ('$name','$data','$send')") or die (mysql_error());
}
if(isset($send)){
	reset($_POST);
}


?>