<?php require_once('Connections/datahost.php'); ?>
<?php
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

error_reporting(0);//reportador de error desligado (tente mante-lo assim).
//se for inserido um valor em 'Logged' eleiniciará a sessão.
if (!isset($_SESSION['logged'])) {
  session_start();
}


$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restringir o acesso à página : conceder ou negar acesso a esta página
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // Por segurança, começar por assumir o visitante não está autorizado. 
  $isValid = False; 

  // Quando um visitante tem registrado neste local , a variável Session MM_Username definida igual ao seu nome de usuário . 
  // Portanto , sabemos que um usuário não está logado se essa variável de sessão está em branco .
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "auth.php";//redirecionamento caso o usuario não esteja logado
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
//detales da conecção ao banco de dados
$user = $_SESSION['MM_Username'];
mysql_select_db($database_datahost, $datahost);
$query_online = "SELECT * FROM users WHERE email='".$user."'";
$online = mysql_query($query_online, $datahost) or die(mysql_error());
$row_online = mysql_fetch_assoc($online);
$totalRows_online = mysql_num_rows($online);

$chat = "core/chat.php";

//detales da sessão.
if( mysql_num_rows($online) == 1){
	$_SESSION['id'] = $row_online['id'];
	$_SESSION['email'] = $row_online['email'];
	$_SESSION['nome'] = $row_online['nome'];
	$_SESSION['logged'] = TRUE;
//deixar usuario online
	$online = mysql_query("UPDATE users SET online = '1' WHERE id = '".$_SESSION['id']."'")or die(mysql_error($conexion));
/*
a area acima tranforma o atribudo da tabela users do banco de dados de 0 "offline" para 1 "online"
tornado assim visivel que os usuarios estejam ou não logados.
*/
}
?>
<?php 
/*
a partir desta linha abaixo, será mostrado o codigo responsavel por mostrar todos os usuatios que estejam 
online no momento da sessão.
*/
$consulta1 = mysql_query("SELECT * FROM users WHERE online='1'")or die(mysql_error($conexion));
    $ful = mysql_fetch_assoc($consulta1);
	$num = mysql_num_rows($consulta1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="css/x-style.css" type="text/css" rel="stylesheet" />
<script src="js/bootstrap.js"></script>
<script src="js/jquery.min.js"></script>
<script>

</script>

<title>Bem Vindo(a) <?php echo $_SESSION['nome']; ?> ao <?php echo $app_name; ?></title>
</head>

<body class="back-img">
<div id="onlines" class="div-last" style="color:rgba(0,0,0,1); padding:20px;">

<div style="top:0;">
Você tem 
<?php
	echo '<font style="color:green;"><b>'.$num.'</b></font>';// mostra o numero de usuarios online
?> Amigos online
</div>
<?php
	do{
    echo "<font style='color:rgba(0,0,0,0.8);'>".$ful['nome']."<br />";//mostra o nome dos usuarios
    }while($ful = mysql_fetch_assoc($consulta1));
	
?>
</div>
<div class="chat-content form-control">
<?php include($chat); ?>
</div>
<div class="div-top">
<?php echo $app_logo; ?> | <a href="core/logout-set.php"><button>Logout</button></a>
</div>
<div class="div-class">
<div class="div-text">
<?php
//mostra a imagem e o nome do usuario
echo "<h2>bem-vindo ".$_SESSION['nome']."</h2>";
require_once('core/perfil.php');
?>

</div>
</div>
</body>
</html>
<?php
mysql_free_result($online);
?>
