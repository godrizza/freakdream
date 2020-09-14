<?php 

	require_once("conexao.php");
	require_once('cripitografia.php');
	require_once('usuario.php');

	class cripitografia extends conexao{

		private $chave;
		private $user_id;
		private $slug;
		private $chaveupdate;
		private $slugupdate;

		public function abrir(){

				if($this->verificar() == '1'){


				}else{

					return false;

				}

		}
		public function fechar(){

		}
		public function criar(){

			if($this->verificar() == false){

				$pdo = parent::getDB();

				$criar = $pdo->prepare("INSERT INTO verificacao (user_id, master) VALUES (:user_id, :master)");
				$criar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
				$criar->bindValue(":master", $this->getmaster(), PDO::PARAM_STR);
				$criar->execute();
				$count = $criar->rowCount();

				if($count == '1'){

					return true;

				}else{

					return false;

				}

			}else{

				return false;

			}			

		}

		public function remover(){

			if($this->verificar()){

				$pdo = parent::getDB();

				$remover = $pdo->prepare("DELETE FROM verificacao WHERE user_id = :user_id");
				$remover->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
				$remover->execute();
				$count = $remover->rowCount();

				if($count == '1'){

					return true;

				}else{

					return false;

				}

			}else{

				return false;

			}

		}

		public function mudar(){

			if($this->verificar()){

				$pdo = parent::getDB();

				$mudar = $pdo->prepare("UPDATE verificacao SET  master = :update_master WHERE user_id = :user_id and master = :master");
				$mudar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
				$mudar->bindValue(":master", $this->getmaster(), PDO::PARAM_STR);
				$mudar->bindValue(":update_master", $this->getmasterupdate(), PDO::PARAM_STR);
				$mudar ->execute();
				$count = $mudar->rowCount();

				if($count == '1'){

					return true;

				}else{

					return false;

				}
;

			}else{

				return false;

			}
		}

		public function verificar_chave(){

			if($this->verificar()){

				$pdo = parent::getDB();

				$verificar_chave = $pdo->prepare("SELECT user_id, chave FROM verificacao WHERE user_id = :user_id AND chave = :chave");
				$verificar_chave->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
				$verificar_chave->bindValue(":chave", $this->getchave(), PDO::PARAM_STR);
				$verificar_chave->execute();

				$count = $verificar_chave->rowCount();

				if($count == '1'){

					return true;

				}else{

					return false;
					
				}

			}else{
				return false;
			}
			
		}

		public function verificar(){

			$pdo = parent::getDB();

			$verificar = $pdo->prepare("SELECT user_id FROM verificacao WHERE user_id = :user_id");
			$verificar->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
			$verificar->execute();

			$resultado = $verificar->rowCount();

			if($resultado == '1'){

				return true;

			}else {

				return false;

			}
		}


		public function setuser_id($user_id){
			$this->user_id = $user_id;
		}
		public function setslug($slug){
			$this->slug = $slug;
		}
		public function setchave($chave){
			$this->chave = $chave;
		}
		public function setslugupdate($slugupdate){
			$this->slugupdate = $slugupdate;
		}
		public function setchaveupdate($chaveupdate){
			$this->chaveupdate = $chaveupdate;
		}

		public function getuser_id(){
			return $this->user_id;
		}
		public function getslug(){
			return $this->slug;
		}
		public function getchave(){
			return md5($this->chave);
		}
		public function getslugupdate(){
			return $this->slugupdate;
		}
		public function getchaveupdate(){
			return md5($this->chaveupdate);
		}
		public function getmaster(){
			return encrypt($this->getslug(), $this->getchave(), true);
		}
		public function getmasterupdate(){
			return encrypt($this->getslugupdate(), $this->getchaveupdate(), true);
		}
	}