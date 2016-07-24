<?php require_once('../Connections/datahost.php'); ?>
<?php require_once('userid.php'); ?>
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

mysql_select_db($database_datahost, $datahost);
$query_show = "SELECT nome,`data`, mensagem FROM mensagens";
$show = mysql_query($query_show, $datahost) or die(mysql_error());
$row_show = mysql_fetch_assoc($show);
$totalRows_show = mysql_num_rows($show);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.circle{
	background-color:rgba(0,50,250,0.2);
	border-radius: 10px;
}
</style>
</head>

<body>
<div style="width:90%; height:500px;  word-break:keep-all;">
<?php do { ?>

<div class="circle" style="color:rgba(250,0,0,0.8); font-family:Arial, Helvetica, sans-serif; font-style:none;">
<?php
echo $row_show['nome'].'<br />';
?>
<div style="color:rgba(0,0,0,1);" >
<?php
echo $row_show['mensagem'].'<br />';
?> 
</div>

<div style="font-size:10px; color:rgba(0,0,0,0.4)">
<?php
 echo $row_show['data'].':'.'<p>';
?>
</div>
</div>

<?php
} while ($row_show = mysql_fetch_assoc($show));
 ?>
</div>

</body>
</html>
<?php
mysql_free_result($show);
?>
