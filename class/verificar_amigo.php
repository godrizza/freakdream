 <?php

     require_once('conexao.php');

     class verificar extends conexao{

      private $user_id;
      private $amigo_id;

      public function verificar_amigo(){

        $pdo = parent::getDB();

        $dados_colega = $pdo->prepare("SELECT user_id, amigo_id 

                                        FROM amigo 

                                          WHERE user_id = :user_id AND amigo_id = :amigo_id 

                                          LIMIT 1");

        $dados_colega ->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
        $dados_colega ->bindValue(":amigo_id", $this->getamigo_id(), PDO::PARAM_INT);
        $dados_colega ->execute();
        $this->Count = $dados_colega->rowCount();

      if($this->Count >= '1'){

        return true;

      }else{

        return false;

      }

      }
      public function setuser_id($user_id){
        $this->user_id = $user_id;
      }
      public function setamigo_id($amigo_id){
        $this->amigo_id = $amigo_id;
      }
      public function getuser_id(){
        return $this->user_id;
      }
      public function getamigo_id(){
        return $this->amigo_id;
      }
    }

