<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="../css/x-style.css" type="text/css" rel="stylesheet" />
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.min.js"></script>

<script>
$(function(){
	$('.form-mensage').submit(function(){
		$.ajax({
			url:'core/send.php',
			type:'POST',
			data: $('.form-mensage').serialize(),
			success: function(data){
				$('.send-result').html(data);
			}
		});
		return false;	
	});
	
});


//reload script
var time = window.setInterval("divload()",1000);
function divload(){
	$('#result').load('core/show.php');
//carrega a barra lateral
$(document).ready(function(){
$("#result").animate({ scrollTop: 500000 },1000);
});
	
}

</script>
<title>Untitled Document</title>
</head>

<body>
<div id="result" class="send-result" style="color:#000">

</div>
<div style="width:70%" class="";>
<form name="send-form" action="" method="post" class="form-mensage">
<table width="456" border="0">
  <tr>
    <td width="314"><input style="color:#000" name="send" type="text" placeholder="your mensage" class="form-control" /></td>
    <td width="219"><input type="submit" style="background-color:#00ccff; color:#fff" class="form-control"/></td>
  </tr>
</table>
</form>
</div>

</body>
</html>