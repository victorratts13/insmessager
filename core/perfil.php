<html>
<title></title>
<head>
<link href="../css/x-style.css" type="text/css" rel="stylesheet" />
<link href="../css/bootstrap.css" type="text/css" rel="stylesheet" />
</head>
<?php
session_start();

$perfil = 'core/midia/users/'.$_SESSION['nome'].'/perfil.jpg';

?>
<body>
<div class="perfil-img">
<img class="perfil-img" src="<?php echo $perfil; ?>" width="150" height="150"></img>
<form method="post" action="core/upload.php" enctype="multipart/form-data">
<label class="btn btn-default btn-file btn-info">Imagem do perfil
  <input type="file" name="arquivo" style="display: none;" />
</label>
<input type="submit" value="Enviar" class="btn-info" />
</form>
</div>
<div>

</div>
</body>

</html>
