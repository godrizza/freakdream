<?php
  require_once'usuario.php';
  require_once'busca.php';
  require_once'cripitografia.php';

  if(empty($_GET['valor'])){
    $valor = false;
  }
  else{
    $valor = $_GET['valor'];
  }

  $b = new buscar;
  $b->setnome("$valor");
  $result = count($b->busca()); 
  $array = $b->busca();
  if(empty($array)){
    
    

  }else{

    $c = 0;
    $i= 1;
    while ($i <= $result) {    

      $u = new usuario; 
      $u->setid($array[$c]);
      $dados = $u->buscar_usuario();

      echo '<a href="'.$dados['id'].'">
            <img src="../imagens/11.jpg" alt="Matheus Rizza">
            <h1>
              '.ucwords(encrypt($dados['nome'], $dados['senha'], false)).' 
              '.ucwords(encrypt($dados['sobre'], $dados['senha'], false)).'
            </h1>
            </a>';

      $c++;
      $i++;
      
    }
  }



?>













<?php

  /*require_once'usuario.php';
  require_once'busca.php';
  require_once'cripitografia.php';

  if(empty($_GET['valor'])){
    $valor = false;
  }
  else{
    $valor = $_GET['valor'];
  }

  $b = new buscar;
  $b->setnome('$valor');


  if($b->buscar() === false){

    echo'nada';

  }else{
    $u = new usuario;
    $login = $u->buscar_usuario($b->buscar());

    echo '<a href="'.$login['id'].'">
          <img src="../imagens/11.jpg" alt="Matheus Rizza">
          <h1>
            '.ucwords(encrypt($login['nome'], $login['senha'], false)).' 
            '.ucwords(encrypt($login['sobre'], $login['senha'], false)).'
          </h1>
          </a>';
  }
*/

?>