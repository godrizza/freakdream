<?php

  function resume( $var, $limite, $url ){   
    if (strlen($var) > $limite) {  
    $var = substr($var, 0, $limite);   
    $var = trim($var) . $url;  
  }
  return $var;
}

