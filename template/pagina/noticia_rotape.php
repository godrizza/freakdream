<?php 
	echo'

	</div><!--box_conteudo-->
      
      
      <div class="box_nome">
      
        <h1><a href="#" alt="">'.ucwords(encrypt($usuario_noticia['nome'], $usuario_noticia['chave'], false)).'  '.ucwords(encrypt($usuario_noticia['sobre'], $usuario_noticia['chave'], false)).'</a>12:50</h1>
        
      </div><!--box_nome-->
      
      <div class="box_opcao">
        
          <div class="comentario">
          
            <a href="#">1000 <i class="gostei_opcao">chat_bubble</i></a>
            
          </div><!--comentario-->
          
          <div class="gostei">
          
            <a href="#">0 <i class="gostei_opcao">favorite_border</i></a>
          
          </div><!--gostei-->
        
      </div><!--box_opcao-->
            
    </div><!--box-->

	';