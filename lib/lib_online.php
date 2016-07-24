<?php
require_once('../Connections/datahost.php');
require_once('..core/login.php');

//lib connectoin online
if(isset($_POST['login'])){
	session_start();
$_SESSION['name'] = $_POST['login'];
}
echo $_SESSION['name'];
?>