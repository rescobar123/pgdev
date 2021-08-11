<?php
	class VistasModelo
	{
		protected function obtenerVistasModelo($vistas ){
		if ($vistas =="index" || $vistas == "login") {
			$contenido = "login";
		}else{
			$listaBlanca=["home","product", "productEdit", "productUp", "productActExi", "productAddSucursal", "pedidos", "user", "pedidoAceptar", "pedidosGes", "pedidosAsig"];
		if (in_array($vistas, $listaBlanca)) {
			if (is_file("./vistas/contenidos/".$vistas."-view.php")) {
				$contenido = "./vistas/contenidos/".$vistas."-view.php";
				}else{
				$contenido = "login";
			}
			}else{
				$contenido="404";
			}
		}	
		return $contenido;
	}
				
}	

		
