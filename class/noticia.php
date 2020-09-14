<?php 
  
  require_once('conexao.php');
  require_once('cripitografia.php');
  require_once('usuario.php');

  class post extends conexao{

    private $user_id;
    private $post_id;
    private $texto;

    public function adicionar(){

      $pdo = parent::getDB();

      $adicionar = $pdo->prepare("INSERT INTO post(user_id, tipo, texto, data) VALUES (:user_id, :tipo, :texto, :data)");
      $adicionar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
      $adicionar->bindValue(":tipo", $this->gettipo(), PDO::PARAM_INT);
      $adicionar->bindValue(":texto", $this->gettexto(), PDO::PARAM_STR);
      $adicionar->bindValue(":data", $this->getdata(), PDO::PARAM_STR);
      $adicionar->execute();

      return true;

    }

    public function deletar(){

      $pdo = parent::getDB();

      $deletar = $pdo->prepare("DELETE FROM post WHERE user_id = :user_id AND ");
    }

    public function lista(){

      $pdo = parent::getDB();

      $lista = $pdo->prepare("SELECT p.user_id, p.post_id, p.texto, p.data, s.user_id, s.seguidor_id

                                          FROM post p, seguir s

                                            WHERE s.user_id = :user_id 

                                              GROUP BY  p.post_id

                                                ORDER BY p.post_id desc");

      $lista->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
      $lista -> execute();
      $arr = array();

      while ($dados = $lista->fetch(PDO::FETCH_ASSOC)) {             
            
            $arr[] = $dados['post_id'];
  
      }
      return $arr;

    }

    public function dados(){

      $pdo = parent::getDB();

      $dados = $pdo->prepare("SELECT * FROM post WHERE post_id = :post_id");
      $dados->bindValue(":post_id", $this->getpost_id(), PDO::PARAM_INT);
      $dados->execute();

      return $dados -> fetch(PDO::FETCH_ASSOC);
      
    }

    public function setuser_id($user_id){
      $this->user_id = $user_id;
    }
    public function setpost_id($post_id){
      $this->post_id = $post_id;
    }
    public function settipo($tipo){
      $this->tipo = $tipo;
    }
    public function settexto($texto){        
      $this->texto = encrypt($texto, $this->getchave(), true);
    }
    
    public function getchave(){
      $u = new usuario;
      $u->setid($this->getuser_id());
      $dados = $u->buscar_usuario();
        return $dados['chave'];
    }
    public function getdata(){
      date_default_timezone_set('America/Sao_Paulo');
      $data = date("Y-m-d H:i:s"); 
        return encrypt($data, $this->getchave(), true);
    }
    public function getuser_id(){
      return $this->user_id;
    }
    public function getpost_id(){
      return $this->post_id;
    }
    public function gettipo(){
      return $this->tipo;
    }
    public function gettexto(){
      return $this->texto;
    }

  }