<?php

	require_once('conexao.php');
	require_once('verificar_amigo.php');

	class remover extends conexao{

		private $user_id;
		private $amigo_id;

		public function remover_amigo(){
			$pdo = parent::getDB();

			$verificar = new verificar();
			$verificar->setuser_id($this->getuser_id());
			$verificar->setamigo_id($this->getamigo_id());

			$a = $verificar->verificar_amigo();

			if($a === true){

				$remover = $pdo->prepare("DELETE FROM amigo WHERE user_id = :user_id AND amigo_id = :amigo_id");
				$remover->bindValue(":user_id", $this->getuser_id(), PDO::PARAM_INT);
				$remover->bindValue(":amigo_id", $this->getamigo_id(), PDO::PARAM_INT);
				$remover->execute();

				return true;

			}else{

				return false;

			}

		}

		public function getuser_id(){

			return $this->user_id;

		}

		public function getamigo_id(){

			return $this->amigo_id;

		}

		public function setuser_id($user_id){

			$this->user_id = $user_id;

		}

		public function setamigo_id($amigo_id){

			$this->amigo_id = $amigo_id;

		}
	}