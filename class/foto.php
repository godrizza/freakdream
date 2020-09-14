<?php
 
  require_once('conexao.php');

  class foto extends conexao{

    private $user_id;
    private $tipo;

    public function buscar_foto(){

      $pdo = parent::getDB();

       if($this->gettipo() == '1'){

      $usuario_perfil = $pdo->prepare("SELECT * FROM perfil_foto WHERE user_id = :user_id ORDER BY foto_id DESC");
      $usuario_perfil->bindValue(":user_id", $this->getuser_id(),PDO::PARAM_INT);
      $usuario_perfil->execute();

      $dados_perfil = $usuario_perfil->fetch(PDO::FETCH_ASSOC);
      $id_foto = $dados_perfil['foto_id'];

      }else{

         $id_foto = $this->getuser_id();

      }

      $dados_foto = $pdo->prepare("SELECT * FROM fotos WHERE foto_id = :user_id");
      $dados_foto->bindValue(":user_id", $id_foto,PDO::PARAM_INT);
      $dados_foto->execute();


      return $dados_foto->fetch(PDO::FETCH_ASSOC);


    }
    public function settipo($tipo){
      $this->tipo = $tipo;
    }
    public function gettipo(){
      return $this->tipo;
    }

    public function setuser_id($user_id){
      $this->user_id = $user_id;
    }
    public function getuser_id(){
      return $this->user_id;
    }

  } 