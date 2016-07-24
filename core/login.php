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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['login'])) {
  $loginUsername=$_POST['login'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "app.php";
  $MM_redirectLoginFailed = "usuario não encontrado.";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_datahost, $datahost);
  
  $LoginRS__query=sprintf("SELECT email, senha FROM users WHERE email=%s AND senha=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $datahost) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
     echo $MM_redirectLoginFailed ;
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="../css/x-style.css" type="text/css" rel="stylesheet" />
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.min.js"></script>

<title>Untitled Document</title>
</head>

<body>
<div>
<div>
<h2 style="font-family:Arial, Helvetica, sans-serif;"></h2>
<form name="login-id" id="log" action="<?php echo $loginFormAction; ?>" method="POST" >
<input type="text" name="login" placeholder="email" class="form-control space" />
<input type="password" name="pass" placeholder="pass" class="form-control space"/><br />
<input type="submit" value="entrar" class="btn btn-info form-control" /> 
</form>

</div>
</div>
</body>
</html>