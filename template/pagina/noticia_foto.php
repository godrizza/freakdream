<?php 

    include("noticia_topo.php");

          $fp = new foto;
          $fp->setuser_id(encrypt($row['texto'], $usuario_noticia['chave'], false));
          $fp->settipo('0');
          $row = $fp->buscar_foto();

    echo'
        
        <a href="#" class="box_foto">
          
          <img class="box_img" src="../imagens/'.encrypt($row['foto'], $usuario_noticia['chave'], false).'" alt="Ana" /> 
          
          <p>'.resume((ucwords(encrypt($row['texto'], $usuario_noticia['chave'], false))),350,('<a href="#">...</a>')).'</p>
          
        </a><!--box_foto-->
  
    ';

    include("noticia_rotape.php");