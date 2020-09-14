<?php
	require_once("class/usuario.php");
	$usuario = new login_usuario;
	$usuario->login();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<link rel="icon" href="img/icone.bmp" type="image/x-icon" />
	<title>Freak Dream</title>
	<link href="template/css/style.css" rel="stylesheet"/>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112407325-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-112407325-1');
	</script>
</head>
<body>
 	
 	<div class="topo">

 		<div class="icone">


 		</div><!--icone-->


 		<form  class="form-4" name="login" action="index.php" method="post">
        
          <input name="email" type="text" placeholder="Email" required /> 
          <input name="senha" type="password" placeholder="Senha" required />
          <input type="submit" name="entre" value="Entre"/>      
            
        </form>  

 	</div><!--topo-->

 	<div class="logo">

 	</div><!--logo-->
 	
 	<div class="nuvem">

 	</div><!--nuvem-->

 	<div class="viver">

 	</div><!--viver-->

 	<div class="nuvem3">

 	</div><!--nuvem3-->

 	<div class="nuvem2">

 	</div><!--nuvem2-->

</body>
</html>