<?php 

  function encrypt($frase, $chave, $crypt){

    $retorno = "";

    if ($frase=='') return '';

    if($crypt){

      $string = $frase;
      $i = strlen($string)-1;
      $j = strlen($chave);
       do{
        $retorno .= ($string{$i} ^ $chave{$i % $j});
      }while ($i--);

      $retorno = strrev($retorno);
      $retorno = base64_encode($retorno);
    }else{
      $string = base64_decode($frase);
      $i = strlen($string)-1;
      $j = strlen($chave);

      do{
        $retorno .= ($string{$i} ^ $chave{$i % $j});
      }while ($i--);

      $retorno = strrev($retorno);
      $retorno = strip_tags($retorno);
    }
    return $retorno;
  }
