<?php 
	require_once"./modelos/VistasModelo.php";
	class VistasControlador extends VistasModelo{
		
		public function obtenerPlantillaControlador(){
			return require_once "./vistas/plantilla.php";
		}
		public function obtenerVistasControlador(){
			if(isset($_GET['views'])){//views es el nombre que tiene la variable en htacces
				$ruta = explode("/",$_GET['views']) ;
				$respuesta=VistasModelo::obtenerVistasModelo($ruta[0]);
			}else{
				$respuesta="inicio";
			}
			return $respuesta;
		}
	}