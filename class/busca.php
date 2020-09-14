<?php
	
	require_once('conexao.php');
	require_once('cripitografia.php');

	class buscar extends conexao{

		private $busca;

		public function busca(){
			$pdo = parent::getDB();

			$dados_usuario = $pdo->prepare("SELECT id, nome, sobre, senha FROM usuario");
			$dados_usuario -> execute();
			$arr = array();

			while ($dados = $dados_usuario->fetch(PDO::FETCH_ASSOC)) {
			      $nome = ucwords(encrypt($dados['nome'], $dados['senha'], false));
			      $sobre = ucwords(encrypt($dados['sobre'], $dados['senha'], false));
			      $nomesobre = $nome." ".$sobre;

			    

			     $resultado = stripos($nomesobre, $this->getnome());

			    if($resultado === false){
			   		
			   	}else{				   		
			   		
			   		$arr[] = $dados['id'];
			   	}
			}
			return $arr;
		}

		public function setnome($busca){
			$this->busca = $busca;
		}
		public function getnome(){
			return $this->busca;
		}
		
	}
?>	