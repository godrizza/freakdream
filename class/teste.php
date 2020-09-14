<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title></title>
   </head>
   <body>

      <?php

      require_once 'cripitografia.php';

   $chave = "4209a81f7ed1e38ac4de9f6563c46bb1";
   $frase = "matheus";
   $crypt = encrypt($frase, $chave, true);
   $decrypt = encrypt($crypt, $chave, false);
   echo "Frase = ".$frase."<br>";
   echo "Cript = ".$crypt."<br>";
   echo "Decript = ".$decrypt."<br>";
      
      ?>



   </body>
</html>
