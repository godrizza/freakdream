<?php
	
	require_once('conexao.php');

	class verificar_post extends conexao{

		private $post_id;
		private $user_id;

		public function verifica(){

			$pdo = parent::getDB();

			$verificar = $pdo->prepare("SELECT * 

											FROM post 
												
												WHERE user_id = :user_id AND post_id = :post_id

											");
			$verificar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
			$verificar->bindValue(":post_id", $this->getpost_id(), PDO::PARAM_INT);

   	 		$verificar->execute();

   	 		$this->Count = $verificar->rowCount();

   			if($this->Count >= '1'){

   			  	return true;

   	 		}else{

   	 			return false;
   	 		}

		}

		public function getpost_id(){
			return $this->post_id;
		}

		public function getuser_id(){
			return $this->user_id;
		}

		public function setuser_id($user_id){
			$this->user_id = $user_id;
		}

		public function setpost_id($post_id){

			$this->post_id = $post_id;

		}

	}