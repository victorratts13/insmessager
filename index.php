<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
//require a connection com a base de dados.
require_once('Connections/datahost.php');
//inicia a sessão.
session_start();
//se a sessão for iniciada com o atributo 'MM_Username', é redirecionada a pagina de app.
if(isset($_SESSION['MM_Username'])){
     header('Location: app.php');
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="css/x-style.css" type="text/css" rel="stylesheet" />
<script src="js/bootstrap.js"></script>
<script src="js/jquery.min.js"></script>
<title>Bem-Vindo ao <?php echo $app_name; //titulo da pagina?></title>
<?php
/*
O titulo da pagina e as configurações
de dados podem ser encontradas nas configurações de banco de dados em
'/Connections/datahost.php'
*/
?>
</head>

<body class="back-img">
<div class="index-content">
<img src="core/img/logo.png" height="200" width="200" /><br />
<h1 style="font-family:Arial, Helvetica, sans-serif"><font style="color:rgba(0,200,250,1); ">ins</font><font style="color:rgba(250,250,250,1);">Messenger</font></h1>
</div>
<div class="div-class">
InsMessenger V1.0 - Free Open-Source
<div class="div-index">
<font style="font-size:30px;">
<b>Bem-Vindo</b>
</font>
<?php include('core/login.php');//inclue na div a pagina de login. ?>
Não tem conta? <a href="register.php">Crie uma!</a>
</div>
</div>
</body>
</html>