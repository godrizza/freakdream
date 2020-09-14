<?php 
  
  include("noticia_topo.php");  

    echo'
        
        <p>'.resume((ucwords(encrypt($row['texto'], $usuario_noticia['senha'], false))),350,('<a href="#">...</a>')).'</a></p>
    ';
    
  include("noticia_rotape.php");