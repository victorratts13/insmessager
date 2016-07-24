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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="css/x-style.css" type="text/css" rel="stylesheet" />
<script src="js/bootstrap.js"></script>
<script src="js/jquery.min.js"></script>
<title>Login</title>
</head>

<body class="back-img">
<div class="auth-div">
<center>
<img src="core/img/logo.png" width="150" height="150" class="h-logo" />
<h2 style="font:Arial, Helvetica, sans-serif;">Seja bem Vindo. </h2>
<?php $link = "core/login.php"; include($link); ?>
Não tem conta? <a href="register.php">Crie uma!</a>
</center>
</div>

</body>

</html>