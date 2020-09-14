<?php

	require_once('conexao.php');
	require_once('cripitografia.php');
    require_once('usuario.php'); 

	class notificacao extends conexao{

		private $notificacao_id;
		private $user_id;
		private $tipo;
		private $texto;

		public function enviar(){

			$pdo = parent::getDB();	

			$enviar = $pdo->prepare("INSERT INTO notificacao (user_id, tipo, texto, data) VALUES (:user_id, :tipo, :texto, :data)");
			$enviar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
			$enviar->bindValue(":tipo", $this->gettipo(), PDO::PARAM_STR);
			$enviar->bindValue(":texto", $this->gettexto(), PDO::PARAM_STR);
			$enviar->bindValue(":data", $this->getdata(), PDO::PARAM_STR);
			$enviar->execute();

			return true;

		}

		public function remover(){

			$pdo = parent::getDB();

				$remover = $pdo->prepare("DELETE FROM notificacao WHERE id = :notificacao_id");
				$remover->bindValue(":notificacao_id", $this->getnotificacao_id(), PDO::PARAM_INT);
				$remover->execute();

			return true;
		}

		public function lista(){

			$pdo = parent::getDB();

			$buscar = $pdo->prepare("SELECT id

										FROM notificacao

											WHERE user_id = :user_id AND tipo = :tipo

											ORDER BY id DESC

									");
			$buscar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
			$buscar->bindValue(":tipo", $this->gettipo(), PDO::PARAM_STR);
			$buscar->execute();
			
      		$arr = array();

      		while ($dados = $buscar->fetch(PDO::FETCH_ASSOC)) {             
            
            	$arr[] = $dados['id'];
  
      		}
      		return $arr;

		}

		public function dados(){

			$pdo = parent::getDB();

			$dados = $pdo->prepare("SELECT *

										from notificacao

											WHERE id = :id

											LIMIT 1
									");
			$dados->bindValue(":id", $this->getnotificacao_id(), PDO::PARAM_INT);
			$dados->execute();

			return $dados->fetch(PDO::FETCH_ASSOC);	
		}

		public function setuser_id($user_id){
			$this->user_id = $user_id;
		}
		public function settipo($tipo){
			$this->tipo = encrypt($tipo, $this->getchave(), true);
		}
		public function settexto($texto){
			$this->texto = encrypt($texto, $this->getchave(), true);
		}
		public function setnotificacao_id($notificacao_id){
			$this->notificacao_id = $notificacao_id;
		}

		public function getchave(){
			$u = new usuario;
			$u->setid($this->getuser_id());
			$chave = $u->buscar_usuario();

			return $chave['chave'];
		}
		public function gettexto(){
			return $this->texto;
		}
		public function gettipo(){
			return $this->tipo;
		}
		public function getuser_id(){
			return $this->user_id;
		}
		public function getnotificacao_id(){
			return $this->notificacao_id;
		}
		public function getdata(){
			date_default_timezone_set('America/Sao_Paulo');
        	$data = date("Y-m-d H:i:s"); 
        	return encrypt($data, $this->getchave(), true);
		}

	}