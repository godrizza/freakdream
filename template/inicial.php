<?php
	session_start(); 
	require_once'../class/usuario.php';
	require_once'../class/cripitografia.php';
	require_once'../class/seguir.php';

	require_once'../class/postar.php';
	require_once'../class/noticia.php';
	require_once'../class/limitar_texto.php';
	require_once'../class/foto.php';
	require_once'../class/deletar_post.php';
	require_once'../class/perfil_foto.php';

	//proteger sistema
	$protege = new login_usuario();
	$protege->proteger();

	//buscar dados usuario
	$u = new usuario;
	$u->setid($_SESSION['id_session']);
	$login = $u->buscar_usuario();

	//buscar foto usuario

	$f = new foto;
	$f->setuser_id($_SESSION['id_session']);
	$f->settipo('1');
	$foto = $f->buscar_foto();

	//verificado form acao

	if (isset($_GET['acao'])){
	$acao = $_GET['acao'];

	    switch($acao) {

	        case "postar_texto":{
	 
	            $post = new post;
	            $post->setuser_id($_SESSION['id_session']);
	            $post->settipo("1");
	            $post->settexto($_POST['texto']);
	            $post->postar();
	            unset($_GET['acao']);
	        }
	        break;

	        case 'deletar_post':{
	        	$post = new deletar_post;
	        	$post->setuser_id($_SESSION['id_session']);
	        	$post->setpost_id($_POST['aviso_post_form_id']);
	        	$post->deletar();
	        	unset($_GET['acao']);

	        }
	        break;

	        case 'postar_foto':{

	        	include("../class/upload.php");

	        }
	        break;

	        case 'compartilhar_texto':{	        	
	        	$post = new post;
	        	$post->setuser_id($_SESSION['id_session']);
	        	$post->settipo("3");
	        	$post->settexto($_POST['id_post_respostagem']);
	        	$post->postar();
	        	unset($_GET['acao']);
	        }
	        break;
	        
	    }

	}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<link rel="icon" href="img/icone.bmp" type="image/x-icon" />
	<title>Freak Dream</title>
	<link href="css/style_inicial.css" rel="stylesheet"/>
	<script src="js/jquery.min.js" type="application/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>
</head>
<body>
	<div class="amigo_sub">
	
		<span class="seta"></span>
		
		<div class="sub_topo">
		
			<h1>Solicitação de amizade</h1>
				
			<i class="configuracao_amizade">settings</i>
			<i class="close_amizade">close</i>	
			
		</div><!--sub_topo-->
		
		<div class="amigo_sub_configuracao">
		
			<span class="seta"></span>
			
			<h1>Quem pode lhe enviar ?</h1>
			
			<form  class="amigo_privacidade" name="amigo_privacidade" action="class\" method="post">
           	
           	 	<select name="privacidade">
 				
  					<option value="global">Global</option>
  					<option value="amigos">Amigos de amigos</option>
  				  				
				</select> 
          		        		
           		<input type="submit" name="entre" value="Salvar"/>
            
      		</form><!--Form Busca-->
						
		</div><!--amigo_sub_configuracao-->	
		
		<div class="amigo_solicitacao">
			
			<img src="../imagens/00.jpg" alt="Matheus Rizza" />
			
			<a href="#" class="link_perfil">Fernada Souza</a>
			
			<a href="#" class="aceita_amigo">Aceitar</a>
			
			<a href="#" class="recusar_amigo">Recusar</a>
			
		</div><!--amigo_solicitacao-->		
		
	</div><!--amigo_Sub-->

	<div class="notificacao_sub">

		<span class="seta"></span>

		<div class="sub_topo">
		
			<h1>Notificaçôes</h1>
					
			<i class="close_notificao">close</i>	
			
		</div><!--sub_topo-->

	</div><!--notificacao_sub-->

	<div class="chat_sub">

		<span class="seta"></span>

		<div class="sub_topo">
		
			<h1>Chat</h1>
					
			<i class="close_chat">close</i>	
			
		</div><!--sub_topo-->

	</div><!--chat_sub-->

	<div class="busca_pesquisa" id="busca_pesquisa">

	</div><!--busca_pesquisa-->	

	<div class="painel">
		<span class="seta"></span>

		<div class="sub_topo">
		
			<h1>Reportar erro ou melhoria</h1>
			<i class="close_painel">close</i>	
			
		</div><!--sub_topo-->

		<div class="painel_status">
			<h1>Sistemas em implementação:</h1>
			<ul>

				<li><i>build</i><h1>Sistema de comentario - 50%</h1></li>
				<li><i>build</i><h1>Sistema de configuração - 0%</h1></li>
				<li><i>build</i><h1>Uplode de Fotos - 0%</h1></li>
				<li><i>build</i><h1>Sistema de gostei - 0%</h1></li>
			<ul>
				
	       	<form  class="enviar_status" name="login" action="class\login.php" method="post">
	        	<span>Enviar Erro ou melhoria:</span>
		        <input name="Busca" type="text" placeholder="Reporte erro ou melhoria." required/> 
		        <input type="submit" name="entre" value="Enviar"/>    
	            
	      	</form><!--Form Busca-->


		</div><!--painel_status-->

	</div><!--painel-->
	<div class="configuracao_sub">
			
		<span class="seta"></span>
		
		<div class="sub_topo">
			
			<h1>Configuração</h1>

			<i class="close_configuracao">close</i>	
				
		</div><!--sub_topo-->

	</div><!--configuracao_sub-->

	<div class="escurecer">
	</div><!--escurecer-->

		<div class="uplode_foto">

			<span class="seta"></span>
			
			<div class="sub_topo">
				
				<h1>Enviar Imagem</h1>

				<i class="close_foto">close</i>	
					
			</div><!--sub_topo-->

			<div class="legenda">
	  			<form enctype="multipart/form-data"  class="foto" action="?acao=postar_foto" name="uplode_foto" method="post">
        			<label for="imagem">Enviar Imagem</label>

					<input type="file" id="imagem" name="imagem" style="display:none;" />
					<textarea name="texto" placeholder="Descrição da Imagem" cols="30" rows="5"></textarea>
					<input type="checkbox" name="opcoes" value="1"/>Usar imagem no perfil 

        			<input type="submit" name="entre" value="Publicar"/>      
            
      			</form><!--Form Busca-->

			</div><!--legenda-->

			<div class="pre_foto">

			</div><!--pre_foto-->

		</div><!--uplode_foto-->

		<div class="aviso_geral">

			<div class="sub_topo">
				
				<h1>Excluir publicação</h1>
					
			</div><!--sub_topo-->
				<p>Tem certeza de que deseja excluir isso?</p>
				<div class="aviso_geral2">
				</div><!--avisogeral2-->
				<a href="#" class="negado">Cancelar</a>

		</div><!--aviso_geral-->
	
 	<div class="menu">
 	
 		<a href="#">
 			<?php
 				$verificar_foto = new foto_perfil;
 				$verificar_foto->setfoto(encrypt($foto['foto'], $login['chave'], false));
 				$retorno_foto = $verificar_foto->perfil();
 			?>
 			<img src="../imagens/<?php echo $retorno_foto; ?>" class="foto_usuario" />
 			
 		</a><!--foto_usuario-->
 		
 		<div class="sub_menu">
 		
 			<div class="sub_info">
 				
 				<i class="sub_info_icone">people_outline</i>
 				
 				<h1>
 					<?php
 						$contar = new seguir();
 						$contar->setuser_id($_SESSION['id_session']);
 						echo($contar->contar());
 					?> 					
 				<h2>Amigos</h2>
 				
 			</div><!--sub_info-->
 			
 			<div class="sub_info">
 				
 				<i class="sub_info_icone">whatshot</i>
 				
 				<h1>5</h1>
 				<h2>Online</h2>
 				
 			</div><!--sub_info-->
 			
 		</div><!--sub_menu-->
 		
 		<a class="usuario_online" href="#">
 		
 			<img src="../imagens/00.jpg" alt="Matheus Rizza" />
 			
 			<h1> Fernada Souza </h1>
 			
 			<div class="statu_online">
 				
 			</div><!--statu_online-->
 			
		</a><!--usuario_online-->
 		
 	</div><!--menu-->
 	
 	<div class="topo">

	  <div class="icone"> </div><!--icone-->

   	  <i class="inicial">view_headline</i><!--Inicial-->

   	  <i class="amigo">person_outline</i><!--amigo-->

   	  <i class="notificacao">public</i><!--notificacao-->
   	  
   	  <i class="chat">chat_bubble_outline</i><!--timeline-->
      
      	<a href="#" class="sair">power_settings_new</a><!--sair-->
     
        <i class="configuracao">settings</i><!--Configuração-->
      	
   	  	<i class="aviso">report_problem</i><!--aviso-->
		
       	<form  class="busca" name="login" method="post">
        
        <input name="Busca" type="text" placeholder="Pesquisar" onkeyup="buscar(this.value)" /> 
        <input type="submit" name="entre" value="search"/>      
            
      </form><!--Form Busca-->


</div><!--topo-->
 	
<div class="topo_sub">
 	
 		<div class="nome">
 			
 			<h1>
 				<?php echo ucwords(encrypt($login['nome'], $login['chave'], false)); ?> 
 				<?php echo ucwords(encrypt($login['sobre'], $login['chave'], false)); ?>
 					
 			</h1>
 			
 		</div><!--nome-->
 		
  <div class="menu_form">
      		
      		<a href="#" class="camera">camera_enhance</a><!--camera-->
      		
      		<a href="#" class="video">videocam</a><!--video-->
      		
      	</div><!--menu_form-->
 		
  		<form  class="pesquisa" action="?acao=postar_texto" method="post">
        
			<textarea class="textarea_post" name="texto" placeholder="Diga oque você pensa ." cols="30" rows="5" required></textarea>

        	<input type="submit" name="entre" value="Publicar"/>      
            
      	</form><!--Form Busca-->
      	

 	</div><!--topo_sub--> 	
 	
 	<div class="corpo">

		<?php

			$n = new noticia;
			$n->setuser_id($_SESSION['id_session']);
			$contar = count($n->buscar_noticia());
			$array_noticia = $n->buscar_noticia();

			if(empty($array_noticia)){ 

			}else{
				$c = '0';
			    $i = '1';

			    while($i <= $contar){
			      
			    	$dn = new noticia;
			    	$dn->setnoticia_id("$array_noticia[$c]");
			    	$row = $dn->dados_noticia();

			    		$un = new usuario;
			    		$un->setid($row['user_id']);
			    		$usuario_noticia = $un->buscar_usuario();

			    		$uf = new foto;
			    		$uf->setuser_id($row['user_id']);
			    		$uf->settipo('1');
			    		$foto_noticia_usuario = $uf->buscar_foto();

			    	if($row['tipo'] === '1'){

			    		include('pagina/noticia_texto.php');
			    			
			    	}
			    	else if($row['tipo'] === '2'){ 	

			    		include('pagina/noticia_foto.php');
			    	}

			    	else if($row['tipo'] === '3'){
			    		include('pagina/noticia_res_texto.php');
			    	}
			    	else{
			    		echo "Tipo não encontrado!";
			    	}

			    	$i++;
			    	$c++;

			    }

			}



		?>		
 		
	</div><!--corpo-->	
		
	<div class="janela_chat">
		
		<div class="chat_aviso">
		
			<a href="#" class="chat_aviso_icon">keyboard_arrow_left</a>
			
			<img src="../imagens/00.jpg" alt="Matheus Rizza" />
			
		</div><!--chat_aviso-->

		<div class="chat_aberto">
		
			<div class="chat_topo">
			
				<img src="../imagens/00.jpg" alt="Matheus Rizza" /> 
			
				<a href="#">Loretta Napoleoni</a>
				
				<i class="chat_topo_icon">keyboard_arrow_right</i>
				<i class="chat_topo_fechar">close</i>
				<i class="chat_topo_setting">settings</i>
			
				<div class="statu_online">
 				
 				</div><!--statu_online-->
 							
			</div><!--chat_topo-->
			
			<div class="chat_texto">
			
				
					<p class="chat_recebido">Olas, tudo bem ?</p>				
					<p class="chat_enviado">Olas, estou bem e você?</p>
					<p class="chat_enviado">Olas, estou bem e você?</p>
					<p class="chat_recebido">Olas, tudo bem ?</p>
					<p class="chat_recebido">Olas, tudo bem ?</p>				
					<p class="chat_enviado">Olas, estou bem e você?</p>
					<p class="chat_enviado">Olas, estou bem e você?</p>
					<p class="chat_recebido">Olas, tudo bem ?</p>
					<p class="chat_enviado">Desta maneira, o comprometimento entre as equipes auxilia a preparação e a composição dos paradigmas corporativos.</p>
					<p class="chat_recebido">Desta maneira, o comprometimento entre as equipes auxilia a preparação e a composição dos paradigmas corporativos.</p>
			
			</div><!--chat_texto-->
			
			<form  class="mensagem" name="mensagem" action="class\" method="post">
           	
           	    <textarea placeholder="Envie uma mensagem..."></textarea>    
            
      		</form><!--Form Busca-->			
			
		</div><!--chat_aberto-->
	
		
	</div><!--janela_chat-->



           <form action="?acao=deletar_post" method="post" name="deletar_post"> 
            <input type="hidden" name="aviso_post_form_id" id="aviso_post_form_id" value="0"> 
          </form> 


</body>
</html>