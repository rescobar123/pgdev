<?php
	class VistasModelo
	{
		protected function obtenerVistasModelo($vistas ){
		if ($vistas =="index" || $vistas == "login") {
			$contenido = "login";
		}else{
			$listaBlanca=["inicio","tienda", "product", "about", "carritoCompras", "", "", "", "" ];
		if (in_array($vistas, $listaBlanca)) {
			if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
				$contenido = "./vistas/contenidos/".$vistas."-view.php";
				}else{
				$contenido = "inicio";
			}

			}else{
				$contenido="404";
			}
	}	

		return $contenido;
	}
				
}	

		
