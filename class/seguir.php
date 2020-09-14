<?php

	require_once('conexao.php');
	require_once('cripitografia.php');
    require_once('usuario.php'); 

	class seguir extends conexao{

		private $user_id;
		private $seguidor_id;


		public function adicionar(){

			$pdo = parent::getDB();

			$adicionar = $pdo->prepare("INSERT INTO seguir(user_id, seguidor_id) VALUES ( :user_id, :seguidor_id)");
			$adicionar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
			$adicionar->bindValue(":seguidor_id", $this->getseguidor_id(), PDO::PARAM_STR);
			$adicionar->execute();

			return true;

		}

		public function deletar(){

			$pdo = parent::getDB();

			$remover = $pdo->prepare("DELETE FROM seguir WHERE user_id = :user_id AND seguidor_id =:seguidor_id");
			$remover->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
			$remover->bindValue(":seguidor_id", $this->getseguidor_id(), PDO::PARAM_STR);
			$remover->execute();

			return true;
		}

		public function contar(){

			$pdo = parent::getDB();

			$contar = $pdo->prepare("SELECT user_id FROM seguir WHERE user_id = :user_id GROUP BY seguidor_id");
			$contar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
			$contar->execute();
			$this->Count = $contar->rowCount();

			return $this->Count - '1';

		}

		public function getchave(){
			$u = new usuario;
			$u->setid($this->getuser_id());
			$chave = $u->buscar_usuario();

			return $chave['chave'];

		}
		public function getuser_id(){
			return $this->user_id;
		}
		public function getseguidor_id(){
			return encrypt(
				$this->seguidor_id, $this->getchave(), true);
		}

		public function setseguidor_id($seguidor_id){
			$this->seguidor_id = $seguidor_id;
		}
		public function setuser_id($user_id){
			$this->user_id = $user_id;
		}

	}