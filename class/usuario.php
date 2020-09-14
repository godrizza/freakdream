<?php 
	
	if(!isset($_SESSION)) 
	{ 
	session_start(); 
	}   

require_once('conexao.php');


	class usuario extends conexao {
		
		private $id;
		
		public function buscar_usuario(){
			
			$pdo = parent::getDB();		
			
			$buscardados=$pdo->prepare("SELECT * FROM usuario WHERE id = :id");
			$buscardados->bindValue(":id", $this->getid(),PDO::PARAM_INT);
			$buscardados->execute();
			
			$linha = $buscardados->fetch(PDO::FETCH_ASSOC) or die(print_r($query->errorInfo(), true));;
			return($linha);	
			
		}
		public function setid($id){
			$this->id = $id;			
		}
		public function getid(){
			return $this -> id;	
			
		}
	}
	
	class login_usuario extends conexao{

		public function login(){

			$pdo = parent::getDB();

			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				$email = $this -> verificar_usuario($_POST['email']);
				$senha = md5($_POST["senha"]);

					if($email['email'] === $_POST['email']){

						if($senha === $email['senha']){

							$_SESSION['id_session'] = $email['id'];

							date_default_timezone_set('America/Sao_Paulo');
							$data = date("Y-m-d H:i:s");

							$enviar_ip = $pdo -> prepare("INSERT INTO login_historico(user_id, data, ip) VALUES (:id, :data, :ip)");
							$enviar_ip->bindValue(":id", $email['id'],PDO::PARAM_INT);
							$enviar_ip->bindValue(":data", $data,PDO::PARAM_STR);
							$enviar_ip->bindValue(":ip", $_SERVER['REMOTE_ADDR'],PDO::PARAM_STR);
							$enviar_ip->execute();


							header('Location: ../template/inicial.php');
						} else{
							header("Location:../template/index.php?login=acessonegadosenha");
						}

					} else{
						header("Location:../template/index.php?login=acessonegadoemail");
					}


			}
		}
		public function proteger(){

			if(empty($_SESSION['id_session'])){
				header('Location: index.php');
				echo $_SESSION['id_session'];
			}else{

			}

		}


		protected function verificar_usuario($email){

			$this ->email = $email;

			$pdo = parent::getDB();

			$buscardados=$pdo->prepare("SELECT * FROM usuario WHERE email = :email");
			$buscardados->bindValue(":email", $email,PDO::PARAM_STR);
			$buscardados->execute();

			return $buscardados->fetch(PDO::FETCH_ASSOC);
		}

    }


