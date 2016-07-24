<?php require_once('Connections/datahost.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
//insere os valores no banco de dados
$pt = 'core/midia/users/'.$_POST['nome'];
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO users (nome, Sobrenome, email, senha) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['Sobrenome'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['senha'], "text"));
					   mkdir($pt, null, true);//cria a pasta do usuario
                                           chmod($pt, 0777);
					   
					   
  mysql_select_db($database_datahost, $datahost);
  $Result1 = mysql_query($insertSQL, $datahost) or die(mysql_error());

  $insertGoTo = "app.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_datahost, $datahost);
$query_caduser = "SELECT nome, Sobrenome, email, senha FROM users";
$caduser = mysql_query($query_caduser, $datahost) or die(mysql_error());
$row_caduser = mysql_fetch_assoc($caduser);
$totalRows_caduser = mysql_num_rows($caduser);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="../css/x-style.css" type="text/css" rel="stylesheet" />
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.min.js"></script>
</head>

<body>
<div class="">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"></td>
      <td><input type="text" name="nome" value="" size="32" class="form-control" placeholder="seu nome" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"></td>
      <td><input type="text" name="Sobrenome" value="" size="32" class="form-control" placeholder="sobrenome"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"></td>
      <td><input type="text" name="email" value="" size="32"  class="form-control" placeholder="seu email"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"></td>
      <td><input type="password" name="senha" value="" size="32" class="form-control" placeholder="senha" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><br><input type="submit" value="enviar" class="form-control"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($caduser);
?>
