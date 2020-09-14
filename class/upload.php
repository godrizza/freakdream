<?php
    require_once'postar.php';
    require_once'postar_foto.php';
    require_once'postar_perfil.php';

 	$pasta = "../imagens/"; /* formatos de imagem permitidos */

 	$permitidos = array(".jpg",".jpeg",".png");

  		if(isset($_POST)){ $nome_imagem = $_FILES['imagem']['name']; $tamanho_imagem = $_FILES['imagem']['size']; 

 	$ext = strtolower(strrchr($nome_imagem,".")); 

  		if(in_array($ext,$permitidos)){ 

	$tamanho = round($tamanho_imagem / 1024 * 1024 * 2); if($tamanho >= 1024){ 

 	$nome_atual = md5(uniqid(time())).$ext;  $tmp = $_FILES['imagem']['tmp_name'];

  		if(move_uploaded_file($tmp,$pasta.$nome_atual)){ 

        $postar_foto = new postar_fotos;
        $postar_foto->setuser_id($_SESSION['id_session']);
        $postar_foto->setfoto($nome_atual);
        $postar_foto->settexto($_POST['texto']);        
        $id_foto = $postar_foto->postar_foto();

        if($_POST['opcoes'] >= '1'){

          $postar_perfil = new postar_perfil;
          $postar_perfil->setuser_id($_SESSION['id_session']);
          $postar_perfil->setfoto($id_foto);
          $postar_perfil->postar_foto();


        }else{}

  			$post = new post;
  			$post->setuser_id($_SESSION['id_session']);
  			$post->settipo("2");
  			$post->settexto($id_foto);
  			$post->postar();

  	 
 }								

 else{ echo "Falha ao enviar"; } }
 else{ echo "A imagem deve ser de no máximo 2MB"; } }
 else{ echo "Somente são aceitos arquivos do tipo Imagem"; } }
 else{ echo "Selecione uma imagem"; exit; } 	

 ?>
