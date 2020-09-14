<?php

	class foto_perfil{

		private $foto_perfil;

		public function perfil(){

			if(empty($this->foto)){

				return '00.jpg';

			}else{

				return $this->getfoto();

			}

		}
		public function setfoto($foto_perfil){
			$this->foto = $foto_perfil;
		}
		public function getfoto(){
			return $this->foto;
		}
	}