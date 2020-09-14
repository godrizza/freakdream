<?php

  echo'

    <div class="box">
    
      <a href="#" class="foto_usuario">
        
        <img src="../imagens/';

        $verificar_foto = new foto_perfil;
        $verificar_foto->setfoto(encrypt($foto_noticia_usuario['foto'], $usuario_noticia['chave'], false));
        $retorno_foto = $verificar_foto->perfil();

       echo''.$retorno_foto.'"/>
        
      </a><!--foto_usuario-->
      
      <div class="box_conteudo">
        
        <div class="box_conteudo_opcao" id="conf_'.$row['post_id'].'_id">

          <span class="seta"></span>  
          ';

          if($row['user_id'] === $_SESSION['id_session']){

          echo'
           <span class="icones_opcao">delete</span>

           <a id="aviso_'.$row['post_id'].'" onClick="javascript:aviso('.$row['post_id'].');">Excluir Publicação</a> 
          ';

          }else{
            
          }
          echo'
          
          
        </div><!--box_conteudo_opcao-->

        <a href="#" class="configuracao" id="configuracao_'.$row['post_id'].'" onClick="javascript:conf_opcao('.$row['post_id'].');">settings</a><!--configuracao-->

        <a OnClick="postagem('.$row['post_id'].')" class="compartilhar">repeat</a><!--compartilhar-->

  ';