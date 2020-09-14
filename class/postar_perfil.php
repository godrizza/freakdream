<?php
    
    require_once('conexao.php');

      class postar_perfil extends conexao{

        private $user_id;
        private $foto_id;

        public function postar_foto(){
          $pdo = parent::getDB();       

          $enviar_foto = $pdo->prepare("INSERT INTO perfil_foto (foto_id, user_id) VALUES (:foto, :user_id)");
          $enviar_foto->bindValue(":foto", $this->getfoto(),PDO::PARAM_STR);
          $enviar_foto->bindValue(":user_id", $this->getuser_id(),PDO::PARAM_STR);
          $enviar_foto->execute();
        }

        public function setuser_id($user_id){
          $this->user_id = $user_id;
        }
        public function getuser_id(){
          return $this->user_id;
        }
        public function setfoto($foto_id){
          $this->foto = $foto_id;
        }
        public function getfoto(){
          return $this->foto;
        }

      }
?>