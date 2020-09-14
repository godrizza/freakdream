<?php 

   require_once('conexao.php');
   require_once('usuario.php');
   require_once('foto.php');
   require_once('cripitografia.php');

   class deletar_post extends conexao{

   	private $user_id;
   	private $post_id;

   public function deletar(){
   	$pdo = parent::getDB();

   	 $dados_post = $pdo->prepare("SELECT post_id, user_id, tipo, texto FROM post where post_id = :post_id AND user_id = :user_id ");
   	 $dados_post->bindValue(":post_id", $this->getpost_id(), PDO::PARAM_INT);
   	 $dados_post->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
   	 $dados_post-> execute();

   	 $linha = $dados_post->fetch(PDO::FETCH_ASSOC);
   	 
   	 if($linha == true){

         if($linha['tipo'] == '2'){

            $u = new usuario;
            $u->setid($this->getuser_id());
            $dados_usuario = $u->buscar_usuario();

            $uf = new foto;
            $uf->setuser_id(encrypt($linha['texto'], $dados_usuario['senha'],false));
            $uf->settipo('0');
            $row = $uf->buscar_foto();

            $foto_perfil = $pdo->prepare("SELECT foto_id, user_id FROM perfil_foto where foto_id = :foto_id AND user_id = :user_id");
            $foto_perfil->bindValue(":foto_id", $row['foto_id'], PDO::PARAM_INT);
            $foto_perfil->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
            $foto_perfil->execute();

            $foto_verificar = $foto_perfil->fetch(PDO::FETCH_ASSOC);

            $deletar_foto = $pdo->prepare("DELETE FROM fotos WHERE foto_id = :foto_id");
            $deletar_foto ->bindValue(":foto_id", $row['foto_id'], PDO::PARAM_INT);
            $deletar_foto->execute();

             if($linha == true){

               $deletar_perfil = $pdo->prepare("DELETE FROM perfil_foto WHERE foto_id = :foto_id AND user_id = :user_id");
               $deletar_perfil->bindValue(":foto_id", $row['foto_id'], PDO::PARAM_INT);
               $deletar_perfil->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
               $deletar_perfil->execute();

             }else{

             }

            unlink("../imagens/".encrypt($row['foto'], $dados_usuario['senha'],false));

         }
         else{

         }
   	 	$dados_post = $pdo->prepare("DELETE FROM post WHERE post_id = :post_id AND user_id = :user_id");
   	 	$dados_post->bindValue(":post_id", $linha['post_id'], PDO::PARAM_INT);
   	 	$dados_post->bindValue(":user_id", $linha['user_id'],PDO::PARAM_INT);
   	 	$dados_post->execute();

   	 	return true;

   	 }else{

   	 	return false;

   	 }

   }

   public function setuser_id($user_id){
   	$this->user_id = $user_id;
   }
   public function getuser_id(){
    return $this->user_id;
   }
   public function setpost_id($post_id){
   	$this->post_id = $post_id;
   }
   public function getpost_id(){
   	return $this->post_id;
   }

   }
