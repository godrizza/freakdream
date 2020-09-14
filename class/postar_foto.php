<?php
    
    require_once('conexao.php');
    require_once('cripitografia.php');
    require_once('usuario.php'); 

      class postar_fotos extends conexao{

        private $user_id;
        private $foto;
        private $texto;

        public function postar_foto(){
          $pdo = parent::getDB();       

          $enviar_foto = $pdo->prepare("INSERT INTO fotos(foto, texto) VALUES (:foto, :texto)");
          $enviar_foto->bindValue(":foto", $this->getfoto(),PDO::PARAM_STR);
          $enviar_foto->bindValue(":texto", $this->gettexto(),PDO::PARAM_STR);
          $enviar_foto->execute();

          $buscar_foto = $pdo->prepare("SELECT * FROM fotos WHERE foto = :foto");
          $buscar_foto->bindValue(":foto", $this->getfoto(),PDO::PARAM_STR);
          $buscar_foto->execute();

          $dados_foto = $buscar_foto->fetch(PDO::FETCH_ASSOC);

          return  $dados_foto['foto_id'];
        }

        public function getsenha(){
          $u = new usuario;
          $u->setid($this->getuser_id());
          $dados = $u->buscar_usuario();
          return $dados['senha'];
        }
        public function setuser_id($user_id){
          $this->user_id = $user_id;
        }
        public function getuser_id(){
          return $this->user_id;
        }
        public function setfoto($foto){
          $this->foto = encrypt($foto, $this->getsenha(), true);
        }
        public function getfoto(){
          return $this->foto;
        }
        public function settexto($texto){        

          $this->texto = encrypt($texto, $this->getsenha(), true);
        }
        public function gettexto(){
          return $this->texto;
        }

      }
?>