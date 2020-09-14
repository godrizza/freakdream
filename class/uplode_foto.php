<?php

    $tipo = ('2');

    $pasta = "../imagens/"; 

    $permitidos = array(".jpg",".jpeg",".png");

        if(isset($_POST)){ $nome_imagem = $_FILES['imagem']['name']; $tamanho_imagem = $_FILES['imagem']['size']; 

    $ext = strtolower(strrchr($nome_imagem,".")); 

        if(in_array($ext,$permitidos)){ 

    $tamanho = round($tamanho_imagem / 1024 * 1024 * 2); if($tamanho >= 1024){ 

    $nome_atual = md5(uniqid(time())).$ext;  $tmp = $_FILES['imagem']['tmp_name'];

        if(move_uploaded_file($tmp,$pasta.$nome_atual)){ 

            $foto = mysql_query("INSERT INTO fotos (foto, legenda, tipo_foto, user_id) VALUES ('$nome_atual', ' ', ' ', '$id')");

            $foto2 = mysql_query("SELECT * FROM fotos WHERE user_id = '$id' ORDER BY foto_id DESC LIMIT 0 , 1  ");
                
                while ($foto2_dados = mysql_fetch_array($foto2)) {

                    $idfoto = $foto2_dados['foto_id'];

            }

            $foto3 = mysql_query("UPDATE perfil_foto SET foto_id = '$idfoto' WHERE user_id = '$id'");

            $foto4 = mysql_query("INSERT INTO noticia (user_id, tipo, texto, data) VALUES ('$id', '$tipo', '$idfoto', '$data')");   
     
 }                              

 else{ echo "Falha ao enviar"; } }
 else{ echo "A imagem deve ser de no máximo 2MB"; } }
 else{ echo "Somente são aceitos arquivos do tipo Imagem"; } }
 else{ echo "Selecione uma imagem"; exit; }     

 ?>
