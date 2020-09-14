<?php
    
    require_once('conexao.php');
    require_once('cripitografia.php');
    require_once('usuario.php'); 

      class post extends conexao{

        private $user_id;
        private $tipo;
        private $texto;

        public function postar(){
          $pdo = parent::getDB();

       

          $enviar_post = $pdo->prepare("INSERT INTO post(user_id, tipo, texto, data) VALUES (:user_id, :tipo, :texto, :data)");
          $enviar_post->bindValue(":user_id", $this->getuser_id(),PDO::PARAM_INT);
          $enviar_post->bindValue(":tipo", $this->gettipo(),PDO::PARAM_INT);
          $enviar_post->bindValue(":texto", $this->gettexto(),PDO::PARAM_STR);
          $enviar_post->bindValue(":data", $this->getdata(),PDO::PARAM_STR);
          $enviar_post->execute();
          
        }
        public function getchave(){
          $u = new usuario;
          $u->setid($this->getuser_id());
          $dados = $u->buscar_usuario();
          return $dados['senha'];
        }
        public function getdata(){
          date_default_timezone_set('America/Sao_Paulo');
          $data = date("Y-m-d H:i:s"); 
          return encrypt($data, $this->getchave(), true);
        }
        public function setuser_id($user_id){
          $this->user_id = $user_id;
        }
        public function getuser_id(){
          return $this->user_id;
        }
        public function settipo($tipo){
          $this->tipo = $tipo;
        }
        public function gettipo(){
          return $this->tipo;
        }
        public function settexto($texto){        

          $this->texto = encrypt($texto, $this->getchave(), true);

        }
        public function gettexto(){
          return $this->texto;
        }

      }
?>