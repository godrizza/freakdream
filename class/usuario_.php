<?php 
	require_once('conexao.php');
	require_once('cripitografia_geral.php');

	if(!isset($_SESSION)) 
	{ 

		session_start(); 
	
	}

	class usuario extends conexao{

		public function login(){
			
			/*$l = new cripitografia();
			$l->setuser_id('');*/


			if($this->validar()){

				return $this->validar();


			}else{

				return false;

			}
		}

		private function validar(){

			$pdo = parent::getDB();

			$validar = $pdo->prepare("SELECT slug FROM usuario WHERE slug = :slug");
			$validar->bindValue(":slug", $this->getslug(),PDO::PARAM_STR);
			$validar->execute();

			$count = $validar->rowCount();

			if($count == '1'){

				return true;

			}else{

				return false;

			}	
		}


		public function getslug(){

			return $this->slug;
		}


		public function setslug($slug){

			$this->slug = $slug;
		}
	}